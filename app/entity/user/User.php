<?php

namespace app\entity\user;

use app\entity\Entity;
use app\entity\user\UserAlreadyExistsException;
use app\support\Database;
use app\support\Logger;
use Exception;

class User extends Entity {

    private int $id;
    private string $username;
    private float $balance;

    public function __construct(
        int $id,
        string $username,
        float $balance
    ) {
        $this->id = $id;
        $this->setUsername($username);
        $this->setBalance($balance);
    }

    public static function createUser(string $username): User {   
        //get new user id
        $db = Database::getDb();
        $maxId = (int)$db->query(
            'SELECT max(id) AS maxId FROM users'
        )->fetchArray(SQLITE3_ASSOC)['maxId'];
        $newUserId = $maxId+1;
        $newUserBalance = 0;

        //create and validate user
        $newUser = new User($newUserId, $username, $newUserBalance);

        //prepare user creation query
        $createUserQuery = $db->prepare(
            'INSERT INTO users (id, username, balance)'.
            'VALUES (:id, :username, :newUserBalance)'
        );
        $createUserQuery->bindValue(':id', $newUserId, SQLITE3_INTEGER);
        $createUserQuery->bindValue(':username', $username, SQLITE3_TEXT);
        $createUserQuery->bindValue(':newUserBalance', $newUserBalance, SQLITE3_NUM);

        //execute query
        if ($createUserQuery->execute() === false) {
            Logger::log("failed to create user - ".$db->lastErrorMsg());
            if ($db->lastErrorCode() === 19 && strpos($db->lastErrorMsg(), 'UNIQUE') !== false) {
                throw new UserAlreadyExistsException();
            }
            throw new Exception('db failed to create user');
        }
        $createUserQuery->close();

        Logger::log("created user $username with id $newUserId and balance $newUserBalance");
        return $newUser;
    }

    public function flush(): void {
        $db = Database::getDb();
        $id = $this->getId();
        $username = $this->getUsername();
        $balance = $this->getBalance();

        $success = $db->exec(
            "UPDATE users SET ".
            "username = '$username', ".
            "balance = $balance ".
            "WHERE id = $id"
        );

        if ($success === false) {
            Logger::log("failed to flush user with id $id - ".$db->lastErrorMsg());
            if ($db->lastErrorCode() === 19 && strpos($db->lastErrorMsg(), 'UNIQUE') !== false) {
                throw new UserAlreadyExistsException();
            }
            throw new Exception("failed to flush user");
        }
        Logger::log("updated user with id $id - username: $username, balance: $balance");
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        if (strlen($username) > 25) {
            throw new Exception('username can\'t be longer than 25 characters');
        }
        $this->username = $username;
    }

    public function getBalance(): float {
        return $this->balance;
    }

    public function setBalance(float $balance): void {
        $this->balance = $balance;
    }
}

