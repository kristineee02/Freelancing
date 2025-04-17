<?php
class Work {
    private $conn;
    private $table = "work";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllWork($freelancer_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE freelancer_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$freelancer_id]);
        $works = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $works[] = $row;
        }
        
        return $works;
    }

    public function getWorkById($work_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE work_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$work_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addWork($freelancer_id, $picture, $title, $description, $category) {
        $query = "INSERT INTO " . $this->table . " 
                  (freelancer_id, picture, title, description, category, date) 
                  VALUES (?, ?, ?, ?, ?, NOW())";
        
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute([
            $freelancer_id, 
            $picture, 
            $title, 
            $description, 
            $category
        ]);
        
        return $result;
    }

}
?>