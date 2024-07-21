<?php
$success = isset($_GET['success']) ? $_GET['success'] === 'true' : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.querySelector('.notification');
            if (notification) {
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</head>

<body class="bg-gray-100">
    <?php include 'navbar.php'; ?>
    <div class="flex justify-center items-center min-h-screen px-4">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
            <h1 class="text-3xl font-semibold text-blue-600 mb-6 text-center">Ajouter un Client</h1>
            <form action="index.php?action=addClient" method="post" class="space-y-4">
                <div>
                    <label for="fullName" class="block text-sm font-medium text-gray-700">Nom Complet</label>
                    <input type="text" id="fullName" name="fullName" placeholder="Nom Complet" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" id="phone" name="phone" placeholder="Téléphone" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                    <input type="text" id="address" name="address" placeholder="Adresse" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Sexe</label>
                    <select id="gender" name="gender" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="" disabled selected>Sélectionner le sexe</option>
                        <option value="male">Homme</option>
                        <option value="female">Femme</option>
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                    <select id="status" name="status" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="active">Actif</option>
                        <option value="inactive">Inactif</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Ajouter
                        Client</button>
                </div>
            </form>

            <?php if ($success === true) : ?>
                <div class="notification fixed top-5 right-5 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md shadow-lg flex items-center">
                    <span class="text-2xl mr-2">🎉</span>
                    <p>Client ajouté avec succès !</p>
                </div>
            <?php elseif ($success === false) : ?>
                <div class="notification fixed top-5 right-5 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-md shadow-lg flex items-center">
                    <span class="text-2xl mr-2">⚠️</span>
                    <p>Erreur lors de l'ajout du client.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
