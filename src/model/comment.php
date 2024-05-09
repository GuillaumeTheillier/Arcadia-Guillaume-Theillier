<?php

require_once('database.php');

class CommentRepository
{
    private DatabaseConnection $connection;

    function __construct()
    {
        //At a new instance initialize connection with the DatabaseConnection class
        $this->connection = new DatabaseConnection;
    }

    function getComments(): array
    {
        $i = 2;
        $min = (2 * ($i - 1));
        $max = 3;

        $statement = $this->connection->getConnection()->prepare(
            'Select pseudo, commentaire, DATE_FORMAT(date, \'%d/%m/%Y\') as date FROM avis WHERE isVisible = true ORDER BY date DESC LIMIT :min , :max'
        );
        $statement->bindValue(':min', $min, pdo::PARAM_INT);
        $statement->bindValue(':max', $max, pdo::PARAM_INT);

        $statement->execute();

        $comments = $statement->fetchAll();

        return $comments;
    }

    function getAll()
    {
        $statement = $this->connection->getConnection()->prepare(
            'Select id, pseudo, commentaire, DATE_FORMAT(date, \'%d/%m/%Y\') as date, isVisible FROM avis'
        );
        $statement->execute();
        while ($comment = $statement->fetch(pdo::FETCH_ASSOC)) {
            $comments[] = $comment;
        }

        return $comments;
    }

    function createComment(string $pseudo, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare('INSERT INTO avis(pseudo, commentaire, date, isVisible) VALUES (?, ?, NOW(), false)');
        $success = $statement->execute([$pseudo, $comment]);

        return $success;
    }

    function validComment(bool $visible, int $id): bool
    {
        $statement = $this->connection->getConnection()->prepare('UPDATE avis SET isVisible = ? WHERE id = ?;');
        return $statement->execute([$visible, $id]);
    }
}
