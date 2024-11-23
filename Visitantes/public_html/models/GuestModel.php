<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


/**
 * Modelo para la gestión de visitantes.
 */
class GuestModel
{
    private $pdo;

    public function __construct(PDO $database)
    {
        $this->pdo = $database;
    }

    public function getAllGuests()
    {
        // Implementa la lógica para obtener todos los visitantes de la base de datos.
        $sql = "SELECT * FROM visitantes
                ORDER BY idVisitante DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGuestById($id)
    {
        // Implementa la lógica para obtener un visitante por su ID.
        $sql = "SELECT * FROM visitantes WHERE idVisitante = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createGuest(array $data)
    {
        // Implementa la lógica para insertar un nuevo visitante en la base de datos.
        // Utiliza prepared statements para prevenir inyecciones SQL.
        $sql = "INSERT INTO visitantes (nombre, correo, asunto, comentario, fechaVisita) 
                VALUES (:nombre, :correo, :asunto, :comentario, :fechaVisita)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(':correo', $data["correo"], PDO::PARAM_STR);
        $stmt->bindParam(':asunto', $data["asunto"], PDO::PARAM_STR);
        $stmt->bindParam(':comentario', $data["comentario"], PDO::PARAM_STR);
        $stmt->bindParam(':fechaVisita', $data["fechaVisita"], PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar: " . $e->getMessage();
        }
    }

    public function updateGuest($id, $name, $email, $subject, $note)
    {
        // Implementa la lógica para actualizar los datos de un visitante.
        $sql = "UPDATE visitantes 
                SET nombre = :nombre, correo = :correo, asunto = :asunto, comentario = :comentario
                WHERE idVisitante = :idVisitante";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre', $name, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $email, PDO::PARAM_STR);
        $stmt->bindParam(':asunto', $subject, PDO::PARAM_STR);
        $stmt->bindParam(':comentario', $note, PDO::PARAM_STR);
        $stmt->bindParam(':idVisitante', $id, PDO::PARAM_INT);
        $stmt->execute();

        return "Actualizacion de Visitante exitosa.";
    }
    
    public function deleteGuest($id)
    {
        // Implementa la lógica para eliminar un visitante por su ID.
        $sql = "DELETE FROM visitantes WHERE idVisitante = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /*
    * Funciones para rol de Colaborador
    */

    public function updateGuestPartner($id, array $data)
    {
        // Implementa la lógica para actualizar los datos de un visitante.
        $sql = "UPDATE visitantes 
                SET nombre = :nombre, correo = :correo, asunto = :asunto, comentario = :comentario
                WHERE idVisitante = :idVisitante";
        $stmt = $this->pdo->prepare($sql);
        $data['idVisitante'] = $id;
        $stmt->execute($data);
    }
}
