<?php
    class Work {
        private $conn;
        private $table = "work";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getWorkbyId($id){
            $query = "SELECT * FROM " . $this->table . " WHERE freelancer_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getWorkbyIdWork($workId, $freelancerId){
            $query = "SELECT * FROM freelancer JOIN work ON freelancer.freelancer_id = work.freelancer_id WHERE work.work_id = :workId AND freelancer.freelancer_id = :freelancerId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":workId" => $workId, ":freelancerId" => $freelancerId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getAllWork(){
            $query = "SELECT * FROM " . $this->table . " JOIN freelancer ON work.freelancer_id = freelancer.freelancer_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function addWork($freelancerId, $picture, $title, $description, $category){
            $query = "INSERT INTO " . $this->table . " (freelancer_id, picture, title, description, category) VALUES (:freelancerId, :picture, :title, :description, :category)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":freelancerId" => $freelancerId, ":picture" => $picture, ":title" => $title, ":description" => $description, ":category" => $category]);
        }

        public function updateWork($workId, $picture, $title, $description, $category){
            $query = "UPDATE " . $this->table . " SET picture = :picture, title = :title, description = :description, category = :category WHERE work_id = :workId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":workId" => $workId, ":picture" => $picture, ":title" => $title, ":description" => $description, ":category" => $category]);
        }

        public function deleteWork($workId){
            $query = "DELETE FROM " . $this->table . " WHERE work_id = :workId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":workId" => $workId]);
        }
    }
?>