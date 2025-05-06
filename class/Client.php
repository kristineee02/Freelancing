<?php

    class Client{
        private $conn;
        private $table = "client";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getClient(){
            $query = "SELECT * FROM " . $this->table . " JOIN about ON client.about_id = about.about_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        
        public function getClientById($id){
            $query = "SELECT * FROM " . $this->table . " JOIN about ON client.about_id = about.about_id WHERE client_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addClient($firstName, $lastName, $email, $password, $address){
            $aboutQuery = "INSERT INTO about (contact, profession, skills, history, socials) VALUES ('', '', '', '', '')";
            $stmt = $this->conn->prepare($aboutQuery);
            $stmt->execute();
            
            $aboutId = $this->conn->lastInsertId();
            
            $freelancerQuery = "INSERT INTO " . $this->table . " (first_name, last_name, email, password, address, profile_pic, about_id) VALUES (:firstName, :lastName, :email, :password, :address, :profilePic, :aboutId)";
            $stmt = $this->conn->prepare($freelancerQuery);

            $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
            $profilePic = null;
            $stmt->execute([":firstName" => $firstName, ":lastName" => $lastName, ":email" => $email, ":password" => $passwordHashed, ":address" => $address, ":profilePic" => $profilePic, ":aboutId" => $aboutId]);
            
        }

        public function updateClient($clientId, $firstName, $lastName, $address, $profilePic){
            $query = "UPDATE " . $this->table . " SET first_name = :firstName, last_name = :lastName, address = :address" . 
                     ($profilePic !== null ? ", profile_pic = :profilePic" : "") . 
                     " WHERE client_id = :clientId";
            
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':address', $address);
            if ($profilePic !== null) {
                $stmt->bindParam(':profilePic', $profilePic);
            }
            $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("SQL Error: " . implode(", ", $stmt->errorInfo()));
            }
        }

        public function clientLogin($email, $password){
            $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":email" => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user && password_verify($password, $user["password"])){
                return $user;
            }else{
                return false;

            }
        }
    }
?>