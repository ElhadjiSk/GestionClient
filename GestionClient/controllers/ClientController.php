<?php
class ClientController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function addClient()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = $_POST['fullName'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $status = $_POST['status'] ?? '';

            if ($fullName && $email && $phone && $address && $gender && $status) {
                $success = $this->model->addClient($fullName, $email, $phone, $address, $gender, $status);

                if ($success) {
                    header('Location: index.php?action=addClient&success=true');
                    exit;
                } else {
                    header('Location: index.php?action=addClient&success=false');
                    exit;
                }
            } else {
                // Gérer les erreurs de validation
                header('Location: index.php?action=addClient&success=false');
                exit;
            }
        }
    }

    public function listClients($page, $limit, $filter = '')
    {
        $filter = "%$filter%";
        return $this->model->getClients($page, $limit, $filter);
    }

    public function getClientCount($filter = '')
    {
        $filter = "%$filter%";
        return $this->model->countClients($filter);
    }

    public function updateClient($id, $name, $email, $phone, $address, $gender, $status)
    {
        return $this->model->updateClient($id, $name, $email, $phone, $address, $gender, $status);
    }

    // Méthode pour supprimer un client
    public function deleteClient($id)
    {
        return $this->model->deleteClient($id);
    }
}
