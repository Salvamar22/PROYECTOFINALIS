<?php
//session_start();
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
/**
 * Modelo para la gestión de colaboradores.
 */
class PartnerModel
{
    private $pdo;

    public function __construct(PDO $database)
    {
        $this->pdo = $database;
    }

    public function getAllPartners()
    {
        // Implementa la lógica para obtener todos los colaboradores de la base de datos.
        $sql = "SELECT * FROM colaboradores ORDER BY idColaborador DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPartnerById($id)
    {
        // Implementa la lógica para obtener un colaborador por su ID.
        $sql = "SELECT * FROM colaboradores WHERE idColaborador = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createPartner(array $data)
    {
        // Implementa la lógica para insertar un nuevo colaborador en la base de datos.
        // Utiliza prepared statements para prevenir inyecciones SQL.
        $sql = "INSERT INTO colaboradores (nombres, apellidos, dui, direccion, correo, celular, fechaNacimiento, fechaContratacion) 
                VALUES (:nombres, :apellidos, :dui, :direccion, :correo, :celular, :fechaNacimiento, :fechaContratacion)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombres', $data["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $data["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(':dui', $data["dui"], PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $data["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(':correo', $data["correo"], PDO::PARAM_STR);
        $stmt->bindParam(':celular', $data["celular"], PDO::PARAM_STR);
        $stmt->bindParam(':fechaNacimiento', $data["fechaNacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(':fechaContratacion', $data["fechaContratacion"], PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar: " . $e->getMessage();
        }
    }

    public function updatePartnerInfo($idColaborador, $nombres, $apellidos, $dui, $direccion, $correo, $celular, $fechaNacimiento) {

        // Realizar la consulta UPDATE en la base de datos
        $sql = "UPDATE colaboradores 
                SET nombres = :nombres, apellidos = :apellidos, dui = :dui, direccion = :direccion, 
                    correo = :correo, celular = :celular, fechaNacimiento = :fechaNacimiento
                WHERE idColaborador = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombres', $nombres, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':dui', $dui, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':celular', $celular, PDO::PARAM_STR);
        $stmt->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':id', $idColaborador, PDO::PARAM_INT);
        $stmt->execute();

        return "Actualizacion de Colaborador exitosa.";

    }

    public function updatePartner($id, array $data)
    {
        // Implementa la lógica para actualizar los datos de un colaborador.
        $sql = "UPDATE colaboradores 
                SET nombres = :nombres, apellidos = :apellidos, dui = :dui, direccion = :direccion, 
                    correo = :correo, celular = :celular, fechaNacimiento = :fechaNacimiento
                WHERE idColaborador = :id";
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);

        return "Actualizacion de Colaborador exitosa.";
    }

    public function deletePartner($id)
    {
        // Implementa la lógica para eliminar un colaborador por su ID.
        $sql = "DELETE FROM colaboradores WHERE idColaborador = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        return "Eliminacion de Colaborador exitosa.";
    }
}
