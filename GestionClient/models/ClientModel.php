<?php
class ClientModel
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addClient($fullName, $email, $phone, $address, $gender, $status) {
        $stmt = $this->db->prepare("INSERT INTO clients (name, email, phone, address, gender, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fullName, $email, $phone, $address, $gender, $status);
        return $stmt->execute();
    }

    public function getClients($page, $limit, $filter = '')
    {
        $offset = ($page - 1) * $limit;
        if ($filter) {
            $filter = "%{$filter}%";
            $stmt = $this->db->prepare("SELECT id, name, email, phone, address, gender, status FROM clients WHERE name LIKE ? LIMIT ? OFFSET ?");
            $stmt->bind_param('sii', $filter, $limit, $offset);
        } else {
            $stmt = $this->db->prepare("SELECT id, name, email, phone, address, gender, status FROM clients LIMIT ? OFFSET ?");
            $stmt->bind_param('ii', $limit, $offset);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function countClients($filter = '')
    {
        if ($filter) {
            $filter = "%{$filter}%";
            $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM clients WHERE name LIKE ?");
            $stmt->bind_param('s', $filter);
        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM clients");
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }

    public function updateClient($id, $name, $email, $phone, $address, $gender, $status)
    {
        $stmt = $this->db->prepare("UPDATE clients SET name = ?, email = ?, phone = ?, address = ?, gender = ?, status = ? WHERE id = ?");
        $stmt->bind_param('ssssssi', $name, $email, $phone, $address, $gender, $status, $id);
        return $stmt->execute();
    }

    // Méthode pour supprimer un client
    public function deleteClient($id) {
        $stmt = $this->db->prepare("DELETE FROM clients WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
