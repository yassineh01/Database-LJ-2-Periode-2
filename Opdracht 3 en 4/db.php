<?php
class Database {
    private $host = "localhost:3306";
    private $username = "root";
    private $password = "";
    private $database = "Database"; 

    protected $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);

            
            $this->createTable();

            echo "Database connection established successfully.";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS gebruikers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            naam VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            leeftijd INT
        )";

        $this->conn->exec($sql);
    }

    
    public function voegGebruikerToe($naam, $email, $leeftijd) {
        $sql = "INSERT INTO gebruikers (naam, email, leeftijd) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        
        if ($stmt) {
            
            $stmt->bindParam(1, $naam, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $leeftijd, PDO::PARAM_INT);

            
            $stmt->execute();

            
            $stmt->closeCursor();
        } else {
           
            die('Voorbereiding van het statement is mislukt: ' . $this->conn->errorInfo()[2]);
        }
    }

    
    public function haalGebruikersOp() {
        $sql = "SELECT * FROM gebruikers";
        $stmt = $this->conn->prepare($sql);
        
       
        if ($stmt) {
           
            $stmt->execute();
            
          
            $resultaten = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            
            $stmt->closeCursor();

            return $resultaten;
        } else {
            
            die('Voorbereiding van het statement is mislukt: ' . $this->conn->errorInfo()[2]);
        }
    }

   
    public function verwijderGebruiker($gebruikerId) {
        $sql = "DELETE FROM gebruikers WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        
        if ($stmt) {
            
            $stmt->bindParam(1, $gebruikerId, PDO::PARAM_INT);

            
            $stmt->execute();

           
            $stmt->closeCursor();
        } else {
           
            die('Voorbereiding van het statement is mislukt: ' . $this->conn->errorInfo()[2]);
        }
    }

   
    public function haalGebruikerOp($gebruikerId) {
        $sql = "SELECT * FROM gebruikers WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        
        if ($stmt) {
           
            $stmt->bindParam(1, $gebruikerId, PDO::PARAM_INT);

            
            $stmt->execute();

           
            $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);

            
            $stmt->closeCursor();

            return $resultaat;
        } else {
           
            die('Voorbereiding van het statement is mislukt: ' . $this->conn->errorInfo()[2]);
        }
    }

  
    public function updateGebruiker($gebruikerId, $naam, $email, $leeftijd) {
        $sql = "UPDATE gebruikers SET naam = ?, email = ?, leeftijd = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

     
        if ($stmt) {
            
            $stmt->bindParam(1, $naam, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $leeftijd, PDO::PARAM_INT);
            $stmt->bindParam(4, $gebruikerId, PDO::PARAM_INT);

            
            $stmt->execute();

            
            $stmt->closeCursor();
        } else {
            
            die('Voorbereiding van het statement is mislukt: ' . $this->conn->errorInfo()[2]);
        }
    }
}
?>
