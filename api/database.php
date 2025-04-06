<<<<<<< HEAD
<?php
=======
<?
>>>>>>> 3853dc42f7ee191f257ec6f4f9638e8628d274b7
    class Database {
        private $host = "localhost";
        private $db_name = "freelancer_signup";
        private $username = "root";
        private $password ="";
        public $conn;
        public function getConnection(){
            $this->conn = null;
            try {
<<<<<<< HEAD
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
=======
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname" . $this->db_name, $this->username, $this->password);
>>>>>>> 3853dc42f7ee191f257ec6f4f9638e8628d274b7
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die("Connection error: " . $e->getMessage());
            }
            return $this->conn;
        }
    }
?>

