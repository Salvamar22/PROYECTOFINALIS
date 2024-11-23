<?php
//session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../config/database.php';

$action = isset($_POST['action']) ? $_POST['action'] : 'default';
$userController = new UserController();
/*
if ($action !== 'login' && $action !== 'logout' && $action !== 'admin' && !isset($_SESSION['idColaborador'])) {
    echo "No autorizado"; // Puedes manejar esto de la manera que desees
    return;
}
*/
switch ($action) {
        // Accion general para mostrar Contador total de Visitas
    case 'count':
        $userController->count();
        break;
        // Acciones de Administrador para tabla usuarios
    case 'login':
        $userController->login();
        break;
    case 'logout':
        $userController->logout();
        break;
    case 'checkSession':
        //$userController->checkSession();
        $userController->isSessionActive();
        break;
    case 'admin':
        $userController->getAdminDashboard();
        break;
    case 'partner':
        $userController->getPartnerDashboard();
        break;
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
        //$id = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : die('Error: ID no proporcionado.');
        $userController->userEdit();
        break;
    case 'edit_user_pass':
            //$id = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : die('Error: ID no proporcionado.');
            $userController->userPassEdit();
            break;
    case 'delete_user':
        //$id = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : die('Error: ID no proporcionado.');
        $userController->userDelete();
        break;
        /*
    default:
        echo "Acción no válida";
        break;
        */
}

/**
 * Controlador para la gestión de usuarios.
 */
class UserController
{
    private $model;

    public function __construct()
    {
        // Crear instancias de la conexión PDO
        $database = new Database();
        $pdo = $database->connect();
        $this->model = new UserModel($pdo);
    }

    public function count()
    {
        $count = $this->model->getCount();
        echo json_encode($count);
    }
    
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['usernameLoginInput'];
            $password = $_POST['passwordLoginInput'];

