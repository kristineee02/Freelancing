<?php
class Work {
    private $conn;
    private $table = "job";

    public function __construct($db) {
        $this->conn = $db;
    }

    
        // Get all jobs for public listing
        public function getAllJobs() {
            $query = "SELECT j.*, CONCAT(c.firstname, ' ', c.lastname) as FullName FROM " . $this->table . " j 
                     JOIN client c ON j.ClientId = c.client_id 
                     ORDER BY j.job_id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $jobs = [];
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $jobs[] = $row;
            }
            
            return $jobs;
        }

     // Get jobs by client ID
     public function getAllJob($ClientId) {
        $query = "SELECT * FROM " . $this->table . " WHERE ClientId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$ClientId]);
        $jobs = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $jobs[] = $row;
        }
        
        return $jobs;
    } 

    public function getJobById($job_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE job_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$job_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addJob($ClientId, $FullName, $Email, $Project_Category, $Description, $start_date, $end_date, 
    $Budget, $Project_Name, $Location) {
        $query = "INSERT INTO " . $this->table . " 
                  (ClientId, FullName, Email, Project_Category, Description, start_date, end_date, Budget, 
                  Project_Name, Location, Date_created ) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute([
            $ClientId, 
            $FullName, 
            $Email, 
            $Project_Category, 
            $Description,
            $start_date,
            $end_date,
            $Budget,
            $Project_Name,
            $Location
        ]);
        
        return $result;
    }

}
?>