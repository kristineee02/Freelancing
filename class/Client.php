<?php
    class Client{
        private $conn;
        private $table = "client";

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function addClient($firstName, $lastName, $email, $password){
            $query = "INSERT INTO " . $this->table . " (firstname, lastname, email, password) VALUES (:firstName, :lastName, :email, :password)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":firstName" => $firstName, ":lastName" => $lastName, ":email" => $email, ":password" => $password]);
        }
     
        public function login($email, $password){
            $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":email" => $email]);
            if ($stmt->rowCount() == 1){
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if($password == $user["password"]){
                    return $user;
                }
            }
            return false;
        }
    }


?>