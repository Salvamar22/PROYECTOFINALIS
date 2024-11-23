<?php
session_start();
require_once '../config/database.php';
require_once '../models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $loginController = new LoginController();

    switch ($action) {
        case 'login':
            $username = $_POST['username'];
            $password = $_POST['password'];
            $loginController->login($username, $password);
            break;
        case 'logout':
            $loginController->logout();
            break;
        case 'checkSession':
            $loginController->isSessionActive();
            break;
    }
}

class LoginController {
    private $model;

    public function __construct() {
        $database = new Database();
        $pdo = $database->connect();
        $this->model = new UserModel($pdo);
    }

    public function login($username, $password) {
        $usuario = $this->model->findByUsername($username);
        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['idUsuario'] = $usuario['idUsuario'];
            $_SESSION['idColaborador'] = $usuario['idColaborador'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['tipoColaborador'] = $usuario['tipoColaborador'];
            
            // Redirigir según tipo de colaborador
            if ($usuario['tipoColaborador'] === 'Administrador') {
                echo json_encode(['status' => 'administrador']);
            } elseif ($usuario['tipoColaborador'] === 'Colaborador') {
                echo json_encode(['status' => 'colaborador']);
            }
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function logout() {
        session_destroy();
        echo json_encode(['status' => 'logged_out']);
    }
    /*
    public function isSessionActive() {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo json_encode(['status' => 'active']);
        } else {
            echo json_encode(['status' => 'inactive']);
        }
    }
    */

    public function isSessionActive() {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // Devolver el tipo de usuario (Administrador o Colaborador) si la sesión está activa
            echo json_encode([
                'status' => 'active',
                'tipoColaborador' => $_SESSION['tipoColaborador']
            ]);
        } else {
            // Devolver que la sesión no está activa
            echo json_encode(['status' => 'inactive']);
        }
    }
    

}

?>