            $user = $this->model->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                // Usuario autenticado correctamente
                // Guardar información del usuario en la sesión, cookie o como sea necesario
                session_start();
                $_SESSION['idUsuario'] = $user['idUsuario'];
                $_SESSION['idColaborador'] = $user['idColaborador'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['tipoColaborador'] = $user['tipoColaborador'];

                // Redireccionar a la página principal o a la página correspondiente al rol
                if ($_SESSION['tipoColaborador'] == 'Administrador') {
                    echo "Administrador";
                } elseif ($_SESSION['tipoColaborador'] == 'Colaborador') {
                    echo "Colaborador";
                } else {
                    // Rol no reconocido
                    echo "Ninguno";
                }
            } else {
                // Usuario o contraseña incorrectos
                $errorMessage = "Usuario o contraseña incorrectos.";
                echo $errorMessage;
            }

        } else {
            // Acceso directo al controlador sin POST
            header('Location: login.php');
            exit();
        }
    }

    public function logout()
    {
        // Cerrar sesión y redirigir a la página de inicio
        session_start();
        session_unset();
        session_destroy();
        //header("Location: login.php");
        //exit();
    }

    public function logout2()
    {
        session_destroy();
        echo json_encode(['status' => 'logged_out']);
    }

    public function isSessionActive()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo json_encode(['status' => 'active']);
        } else {
            echo json_encode(['status' => 'inactive']);
        }
    }

    /*
    public function checkSession()
    {
        session_start();
        if (isset($_SESSION['idColaborador'])) {
            echo json_encode([
                'status' => 'logged_in',
                'tipoColaborador' => $_SESSION['tipoColaborador']
            ]);
        } else {
            echo json_encode(['status' => 'logged_out']);
        }
    }
    */
    public function checkSession()
    {
        session_start();
        if (isset($_SESSION['idColaborador']) && isset($_SESSION['tipoColaborador'])) {
            echo json_encode([
                'status' => 'logged_in',
                'tipoColaborador' => $_SESSION['tipoColaborador']
            ]);
        } else {
            echo json_encode(['status' => 'logged_out']);
        }
    }


    // Procesar los datos del panel de Administrador en HTML

    public function getAdminDashboard()
    {
        $dashboardData = $this->model->getDashboardData();
        $visitasDia = isset($dashboardData['total_visitas_dia']) ? $dashboardData['total_visitas_dia'] : 0;
        $visitasSemana = isset($dashboardData['total_visitas_semana']) ? $dashboardData['total_visitas_semana'] : 0;
        $visitasMes = isset($dashboardData['total_visitas_mes']) ? $dashboardData['total_visitas_mes'] : 0;

        // Estadísticas de visitas
        $html = '<div class="row">';
        $html .= '<div class="col-md-4 mb-2">';
        $html .= '<div class="card">';
        $html .= '<div class="card-header">';
        $html .= '<h5 class="card-title"><i class="fa-solid fa-calendar-day"></i> Visitas este d&iacute;a</h5>';
        $html .= '</div>';
        $html .= '<div class="card-body">';
        $html .= '<h1 class="display-1"> ' . $visitasDia . '</h1>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-md-4 mb-2">';
        $html .= '<div class="card">';
        $html .= '<div class="card-header">';
        $html .= '<h5 class="card-title"><i class="fa-solid fa-calendar-week"></i> Visitas esta semana</h5>';
        $html .= '</div>';
        $html .= '<div class="card-body">';
        $html .= '<h1 class="display-1">' . $visitasSemana . '</h1>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-md-4 mb-2">';
        $html .= '<div class="card">';
        $html .= '<div class="card-header">';
        $html .= '<h5 class="card-title"><i class="fa-regular fa-calendar"></i> Visitas este mes</h5>';
        $html .= '</div>';
        $html .= '<div class="card-body">';
        $html .= '<h1 class="display-1">' . $visitasMes . '</h1>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        // Totales registrados
        $html .= '<div class="row">';
        $html .= '<div class="col-md-4 mb-2">';
        $html .= '<div class="card">';
        $html .= '<div class="card-header">';
        $html .= '<h5 class="card-title"><i class="fa-regular fa-user"></i> Total de Usuarios</h5>';
        $html .= '</div>';
        $html .= '<div class="card-body">';
        $html .= '<h1 class="display-1">' . $dashboardData['total_usuarios'] . '</h1>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-md-4 mb-2">';
        $html .= '<div class="card">';
        $html .= '<div class="card-header">';
        $html .= '<h5 class="card-title"><i class="fa-solid fa-id-card-clip"></i> Total de Visitantes</h5>';
        $html .= '</div>';
        $html .= '<div class="card-body">';
        $html .= '<h1 class="display-1">' . $dashboardData['total_visitantes'] . '</h1>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-md-4 mb-2">';
        $html .= '<div class="card">';
        $html .= '<div class="card-header">';
        $html .= '<h5 class="card-title"><i class="fa-solid fa-clipboard-list"></i> Total de Visitas</h5>';
        $html .= '</div>';
        $html .= '<div class="card-body">';
        $html .= '<h1 class="display-1">' . $dashboardData['total_visitas'] . '</h1>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    // Procesar los datos del panel de Colaborador en HTML

    public function getPartnerDashboard()
    {
        $dashboardData = $this->model->getPartnerDashboard();
        $totalVisitantes = isset($dashboardData['total_visitantes']) ? $dashboardData['total_visitantes'] : 0;
        $totalVisitas = isset($dashboardData['total_visitas']) ? $dashboardData['total_visitas'] : 0;
        $totalVisitasDia = isset($dashboardData['total_visitas_dia']) ? $dashboardData['total_visitas_dia'] : 0;

        // Estadísticas de visitas
        $html = '<div class="row">';
        $html .= '<div class="col-md-4 mb-2">';
        $html .= '<div class="card">';
        $html .= '<div class="card-header">';
        $html .= '<h5 class="card-title"><i class="fa-solid fa-id-card-clip"></i> Total Visitantes</h5>';
        $html .= '</div>';
        $html .= '<div class="card-body">';
        $html .= '<h1 class="display-1"> ' . $totalVisitantes . '</h1>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-md-4 mb-2">';
        $html .= '<div class="card">';
        $html .= '<div class="card-header">';
        $html .= '<h5 class="card-title"><i class="fa-solid fa-clipboard-list"></i> Total Visitas</h5>';
        $html .= '</div>';
        $html .= '<div class="card-body">';
        $html .= '<h1 class="display-1">' . $totalVisitas . '</h1>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-md-4 mb-2">';
        $html .= '<div class="card">';
        $html .= '<div class="card-header">';
        $html .= '<h5 class="card-title"><i class="fa-solid fa-calendar-day"></i> Visitas este d&iacute;a</h5>';
        $html .= '</div>';
        $html .= '<div class="card-body">';
        $html .= '<h1 class="display-1">' . $totalVisitasDia . '</h1>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    /*
    public function admin()
    {
        $dashboardData = $this->model->getDashboardData();
        include "../views/admin.php";
    }
    */
    /*
    public function partner()
    {
        $dashboardData = $this->model->getPartnerDashboard();
        include "../views/partner.php";
    }
    */
    public function partnersWithoutUserList()
    {
        $partners = $this->model->getPartnersWithoutUser();

        // Generamos las opciones para el select
        $options = ''; //= '<option value="">Selecciona una categoría</option>'
        foreach ($partners as $partner) {
            $options .= '<option value="' . $partner['idColaborador'] . '">' . $partner['nombres'] . ' ' . $partner['apellidos'] . '</option>';
        }

        echo $options;
        //include "../views/user/userForm.php";
    }

    public function userList()
    {
        $users = $this->model->getAllUsers();
        echo json_encode($users);
        //include "../views/user/userList.php";
        //include __DIR__ . "/../views/user/userList.php";
    }

    public function userRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'idColaborador' => $_POST['userPartnerInput'],
                'username' => $_POST['userNameInput'],
                'password' => password_hash($_POST['userPassInput'], PASSWORD_DEFAULT),
                'tipoColaborador' => $_POST['userTypeInput'],
            ];
            try {
                $response = $this->model->createUser($data);
                echo $response;
                //$this->userList();
            } catch (PDOException $e) {
                echo "Error al insertar: " . $e->getMessage();
            }

            //include "../views/guest/guestForm.php";
        }
    }

    public function userEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validar y procesar los datos del formulario
            $data = $_POST["data"];
            $idUsuario = $data['id'];
            $user = $data['user'];
            //$pass = password_hash($data['pass'], PASSWORD_DEFAULT);
            $type = $data['type'];

            //$response = $this->model->updateUserInfo($idUsuario, $user, $pass, $type);
            $response = $this->model->updateUserInfo($idUsuario, $user, $type);
            echo $response;
            //$this->userList();
        }
    }

    public function userPassEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validar y procesar los datos del formulario
            $data = $_POST["data"];
            $idUsuario = $data['id'];
            $pass = password_hash($data['pass'], PASSWORD_DEFAULT);

            $response = $this->model->updatePassInfo($idUsuario, $pass);
            echo $response;
            //$this->userList();
        }
    }

    public function userDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validar el dato del formulario
            $idUsuario = $_POST["id"];

            $response = $this->model->deleteUser($idUsuario);
            echo $response;
            //$this->userList();
        }
    }
}
