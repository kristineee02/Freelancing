<?php
    class Review{
        private $conn;
        private $table = "review";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getReviewById($id){
            $query = "SELECT * FROM " . $this->table . " JOIN client ON review.client_id = client.client_id WHERE work_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addReview($clientId, $workId, $comment){
            $query = "INSERT INTO " . $this->table . " (client_id, work_id, comment) VALUES (:clientId, :workId, :comment)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":clientId" => $clientId, ":workId" => $workId, ":comment" => $comment]);
        }
    }
?>