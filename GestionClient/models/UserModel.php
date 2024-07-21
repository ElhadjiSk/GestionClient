<?php
class UserModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function createClient($fullName, $email, $phone, $address, $gender, $status)
    {
        $sql = "INSERT INTO clients (full_name, email, phone, address, gender, status) VALUES (:full_name, :email, :phone, :address, :gender, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':full_name', $fullName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }


    public function getUserByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        if ($stmt === false) {
            throw new Exception("Erreur de préparation de la requête SQL : " . $this->db->error);
        }
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user === null) {
            echo "Aucun utilisateur trouvé avec le nom d'utilisateur : $username";
        }

        return $user;
    }

    public function createUser($username, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt === false) {
            throw new Exception("Erreur de préparation de la requête SQL : " . $this->db->error);
        }
        $stmt->bind_param('ss', $username, $passwordHash);
        return $stmt->execute();
    }
}
