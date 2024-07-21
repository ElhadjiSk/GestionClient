<?php
require_once '../config/Database.php';
require_once '../models/ClientModel.php';
require_once '../controllers/ClientController.php';

// Initialiser les objets de modèle et de contrôleur
$database = new Database();
$db = $database->getConnection();
$model = new ClientModel($db);
$controller = new ClientController($model);

// Obtenir l'ID du client à supprimer
$id = $_GET['id'] ?? null;

if ($id) {
    if ($controller->deleteClient($id)) {
        // Rediriger vers la liste des clients avec un message de succès
        header('Location: /list.php?deleteSuccess=true');
        exit;
    } else {
        // Rediriger avec un message d'erreur
        header('Location: /list.php?error=Unable to delete client');
        exit;
    }
} else {
    // Rediriger avec un message d'erreur si l'ID n'est pas fourni
    header('Location: /list.php?error=Client ID is missing');
    exit;
}
