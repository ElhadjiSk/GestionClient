<?php
require_once 'config/Database.php';
require_once 'models/ClientModel.php';
require_once 'controllers/ClientController.php';

$db = (new Database())->getConnection();
$model = new ClientModel($db);
$controller = new ClientController($model);

$action = $_GET['action'] ?? '';

if ($action === 'addClient') {
    $controller->addClient();
}

// Autres actions...

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/Database.php';
require_once 'models/UserModel.php';
require_once 'controllers/AuthController.php';

// Initialisation de la base de données
$database = new Database();
$db = $database->getConnection();

// Initialisation des modèles et contrôleurs
$userModel = new UserModel($db);
$authController = new AuthController($userModel);

// Gestion des actions
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    default:
        // Page par défaut
        session_start();
        if (isset($_SESSION['user_id'])) {
            echo "Utilisateur connecté : " . $_SESSION['username'];
            include 'views/addClientView.php';
        } else {
            echo "Utilisateur non connecté, redirection vers la page de connexion.";
            header('Location: index.php?action=login');
            exit(); // Ajoutez exit() pour vous assurer que le script s'arrête après la redirection
        }
        break;
}
