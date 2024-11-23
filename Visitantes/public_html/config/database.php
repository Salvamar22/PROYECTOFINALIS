<?php

class Database
{
    private $host = "localhost";
    private $dbName = "visitantes";
    private $username = "root";
    private $password = "";
    private $connection;

    /**
     * Obtiene una conexión a la base de datos usando PDO.
     *
     * @return PDO|null La instancia de la conexión PDO o nulo en caso de error.
     */
    public function connect()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbName,
                $this->username,
                $this->password
            );
            // Establece el modo de errores para lanzar excepciones en lugar de warnings
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexión exitosa";
        } catch (PDOException $exception) {
            // En caso de error, imprime el mensaje de error
            //echo "Error de conexión: " . $exception->getMessage();
            die("Error de conexión a la base de datos: " . $exception->getMessage());
        }

        return $this->connection;
    }

}
