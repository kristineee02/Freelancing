<?php
    class Application {
        private $conn;
        private $table = "application";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getApplicationById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE job_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addApplication($jobId, $name, $email, $contact, $address){
            $query = "INSERT INTO " . $this->table . " (job_id, name, email, contact, address) VALUES (:jobId, :name, :email, :contact, :address)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":jobId" => $jobId, ":name" => $name, ":email" => $email, ":contact" => $contact, ":address" => $address]);
        }

        public function deleteApplication($id){
            $query = "DELETE FROM " . $this->table . " WHERE application_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
    }
?>