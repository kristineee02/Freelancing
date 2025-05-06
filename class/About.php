<?php
    class About {
        private $conn;
        private $table = "about";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllAbout(){
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAboutById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE about_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function updateAbout($id, $contact, $profession, $skills, $history, $socials){
            $query = 'UPDATE ' . $this->table . " SET contact = :contact, profession = :profession, skills = :skills, history = :history, socials = :socials WHERE about_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":contact" => $contact, ":profession" => $profession, ":skills" => $skills, ":history" => $history, ":socials" => $socials, ":id" => $id]);
        }
    }
?>