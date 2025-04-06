<?php
    class Freelancer{
        private $conn;
        private $table = "freelancer";

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function addFreelancer($firstName, $lastName, $email, $password){
            $query = "INSERT INTO " . $this->table . " (firstname, lastname, email, password) VALUES (:firstName, :lastName, :email, :password)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":firstName" => $firstName, ":lastName" => $lastName, ":email" => $email, ":password" => $password]);
        }
    }


?>