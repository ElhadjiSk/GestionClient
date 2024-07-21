<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="bg-gray-800 p-4">
    <ul class="flex items-center justify-between">
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="index.php" class="text-white px-3 py-2 rounded-md text-sm font-medium">Accueil</a></li>
            <li><a href="index.php" class="text-white mr-4 hover:text-gray-300">Ajouter un Client</a></li>
            <li><a href="list.php" class="text-white hover:text-gray-300">Liste des Clients</a></li>
            <li><a href="index.php?action=logout" class="text-white px-3 py-2 rounded-md text-sm font-medium">Déconnexion (<?php echo $_SESSION['username']; ?>)</a></li>
        <?php else: ?>
            <li><a href="index.php?action=login" class="text-white px-3 py-2 rounded-md text-sm font-medium">Connexion</a></li>
        <?php endif; ?>
    </ul>
</nav>
