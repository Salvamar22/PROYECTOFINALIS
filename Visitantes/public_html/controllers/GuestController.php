<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
require_once __DIR__ . '/../models/GuestModel.php';
require_once __DIR__ . '/../config/database.php';

$action = isset($_POST['action']) ? $_POST['action'] : 'default';
$guestController = new GuestController();

switch ($action) {
        // Acciones de Administrador para tabla visitantes
    case 'list_guests':
        $guestController->guestList();
        break;
    case 'register_guest':
        $guestController->guestRegister();
        break;
    case 'edit_guest':
        $guestController->guestEdit();
        break;
    case 'delete_guest':
        $guestController->guestDelete();
        break;
        // Acciones de Colaborador para tabla visitantes
    case 'list_partner_guest':
        $guestController->guestPartnerList();
        break;
    case 'register_partner_guest':
        $guestController->guestPartnerRegister();
        break;
    case 'edit_partner_guest':
        $guestController->guestPartnerEdit();
        break;
    case 'delete_partner_guest':
        $guestController->guestPartnerDelete();
        break;
    default:
        /*
        header("Location: login.php");
        exit();
        */
}

/**
 * Controlador para la gestión de visitantes.
 */
class GuestController
{
    private $model;

    public function __construct()
    {
        // Crear instancias de la conexión PDO
        $database = new Database();
        $pdo = $database->connect();
        $this->model = new GuestModel($pdo);
    }

    /*
    * Funciones para rol de Administrador
    */

    public function guestList()
    {
        $guests = $this->model->getAllGuests();
        echo json_encode($guests);
    }

    public function guestRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['guestNameInput'],
                'correo' => $_POST['guestEmailInput'],
                'asunto' => $_POST['guestSubjectInput'],
                'comentario' => $_POST['guestNoteInput'],
                'fechaVisita' => date("Y-m-d"),
            ];
            try {
                $this->model->createGuest($data);
                //$this->guestList();
            } catch (PDOException $e) {
                echo "Error al insertar: " . $e->getMessage();
            }
        } else {
            echo "Acceso denegado.";
        }
    }

    // Función para actualizar la información de un Visitante
    public function guestEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y procesar los datos del formulario
            $data = $_POST["data"];
            $id = $data['id'];
            $name = $data['name'];
            $email = $data['email'];
            $subject = $data['subject'];
            $note = $data['note'];

            //var_dump($data);
            //exit();

            // Llamar al método del modelo para actualizar datos del Visitante
            $response = $this->model->updateGuest($id, $name, $email, $subject, $note);

            // Devolver una respuesta al cliente (puede ser JSON o simplemente un mensaje de texto)
            echo $response;
        }
    }

    public function guestDelete()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y procesar los datos del formulario
            $id = $_POST["id"];

            // Llamar al método del modelo para actualizar datos del Visitante
            $response = $this->model->deleteGuest($id);

            // Devolver una respuesta al cliente (puede ser JSON o simplemente un mensaje de texto)
            echo $response;
        }
    }

    /*
    * Funciones para rol de Colaborador
    */

    public function guestPartnerList()
    {
        $guests = $this->model->getAllGuests();
        echo json_encode($guests);
    }

    public function guestPartnerRegister()
    {
        /*
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['guestNameInputPartner'],
                'correo' => $_POST['guestEmailInputPartner'],
                'asunto' => $_POST['guestSubjectInputPartner'],
                'comentario' => $_POST['guestNoteInputPartner'],
                'fechaVisita' => date("Y-m-d"),
            ];
            try {
                $this->model->createGuest($data);
                //$this->guestList();
            } catch (PDOException $e) {
                echo "Error al insertar: " . $e->getMessage();
            }
        } else {
            echo "Acceso denegado.";
        }
        */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['guestNameInput'],
                'correo' => $_POST['guestEmailInput'],
                'asunto' => $_POST['guestSubjectInput'],
                'comentario' => $_POST['guestNoteInput'],
                'fechaVisita' => date("Y-m-d"),
            ];
            try {
                $this->model->createGuest($data);
            } catch (PDOException $e) {
                echo "Error al insertar: " . $e->getMessage();
            }
        } else {
            echo "Acceso denegado.";
        }

    }
    /*
    public function guestEditPartner($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['guestNameInputPartner'],
                'correo' => $_POST['guestEmailInputPartner'],
                'asunto' => $_POST['guestSubjectInputPartner'],
                'comentario' => $_POST['guestNoteInputPartner'],
            ];
            $this->model->updateGuestPartner($id, $data);
            $this->guestListPartner();
        }
    }
    */
    // Función para actualizar la información de un Visitante
    public function guestPartnerEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y procesar los datos del formulario
            $data = $_POST["data"];
            $id = $data['id'];
            $name = $data['name'];
            $email = $data['email'];
            $subject = $data['subject'];
            $note = $data['note'];

            //var_dump($data);
            //exit();

            // Llamar al método del modelo para actualizar datos del Visitante
            $response = $this->model->updateGuest($id, $name, $email, $subject, $note);

            // Devolver una respuesta al cliente (puede ser JSON o simplemente un mensaje de texto)
            echo $response;
        }
    }

    public function guestPartnerDelete()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y procesar los datos del formulario
            $id = $_POST["id"];

            // Llamar al método del modelo para actualizar datos del Visitante
            $response = $this->model->deleteGuest($id);

            // Devolver una respuesta al cliente (puede ser JSON o simplemente un mensaje de texto)
            echo $response;
        }
    }
}
