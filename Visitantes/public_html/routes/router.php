<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once '../config/database.php';
require_once '../controllers/PartnerController.php';
require_once '../controllers/UserController.php';
require_once '../controllers/GuestController.php';
require_once '../controllers/VisitController.php';

// Crear instancias de la conexión PDO
$database = new Database();
$pdo = $database->connect();

// Crear instancias de los Controllers
$partnerController = new PartnerController($pdo);
$userController = new UserController($pdo);
$guestController = new GuestController($pdo);
$visitController = new VisitController($pdo);

if ($pdo) {

    //$action = isset($_POST['action']) ? $_POST['action'] : 'dashboard';
    $action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'default');

    switch ($action) {
        // Acciones de Administrador para tabla colaboradores
        /*
        case 'form_partner':
            $partnerController->form();
            break;
        case 'list_partners':
            $partnerController->list();
            break;
        case 'register_partner':
            $partnerController->register();
            break;
            */
            /*
        case 'edit_partner':
            $id = isset($_POST['id']) ? $_POST['id'] : die('Error: ID no proporcionado.');
            $partnerController->edit();
            break;
        case 'delete_partner':
            $id = isset($_POST['id']) ? $_POST['id'] : die('Error: ID no proporcionado.');
            $partnerController->delete($id);
            break;
            */
            // Acciones de Administrador para tabla usuarios
            /*
        case 'login':
            $userController->login();
            break;
        case 'logout':
            $userController->logout();
            break;
        case 'admin':
            $userController->admin();
            break;
            */
            /*
        case 'partner':
            $userController->partner();
            break;
            */
            /*
        case 'list_partners_wo_user':
            $userController->partnersWithoutUserList();
            break;
        case 'list_users':
            $userController->userList();
            break;
        case 'register_user':
            $userController->userRegister();
            break;
        case 'edit_user':
            $id = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : die('Error: ID no proporcionado.');
            $userController->userEdit($id);
            break;
        case 'delete_user':
            $id = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : die('Error: ID no proporcionado.');
            $userController->userDelete($id);
            break;
            */
            // Acciones de Administrador para tabla visitantes
            /*
        case 'list_guests':
            $guestController->guestList();
            break;
        case 'register_guest':
            $guestController->guestRegister();
            break;
        case 'edit_guest':
            $id = isset($_POST['idVisitante']) ? $_POST['idVisitante'] : die('Error: ID no proporcionado.');
            //$guestController->guestEdit($id);
            break;
        case 'delete_guest':
            $id = isset($_POST['idVisitante']) ? $_POST['idVisitante'] : die('Error: ID no proporcionado.');
            //$guestController->guestDelete($id);
            break;
            */
            // Acciones de Administrador para tabla visitas
            /*
        case 'list_visitor':
            $visitController->visitorsList();
            break;
        case 'list_visits':
            $visitController->visitList();
            break;
        case 'register_visit':
            $visitController->visitRegister();
            break;
        case 'edit_visit':
            $id = isset($_POST['idVisita']) ? $_POST['idVisita'] : die('Error: ID no proporcionado.');
            $visitController->visitEdit($id);
            break;
        case 'delete_visit':
            $id = isset($_POST['idVisita']) ? $_POST['idVisita'] : die('Error: ID no proporcionado.');
            $visitController->visitDelete($id);
            break;
            */
        // Acciones de Colaborador para tabla visitantes
        /*
        case 'list_guests_partner':
            $guestController->guestListPartner();
            break;
        case 'register_guest_partner':
            $guestController->guestRegisterPartner();
            break;
        case 'edit_guest_partner':
            $id = isset($_POST['idVisitante']) ? $_POST['idVisitante'] : die('Error: ID no proporcionado.');
            $guestController->guestEditPartner($id);
            break;
        case 'delete_guest_partner':
            $id = isset($_POST['idVisitante']) ? $_POST['idVisitante'] : die('Error: ID no proporcionado.');
            $guestController->guestDeletePartner($id);
            break;
            // Acciones de Colaborador para tabla visitas
        case 'list_visitor_partner':
            $visitController->visitorsListPartner();
            break;
        case 'list_visits_partner':
            $visitController->visitListPartner();
            break;
        case 'register_visit_partner':
            $visitController->visitRegisterPartner();
            break;
        case 'edit_visit_partner':
            $id = isset($_POST['idVisita']) ? $_POST['idVisita'] : die('Error: ID no proporcionado.');
            $visitController->visitEditPartner($id);
            break;
        case 'delete_visit_partner':
            $id = isset($_POST['idVisita']) ? $_POST['idVisita'] : die('Error: ID no proporcionado.');
            $visitController->visitDeletePartner($id);
            break;
            */
        default:
            /*
            header("Location: login.php");
            exit();
            */
    }
} else {
    // Manejar el caso en que la conexión PDO no se ha obtenido correctamente
    die("Error al obtener la conexión PDO");
}
