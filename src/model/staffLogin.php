<?php

require_once('database.php');

/* 
 * if (password_verify('va7B6C!fm%Gd', '$2y$10$CJamkDcx.bbO1.ScdKMvbOEQbaBax/Rc9gzMMYGFbZ4V.YYo506yy')) {
 *    echo 'connexion réussie';
 * } else echo 'echec de la connexion';
 */
class Users
{
    private DatabaseConnection $db_connect;


    function __construct()
    {
        $this->db_connect = new DatabaseConnection;
    }

    function getAllUsers(): array
    {
        $statement = $this->db_connect->getConnection()->prepare('SELECT username, surname, first_name, role.label as role
                                                                  FROM users
                                                                  LEFT JOIN role ON users.role_id = role.id
                                                                  WHERE role_id != 1
                                                                ');
        $statement->execute();

        $users = [];

        while ($usersDb = $statement->fetch(pdo::FETCH_ASSOC)) {
            $users[] = $usersDb;
        }

        return $users;
    }

    //Checks if username from user input exist in the database
    function usernameExist(string $username): bool
    {
        $statement = $this->db_connect->getConnection()->prepare('SELECT username FROM users');
        $statement->execute();

        while ($userDb = $statement->fetch(pdo::FETCH_NUM)) {
            if ($userDb[0] === $username) {
                return true;
            }
        }

        return false;
    }

    //Checks if password given with input match with hash save in database
    function verifyPassword(string $username, string $password): bool
    {
        $statement = $this->db_connect->getConnection()->prepare('SELECT password FROM users WHERE username = ?');
        $statement->execute([$username]);

        $hashDb = $statement->fetch(pdo::FETCH_NUM);
        return password_verify($password, $hashDb[0]);
    }
}
