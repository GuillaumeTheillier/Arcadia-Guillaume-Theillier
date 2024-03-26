<?php

class DatabaseConnection
{
    public ?PDO $database = null;

    function getConnection(): PDO
    {
        if ($this->database === null) {
            try {
                $this->database = new PDO('mysql:host=localhost;dbname=arcadia;charset=utf8', 'root', '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        return $this->database;
    }
}
