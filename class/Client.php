<?php
    class Client{
        private $conn;
        private $table = "client";

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function addClient($firstName, $lastName, $email, $password, $address){
            $query = "INSERT INTO " . $this->table . " (firstname, lastname, email, password, address) VALUES (:firstName, :lastName, :email, :password, :address)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":firstName" => $firstName, ":lastName" => $lastName, ":email" => $email, ":password" => $password, ":address" => $address]);
        }
 
        public function getClientById($client_id) {
            $query = "SELECT * FROM " . $this->table . " WHERE client_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$client_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
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

        public function updateProfile($client_id, $firstName, $lastName, $address, $profilePic = null) {
            try {
                $query = "UPDATE " . $this->table . " SET firstname = :firstName, lastname = :lastName, address = :address";
                if ($profilePic) {
                    $query .= ", profile_pic = :profilePic";
                }
                $query .= " WHERE client_id = :client_id";
                
                $stmt = $this->conn->prepare($query);
                $params = [
                    ":firstName" => $firstName,
                    ":lastName" => $lastName,
                    ":address" => $address,
                    ":client_id" => $client_id
                ];
                if ($profilePic) {
                    $params[":profilePic"] = $profilePic;
                }
                return $stmt->execute($params);
            } catch (PDOException $e) {
                error_log("UpdateProfile error: " . $e->getMessage());
                return false;
            }
        }

    }


?>