<?php

class Account
{
    protected $pdo;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->pdo = $db->getConnection();
    }

    public function getAllAccounts()
    {
        $stmt = $this->pdo->query('SELECT id, username FROM accounts');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findUserByUsername($username)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM accounts WHERE username = :username');
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Fetches the user with the verifier (password hash)
    }
}
