<?php
require_once 'config/Database.php';
require_once 'models/ClientModel.php';
require_once 'controllers/ClientController.php';

$db = (new Database())->getConnection();
$model = new ClientModel($db);
$controller = new ClientController($model);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$limit = 5; // Number of items per page

$totalClients = $controller->getClientCount($filter);
$totalPages = ceil($totalClients / $limit);

$clients = $controller->listClients($page, $limit, $filter);

$editSuccess = false;
$deleteSuccess = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $status = $_POST['status'] ?? '';

    if ($id && $name && $email) {
        $editSuccess = $controller->updateClient($id, $name, $email, $phone, $address, $gender, $status);
    }
}

// Gestion des messages de succès et d'erreur
if (isset($_GET['deleteSuccess']) && $_GET['deleteSuccess'] === 'true') {
    $deleteSuccess = true;
}

if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}

include 'views/clientListView.php';
