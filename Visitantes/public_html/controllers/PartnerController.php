<?php
//session_start();
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

require_once __DIR__ . '/../models/PartnerModel.php';
require_once __DIR__ . '/../config/database.php';

$action = isset($_POST['action']) ? $_POST['action'] : 'default';
$partnerController = new PartnerController();

switch ($action) {
        // Acciones de Administrador para tabla colaboradores
    case 'form_partner':
        $partnerController->form();
        break;
    case 'list_partners':
        $partnerController->list();
        break;
    case 'register_partner':
        $partnerController->register();
        break;
    case 'edit_partner':
        //$id = isset($_POST['inputEditIdPartner']) ? $_POST['inputEditIdPartner'] : die('Error: ID no proporcionado.');
        $partnerController->editPartner();
        break;
    case 'delete_partner':
        //$id = isset($_POST['id']) ? $_POST['id'] : die('Error: ID no proporcionado.');
        $partnerController->delete();
        break;
    default:
        /*
        header("Location: login.php");
        exit();
        */
}

/**
 * Controlador para la gestión de colaboradores.
 */
class PartnerController
{
    private $model;

    public function __construct()
    {
        // Crear instancias de la conexión PDO
        $database = new Database();
        $pdo = $database->connect();
        $this->model = new PartnerModel($pdo);
    }

    public function form()
    {
        include __DIR__ . "/../views/partner/partnerForm.php";
    }

    public function list()
    {
        $partnerList = $this->model->getAllPartners();
        echo json_encode($partnerList);
        //return json_encode($partnerList);
        //$partners = $this->model->getAllPartners();
        //include "/public_html/views/partner/partnerList.php";
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombres' => $_POST['inputNamePartner'],
                'apellidos' => $_POST['inputLastNamePartner'],
                'dui' => $_POST['inputDuiPartner'],
                'direccion' => $_POST['inputAddressPartner'],
                'correo' => $_POST['inputEmailPartner'],
                'celular' => $_POST['inputPhonePartner'],
                'fechaNacimiento' => $_POST['inputDateBirthPartner'],
                'fechaContratacion' => date("Y-m-d"),
            ];

            try {
                $response = $this->model->createPartner($data);
                return $response;
            } catch (PDOException $e) {
                echo "Error al insertar: " . $e->getMessage();
            }
        } else {
            echo "Acceso denegado.";
        }
    }
    /*
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombres' => $_POST['inputNamePartner'],
                'apellidos' => $_POST['inputLastNamePartner'],
                'dui' => $_POST['inputDuiPartner'],
                'direccion' => $_POST['inputAddressPartner'],
                'correo' => $_POST['inputEmailPartner'],
                'celular' => $_POST['inputPhonePartner'],
                'fechaNacimiento' => $_POST['inputDateBirthPartner'],
            ];
            $this->model->updatePartner($id, $data);
            $this->list();
        } else {
            echo "Acceso denegado.";
        }
    }
    */

    // Función para actualizar la información de un Colaborador
    public function editPartner()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y procesar los datos del formulario
            $data = $_POST["data"];
            $id = $data['id'];
            $name = $data['name'];
            $lastName = $data['lastName'];
            $dui = $data['dui'];
            $address = $data['address'];
            $email = $data['email'];
            $phone = $data['phone'];
            $dateBirth = $data['dateBirth'];

            // Llamar al método del modelo para actualizar datos del Colaborador
            $response = $this->model->updatePartnerInfo($id, $name, $lastName, $dui, $address, $email, $phone, $dateBirth);

            // Devolver una respuesta al cliente (puede ser JSON o simplemente un mensaje de texto)
            echo $response;
        }
    }

    public function delete()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y procesar los datos del formulario
            $id = $_POST["id"];
            //var_dump($id);
            //exit();
            
            // Llamar al método del modelo para actualizar datos del Colaborador
            $response = $this->model->deletePartner($id);

            // Devolver una respuesta al cliente (puede ser JSON o simplemente un mensaje de texto)
            echo $response;
            
        }
    }
}
