<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

/**
 * Modelo para la gestión de visitas.
 */
class VisitModel
{
    private $pdo;

    public function __construct(PDO $database)
    {
        $this->pdo = $database;
    }

    public function getAllGuests()
    {
        // Implementa la lógica para obtener todos los visitantes de la base de datos.
        $sql = "SELECT * FROM visitantes ORDER BY idVisitante DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllVisits()
    {
        // Implementa la lógica para obtener todas los visitas de la base de datos.
        $sql = "SELECT
                    vis.idVisita,
                    u.username AS colaborador,
                    v.nombre AS visitante,
                    vis.asunto,
                    vis.comentario,
                    vis.cantidad,
                    vis.fechaVisita
                FROM
                    visitas vis
                INNER JOIN
                    usuarios u ON vis.idColaborador = u.idColaborador
                INNER JOIN
                    visitantes v ON vis.idVisitante = v.idVisitante
                ORDER BY
                    vis.idVisita DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVisitById($id)
    {
        // Implementa la lógica para obtener una visita por su ID.
        $sql = "SELECT * FROM visitas WHERE idVisita = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createVisit(array $data)
    {
        // Implementa la lógica para insertar una nueva visita en la base de datos.
        // Utiliza prepared statements para prevenir inyecciones SQL.
        $sql = "INSERT INTO visitas (idColaborador, idVisitante, asunto, comentario, cantidad, fechaVisita) 
                VALUES (:idColaborador, :idVisitante, :asunto, :comentario, :cantidad, :fechaVisita)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idColaborador', $data["idColaborador"], PDO::PARAM_INT);
        $stmt->bindParam(':idVisitante', $data["idVisitante"], PDO::PARAM_INT);
        $stmt->bindParam(':asunto', $data["asunto"], PDO::PARAM_STR);
        $stmt->bindParam(':comentario', $data["comentario"], PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $data["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(':fechaVisita', $data["fechaVisita"], PDO::PARAM_STR);
        try {
            $stmt->execute();
            return "Registro de Visita exitosa.";
        } catch (PDOException $e) {
            echo "Error al insertar: " . $e->getMessage();
            return "Registro de Visita fallida.";
        }
    }

    public function updateVisit(array $data)
    {
        // Implementa la lógica para actualizar los datos de un visita.
        $sql = "UPDATE visitas 
                SET asunto = :asunto, comentario = :comentario, cantidad = :cantidad
                WHERE idVisita = :idVisita";
        $stmt = $this->pdo->prepare($sql);
        //$data['idVisita'] = $id;
        $stmt->bindParam(':asunto', $data["asunto"], PDO::PARAM_STR);
        $stmt->bindParam(':comentario', $data["comentario"], PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $data["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(':idVisita', $data["idVisita"], PDO::PARAM_INT);
        $stmt->execute();

        return "Actualizacion de Visita exitosa.";
    }

    public function deleteVisit($id)
    {
        // Implementa la lógica para eliminar una visita por su ID.
        $sql = "DELETE FROM visitas WHERE idVisita = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return "Eliminacion de Visita exitosa.";
    }
}
