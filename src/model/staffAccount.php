<?php

use DatabaseConnection\RelationnalDatabaseConnection;

class AccountRepository
{
    private RelationnalDatabaseConnection $db_connect;


    function __construct()
    {
        $this->db_connect = new RelationnalDatabaseConnection;
    }

    function getAllUsers(): array
    {
        $statement = $this->db_connect->getConnection()->prepare('SELECT username, surname, first_name, role.label as role
                                                                  FROM users
                                                                  LEFT JOIN role ON users.role_id = role.id
                                                                  WHERE role_id != 3
                                                                ');
        $statement->execute();

        $users = [];

        while ($usersDb = $statement->fetch(pdo::FETCH_ASSOC)) {
            $users[] = $usersDb;
        }

        return $users;
    }

    function getUser(string $username): array
    {
        $statement = $this->db_connect->getConnection()->prepare('SELECT username, password, surname, first_name as firstName, role_id as role
                                                                  FROM users
                                                                  WHERE username = ?
                                                                ');

        $statement->execute([$username]);
        $user = $statement->fetch(pdo::FETCH_ASSOC);

        return $user;
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

    /**
     * Checks if password given with input match with hash save in database
     * 
     * @return Bool false for wrong password or user array for correct prassword
     * */
    function verifyPassword(string $username, string $password): bool|array
    {
        /*$statement = $this->db_connect->getConnection()->prepare('SELECT password FROM users WHERE username = ?');
        $statement->execute([$username]);

        $hashDb = $statement->fetch(pdo::FETCH_NUM);*/
        $user = $this->getUser($username);
        $hashDb = $user['password'];

        if (password_verify($password, $hashDb)) {
            return $user;
        } else return false;
    }


    /**
     * Create new staff account in database
     * 
     * @return Bool true on success or false on failure
     */
    function createAccount(string $username, string $firstName, string $surname, string $hash, int $role)
    {
        $statement = $this->db_connect->getConnection()->prepare('INSERT INTO users(username, password, surname, first_name, role_id) 
                                                                  VALUES (?,?,?,?,?)');
        return $statement->execute([$username, $hash, $surname, $firstName, $role]);
    }

    /**
     * Update staff account in database
     * 
     * @return Bool true on success or false on failure
     */
    function updateAccount(string $oldUsername, string $newUsername, string $firstName, string $surname, string $hash, int $role)
    {
        if ($hash !== '') {
            $statement = $this->db_connect->getConnection()->prepare('UPDATE users 
                                                                  SET username=?, password=?, surname=?, first_name=?, role_id=? 
                                                                  WHERE users.username=?');
            return $statement->execute([$newUsername, $hash, $surname, $firstName, $role, $oldUsername]);
        } else {
            $statement = $this->db_connect->getConnection()->prepare('UPDATE users
                                                                  SET username=?, surname=?, first_name=?, role_id=? 
                                                                  WHERE users.username=?');
            return $statement->execute([$newUsername, $surname, $firstName, $role, $oldUsername]);
        }
    }

    /**
     * Delete staff account in database
     * 
     * @return Bool True on success or False on failure
     */
    function deleteAccount(string $username)
    {
        $statement = $this->db_connect->getConnection()->prepare('DELETE FROM users where username=?;');
        return $statement->execute([$username]);
    }
}
