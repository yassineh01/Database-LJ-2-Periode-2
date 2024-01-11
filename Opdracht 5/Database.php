<?php

class Database
{
    private $pdo;
    public $message;

    public function __construct(string $servername = 'localhost:3306', string $username = 'root', string $password = '', string $dbname = 'OOP')
    {
        try {
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function AddUser(string $user_name, string $password, string $email)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO log (user_name, password, email) VALUES (:user_name, :password, :email)");
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $this->message = 'User added successfully!';
        } catch (PDOException $e) {
            return $this->message = 'Error adding user: ' . $e->getMessage();
        }
    }

    public function CheckUser(string $user_name, string $password)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM log WHERE user_name = :user_name");
            $stmt->bindParam(':user_name', $user_name);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user_name;
                $this->message = 'Login successful.';
                return $this->message;
            } else {
                $this->message = 'Invalid username or password.';
                return $this->message;
            }
        } catch (PDOException $e) {
            return $this->message = 'Error checking user: ' . $e->getMessage();
        }
    }
}
?>
