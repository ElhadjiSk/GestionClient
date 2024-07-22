<?php
class AuthController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            try {
                $user = $this->userModel->getUserByUsername($username);
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

            if ($user) {
                echo "Mot de passe haché de la base de données : " . $user['password'];
                echo "Mot de passe saisi par l'utilisateur : " . $password;
                
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    echo "Connexion réussie ! Redirection...";
                    header('Location: index.php');
                    exit();
                } else {
                    echo "Le mot de passe ne correspond pas.";
                    $error = "Nom d'utilisateur ou mot de passe incorrect.";
                    include 'GestionClient\views\loginView.php';
                }
            } else {
                echo "Utilisateur non trouvé.";
                $error = "Nom d'utilisateur ou mot de passe incorrect.";
                include 'GestionClient\views\loginView.php';
            }
        } else {
            include 'GestionClient\views\loginView.php';
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
