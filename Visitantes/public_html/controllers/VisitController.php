<?php

session_start();
//print_r($_SESSION);


error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/../models/VisitModel.php';
require_once __DIR__ . '/../config/database.php';

$action = isset($_POST['action']) ? $_POST['action'] : 'default';
$visitController = new VisitController();

switch ($action) {
        // Acciones de Administrador para tabla Visitantes
    case 'list_guests_for_visit':
        $visitController->visitorsList();
        break;
    case 'list_visits':
        $visitController->visitList();
        break;
    case 'register_visit':
        $visitController->visitRegister();
        break;
    case 'edit_visit':
        //$id = isset($_POST['idVisita']) ? $_POST['idVisita'] : die('Error: ID no proporcionado.');
        //$visitController->visitEdit($id);
        $visitController->visitEdit();
        break;
    case 'delete_visit':
        //$id = isset($_POST['idVisita']) ? $_POST['idVisita'] : die('Error: ID no proporcionado.');
        //$visitController->visitDelete($id);
        $visitController->visitDelete();
        break;
        // Acciones de Colaborador para tabla Visitas
    case 'list_visitor_partner':
        $visitController->visitorsListPartner();
        break;
    case 'list_visits_partner':
        $visitController->visitListPartner();
        break;
    case 'register_partner_visit':
        //$visitController->visitRegisterPartner();
        $visitController->visitRegisterPartner();
        break;
    case 'edit_visit_partner':
        //$id = isset($_POST['idVisita']) ? $_POST['idVisita'] : die('Error: ID no proporcionado.');
        //$visitController->visitEditPartner($id);
        $visitController->visitPartnerEdit();
        break;
    case 'delete_visit_partner':
        //$id = isset($_POST['idVisita']) ? $_POST['idVisita'] : die('Error: ID no proporcionado.');
        //$visitController->visitDeletePartner($id);
        $visitController->visitPartnerDelete();
        break;
}

/**
 * Controlador para la gestión de visitas.
 */
class VisitController
{
    private $model;

    public function __construct()
    {
        // Crear instancias de la conexión PDO
        $database = new Database();
        $pdo = $database->connect();
        $this->model = new VisitModel($pdo);
    }

    /*
    * Funciones para rol de Administrador
    */

    public function dashboard()
    {
        //$partners = $this->model->getAllPartners();
        include "views/dashboard.php";
    }
    /*
    public function visitorsList()
    {
        $guests = $this->model->getAllGuests();
        include "C:/xampp/htdocs/Project2/views/visit/visitForm.php";
    }
    */
    public function visitorsList()
    {
        $visits = $this->model->getAllGuests();

        // Generamos las opciones para el select
        $options = ''; //= '<option value="">Selecciona una categoría</option>'
        foreach ($visits as $visit) {
            $options .= '<option value="' . $visit['idVisitante'] . '">' . $visit['nombre'] . '</option>';
        }

        echo $options;
    }

    public function visitList()
    {
        //$visits = $this->model->getAllVisits();
        //include "C:/xampp/htdocs/Project2/views/visit/visitList.php";
        $visitsList = $this->model->getAllVisits();
        echo json_encode($visitsList);
    }

    public function visitRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'idColaborador' => $_SESSION['idColaborador'],
                'idVisitante' => $_POST['visitGuestInput'],
                'asunto' => $_POST['visitSubjectInput'],
                'comentario' => $_POST['visitNoteInput'],
                'cantidad' => $_POST['visitNumberInput'],
                'fechaVisita' => date("Y-m-d"),
            ];

            try {
                $response = $this->model->createVisit($data);
                return $response;
            } catch (PDOException $e) {
                echo "Error al insertar: " . $e->getMessage();
            }
        } else {
            echo "Acceso denegado.";
        }
    }
    /*
    public function visitEdit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'asunto' => $_POST['visitSubjectInput'],
                'comentario' => $_POST['visitNoteInput'],
            ];
            $this->model->updateVisit($id, $data);
            $this->visitList();
        } else {
            $partner = $this->model->getVisitById($id);
            include "views/visit/visitForm.php";
        }
    }
    */
    // Función para actualizar la información de un Colaborador
    public function visitEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y procesar los datos del formulario
            $data = $_POST["data"];
            $id = $data['id'];
            $subject = $data['subject'];
            $note = $data['note'];
            $number = $data['number'];

            $data = [
                'idVisita' => $id,
                'asunto' => $subject,
                'comentario' => $note,
                'cantidad' => $number
            ];

            // Llamar al método del modelo para actualizar datos de la Visita
            $response = $this->model->updateVisit($data);

            // Devolver una respuesta al cliente (puede ser JSON o simplemente un mensaje de texto)
            echo $response;
        }
    }
    /*
    public function visitDelete($id)
    {
        $this->model->deleteVisit($id);
        $this->visitList();
    }
    */
    public function visitDelete()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y procesar los datos del formulario
            $id = $_POST["id"];

            // Llamar al método del modelo para eliminar registro de visita
            $response = $this->model->deleteVisit($id);

            // Devolver una respuesta al cliente (puede ser JSON o simplemente un mensaje de texto)
            echo $response;
        }
    }

    /*
    * Funciones para rol de Colaborador
    */

    public function visitorsListPartner()
    {
        $guests = $this->model->getAllGuests();
        include "C:/xampp/htdocs/Project2/views/visit/visitPartnerForm.php";
    }

    public function visitListPartner()
    {
        //$visits = $this->model->getAllVisits();
        //include "C:/xampp/htdocs/Project2/views/visit/visitPartnerList.php";
        $visitsList = $this->model->getAllVisits();
        echo json_encode($visitsList);
    }

    public function visitRegisterPartner()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'idColaborador' => $_SESSION['idColaborador'],
                'idVisitante' => $_POST['visitGuestInput'],
                'asunto' => $_POST['visitSubjectInput'],
                'comentario' => $_POST['visitNoteInput'],
                'cantidad' => $_POST['visitNumberInput'],
                'fechaVisita' => date("Y-m-d"),
            ];

            try {
                $response = $this->model->createVisit($data);
                echo $response;
            } catch (PDOException $e) {
                echo "Error al insertar: " . $e->getMessage();
            }
        } else {
            echo "Acceso denegado.";
        }
    }

    // Función para actualizar la información de un Colaborador
    public function visitPartnerEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y procesar los datos del formulario
            $data = $_POST["data"];
            $id = $data['id'];
            $subject = $data['subject'];
            $note = $data['note'];
            $number = $data['number'];

            $data = [
                'idVisita' => $id,
                'asunto' => $subject,
                'comentario' => $note,
                'cantidad' => $number
            ];

            // Llamar al método del modelo para actualizar datos de la Visita
            $response = $this->model->updateVisit($data);

            // Devolver una respuesta al cliente (puede ser JSON o simplemente un mensaje de texto)
            echo $response;
        }
    }

    public function visitPartnerDelete()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y procesar los datos del formulario
            $id = $_POST["id"];

            // Llamar al método del modelo para eliminar registro de visita
            $response = $this->model->deleteVisit($id);

            // Devolver una respuesta al cliente (puede ser JSON o simplemente un mensaje de texto)
            echo $response;
        }
    }

    public function visitEditPartner($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'asunto' => $_POST['visitSubjectInput'],
                'comentario' => $_POST['visitNoteInput'],
            ];
            $this->model->updateVisit($id, $data);
            $this->visitList();
        }
    }

    public function visitDeletePartner($id)
    {
        $this->model->deleteVisit($id);
        $this->visitList();
    }
}
