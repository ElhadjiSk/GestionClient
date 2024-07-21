<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Liste des Clients -->
    <div class="flex justify-center items-center min-h-screen px-4 xl:p-0">
        <div class="col-span-5 bg-white p-6 rounded-xl border border-gray-50">
            <h1 class="text-2xl font-bold text-blue-600 mb-4">Liste des Clients</h1>
            <form method="GET" action="list.php" class="mb-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6 items-center">
                    <input type="text" name="filter" placeholder="Filtrer par nom" class="py-2 px-4 border rounded-full" value="<?= htmlspecialchars($filter) ?>">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition">Filtrer</button>
                </div>
            </form>
            <table class="min-w-full bg-white">
                <thead class="h-10 text-center py-2 px-4 bg-purple-500 text-sm font-medium text-white">
                    <tr>
                        <th class="rounded-tl-lg rounded-bl-lg">Photo</th>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Genre</th>
                        <th>Status</th>
                        <th class="rounded-tr-lg rounded-br-lg">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-center">
                    <?php foreach ($clients as $client) : ?>
                        <tr>
                            <td class="flex justify-center">
                                <img src="/public/img/default-profile.png" alt="Profile" class="w-8 h-8 rounded-full mt-2">
                            </td>
                            <td><?= htmlspecialchars($client['name'], ENT_QUOTES) ?></td>
                            <td><?= htmlspecialchars($client['email'], ENT_QUOTES) ?></td>
                            <td><?= htmlspecialchars($client['phone'], ENT_QUOTES) ?></td>
                            <td><?= htmlspecialchars($client['address'], ENT_QUOTES) ?></td>
                            <td><?= htmlspecialchars($client['gender'], ENT_QUOTES) ?></td>
                            <td><?= htmlspecialchars($client['status'], ENT_QUOTES) ?></td>
                            <td>
                                <button onclick="openEditPopup('<?= $client['id'] ?>', '<?= htmlspecialchars($client['name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($client['email'], ENT_QUOTES) ?>', '<?= htmlspecialchars($client['phone'], ENT_QUOTES) ?>', '<?= htmlspecialchars($client['address'], ENT_QUOTES) ?>', '<?= htmlspecialchars($client['gender'], ENT_QUOTES) ?>', '<?= htmlspecialchars($client['status'], ENT_QUOTES) ?>')" class="text-yellow-500 hover:text-yellow-700 transition">
                                    ✏️
                                </button>
                                <a href="delete.php?id=<?= $client['id'] ?>" class="text-red-500 hover:text-red-700 transition" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                                    ❌
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="flex justify-between mt-4 items-center">
                <button class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-700 transition" <?= $page <= 1 ? 'disabled' : '' ?> onclick="location.href='?page=<?= $page - 1 ?>&filter=<?= htmlspecialchars($filter) ?>'">Précédent</button>
                <span class="text-blue-600">Page <?= $page ?> sur <?= $totalPages ?></span>
                <button class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-700 transition" <?= $page >= $totalPages ? 'disabled' : '' ?> onclick="location.href='?page=<?= $page + 1 ?>&filter=<?= htmlspecialchars($filter) ?>'">Suivant</button>
            </div>
        </div>
    </div>

    <!-- Edit Popup -->
    <div id="editPopup" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Modifier le Client</h2>
            <form action="list.php" method="POST" class="flex flex-col">
                <input type="hidden" name="id" id="editId">
                <input type="text" name="name" id="editName" required class="mb-3 p-2 border rounded">
                <input type="email" name="email" id="editEmail" required class="mb-3 p-2 border rounded">
                <input type="text" name="phone" id="editPhone" required class="mb-3 p-2 border rounded">
                <input type="text" name="address" id="editAddress" required class="mb-3 p-2 border rounded">
                <select name="gender" id="editGender" required class="mb-3 p-2 border rounded">
                    <option value="male">Homme</option>
                    <option value="female">Femme</option>
                </select>
                <select name="status" id="editStatus" required class="mb-3 p-2 border rounded">
                    <option value="active">Actif</option>
                    <option value="inactive">Inactif</option>
                </select>
                <div class="flex justify-between">
                    <button type="button" onclick="closeEditPopup()" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 transition">Annuler</button>
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 transition">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notifications -->
    <?php if ($editSuccess) : ?>
        <div class="notification fixed top-5 right-5 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded shadow-lg flex items-center">
            <span class="emoji text-2xl mr-2">🎉</span>
            <p>Client modifié avec succès !</p>
        </div>
    <?php endif; ?>
    <?php if ($deleteSuccess) : ?>
        <div class="notification fixed top-5 right-5 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded shadow-lg flex items-center">
            <span class="emoji text-2xl mr-2">🎉</span>
            <p>Client supprimé avec succès !</p>
        </div>
    <?php endif; ?>
    <?php if ($error) : ?>
        <div class="notification fixed top-5 right-5 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded shadow-lg flex items-center">
            <span class="emoji text-2xl mr-2">❌</span>
            <p><?= $error ?></p>
        </div>
    <?php endif; ?>

    <script>
        function openEditPopup(id, name, email, phone, address, gender, status) {
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPhone').value = phone;
            document.getElementById('editAddress').value = address;
            document.getElementById('editGender').value = gender;
            document.getElementById('editStatus').value = status;
            document.getElementById('editPopup').classList.remove('hidden');
        }

        function closeEditPopup() {
            document.getElementById('editPopup').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.querySelector('.notification');
            if (notification) {
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</body>

</html>
