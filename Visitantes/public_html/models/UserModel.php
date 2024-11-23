<?php
//session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


/**
 * Modelo para la gestión de usuarios.
 */
class UserModel
{
  private $pdo;

  public function __construct(PDO $database)
  {
    $this->pdo = $database;
  }

  public function getCount()
  {
    // Total Visitas Registradas
    $sql = "SELECT SUM(cantidad) AS total_visitas FROM visitas";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getDashboardData()
  {
    $dashboardData = [];

    // Total usuarios Registrados

    $sqlTotalUsuarios = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
    $stmtTotalUsuarios = $this->pdo->prepare($sqlTotalUsuarios);
    $stmtTotalUsuarios->execute();
    $dashboardData['total_usuarios'] = $stmtTotalUsuarios->fetch(PDO::FETCH_ASSOC)['total_usuarios'];

    // Total visitantes Registrados

    $sqlTotalVisitantes = "SELECT COUNT(*) AS total_visitantes FROM visitantes";
    $stmtTotalVisitantes = $this->pdo->prepare($sqlTotalVisitantes);
    $stmtTotalVisitantes->execute();
    $dashboardData['total_visitantes'] = $stmtTotalVisitantes->fetch(PDO::FETCH_ASSOC)['total_visitantes'];

    // Total visitas Registradas

    $sqlTotalVisitas = "SELECT SUM(cantidad) AS total_visitas FROM visitas";
    $stmtTotalVisitas = $this->pdo->prepare($sqlTotalVisitas);
    $stmtTotalVisitas->execute();
    $dashboardData['total_visitas'] = $stmtTotalVisitas->fetch(PDO::FETCH_ASSOC)['total_visitas'];

    // Total de visitas por día, semana y mes
    $sqlTotalVisitsPerDay = "SELECT SUM(cantidad) AS total_visitas_dia
                              FROM visitas
                              WHERE DATE(fechaVisita) = CURDATE()";
    $stmtTotalVisitsPerDay = $this->pdo->prepare($sqlTotalVisitsPerDay);
    $stmtTotalVisitsPerDay->execute();
    $dashboardData['total_visitas_dia'] = $stmtTotalVisitsPerDay->fetch(PDO::FETCH_ASSOC)['total_visitas_dia'];

    $sqlTotalVisitsPerWeek = "SELECT SUM(cantidad) AS total_visitas_semana
                                FROM visitas
                                WHERE YEARWEEK(fechaVisita) = YEARWEEK(NOW())";
    $stmtTotalVisitsPerWeek = $this->pdo->prepare($sqlTotalVisitsPerWeek);
    $stmtTotalVisitsPerWeek->execute();
    $dashboardData['total_visitas_semana'] = $stmtTotalVisitsPerWeek->fetch(PDO::FETCH_ASSOC)['total_visitas_semana'];

    $sqlTotalVisitsPerMonth = "SELECT SUM(cantidad) AS total_visitas_mes
                                FROM visitas
                                WHERE MONTH(fechaVisita) = MONTH(CURDATE()) AND YEAR(fechaVisita) = YEAR(CURDATE())";
    $stmtTotalVisitsPerMonth = $this->pdo->prepare($sqlTotalVisitsPerMonth);
    $stmtTotalVisitsPerMonth->execute();
    $dashboardData['total_visitas_mes'] = $stmtTotalVisitsPerMonth->fetch(PDO::FETCH_ASSOC)['total_visitas_mes'];

    return $dashboardData;
  }

  public function getPartnerDashboard()
  {
    $dashboardData = [];

    // Total visitantes Registrados

    $sqlTotalVisitantes = "SELECT COUNT(*) AS total_visitantes FROM visitantes";
    $stmtTotalVisitantes = $this->pdo->prepare($sqlTotalVisitantes);
    $stmtTotalVisitantes->execute();
    $dashboardData['total_visitantes'] = $stmtTotalVisitantes->fetch(PDO::FETCH_ASSOC)['total_visitantes'];

    // Total visitas Registradas

    $sqlTotalVisitas = "SELECT SUM(cantidad) AS total_visitas FROM visitas";
    $stmtTotalVisitas = $this->pdo->prepare($sqlTotalVisitas);
    $stmtTotalVisitas->execute();
    $dashboardData['total_visitas'] = $stmtTotalVisitas->fetch(PDO::FETCH_ASSOC)['total_visitas'];

    // Total de visitas por día, semana y mes
    $sqlTotalVisitsPerDay = "SELECT SUM(cantidad) AS total_visitas_dia
                              FROM visitas
                              WHERE DATE(fechaVisita) = CURDATE()";
    $stmtTotalVisitsPerDay = $this->pdo->prepare($sqlTotalVisitsPerDay);
    $stmtTotalVisitsPerDay->execute();
    $dashboardData['total_visitas_dia'] = $stmtTotalVisitsPerDay->fetch(PDO::FETCH_ASSOC)['total_visitas_dia'];

    return $dashboardData;
  }

  public function getUserByUsername($username)
  {
    $sql = "SELECT * FROM usuarios WHERE username = :username";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function findByUsername($username)
  {
    $query = "SELECT * FROM usuarios WHERE username = :username LIMIT 0,1";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function userValidation($username, $password)
  {
    $query = "SELECT * FROM usuarios 
                INNER JOIN colaboradores ON usuarios.idColaborador = colaboradores.idColaborador 
                WHERE username = :username AND password = :password LIMIT 1";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])) {
      return $usuario;
    } else {
      return false;
    }
  }

  public function getPartnersWithoutUser()
  {
    // Implementa la lógica para obtener todos los colaboradores sin usuario de la base de datos.
    $sql = "SELECT * FROM colaboradores c WHERE NOT EXISTS (SELECT 1 FROM usuarios u WHERE u.idColaborador = c.idColaborador)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAllUsers()
  {
    // Implementa la lógica para obtener todos los usuarios de la base de datos.
    //$sql = "SELECT * FROM usuarios";
    $sql = "SELECT u.idUsuario, u.idColaborador, CONCAT(c.nombres, ' ', c.apellidos) AS nombre, c.correo, u.username, u.tipoColaborador, c.fechaContratacion
            FROM usuarios AS u
            JOIN colaboradores AS c
            ON u.idColaborador = c.idColaborador
            ORDER BY c.idColaborador DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getUserById($id)
  {
    // Implementa la lógica para obtener un usuario por su ID.
    $sql = "SELECT * FROM usuarios WHERE idUsuario = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function createUser(array $data)
  {
    // Implementa la lógica para insertar un nuevo usuario en la base de datos.
    // Utiliza prepared statements para prevenir inyecciones SQL.
    $sql = "INSERT INTO usuarios (idColaborador, username, password, tipoColaborador) 
                VALUES (:idColaborador, :username, :password, :tipoColaborador)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':idColaborador', $data["idColaborador"], PDO::PARAM_STR);
    $stmt->bindParam(':username', $data["username"], PDO::PARAM_STR);
    $stmt->bindParam(':password', $data["password"], PDO::PARAM_STR);
    $stmt->bindParam(':tipoColaborador', $data["tipoColaborador"], PDO::PARAM_STR);
    try {
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error al insertar: " . $e->getMessage();
    }
  }
  /*
  public function updateUser(array $data)
  {
    // Implementa la lógica para actualizar los datos de un usuario.
    $sql = "UPDATE usuarios 
                SET username = :username, password = :password, tipoColaborador = :tipoColaborador
                WHERE idUsuario = :idUsuario";
    $stmt = $this->pdo->prepare($sql);
    $data['idUsuario'] = $idUsuario;
    $stmt->execute($data);
  }
  */
  //public function updateUserInfo($idUser, $user, $pass, $type)
  public function updateUserInfo($idUser, $user, $type)
  {

    // Realizar la consulta UPDATE en la base de datos
    $sql = "UPDATE usuarios 
            SET username = :username, tipoColaborador = :tipoColaborador
            WHERE idUsuario = :idUsuario";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':username', $user, PDO::PARAM_STR);
    //$stmt->bindParam(':password', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':tipoColaborador', $type, PDO::PARAM_STR);
    $stmt->bindParam(':idUsuario', $idUser, PDO::PARAM_INT);
    $stmt->execute();

    return "Actualizacion de información de Usuario exitosa.";
  }

  public function updatePassInfo($idUser, $pass)
  {

    // Realizar la consulta UPDATE en la base de datos
    $sql = "UPDATE usuarios 
            SET password = :password
            WHERE idUsuario = :idUsuario";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':password', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':idUsuario', $idUser, PDO::PARAM_INT);
    $stmt->execute();

    return "Actualizacion de Contraseña de Usuario exitosa.";
  }

  public function deleteUser($id)
  {
    // Implementa la lógica para eliminar un usuario por su ID.
    $sql = "DELETE FROM usuarios WHERE idUsuario = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return "Eliminacion de Usuario exitosa.";
  }
}
