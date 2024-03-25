<?php

class CommentRepository
{
    function dbConnect()
    {
        try {
            $pdo = new PDO(
                'mysql:host=localhost;dbname=arcadia;charset=utf8',
                'root',
                ''
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        return $pdo;
    }

    function getComments()
    {
        $i = 2;
        $min = (2 * ($i - 1));
        $max = 3;
        $statement = $this->dbConnect()->prepare(
            'Select pseudo, commentaire, DATE_FORMAT(date, \'%d/%m/%Y\') as date FROM avis WHERE isVisible = true ORDER BY date DESC LIMIT :min , :max'
        );
        $statement->bindValue(':min', $min, pdo::PARAM_INT);
        $statement->bindValue(':max', $max, pdo::PARAM_INT);

        $statement->execute();

        $comments = $statement->fetchAll();

        return $comments;
    }

    function createComment(string $pseudo, string $comment): bool
    {
        $statement = $this->dbConnect()->prepare('INSERT INTO avis(pseudo, commentaire, date, isVisible) VALUES (?, ?, NOW(), false)');
        $success = $statement->execute([$pseudo, $comment]);

        return $success;
    }
}
