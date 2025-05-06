<?php

    class Job{
        private $conn;
        private $table = "job";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getJobById($id){
            $query = "SELECT * FROM " . $this->table . " JOIN about_job ON job.about_job_id = about_job.about_job_id WHERE job_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getAllJob(){
            $query = "SELECT * FROM " . $this->table . " JOIN client ON job.client_id = client.client_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getJobByClient($id){
            $query = "SELECT * FROM " . $this->table . " JOIN about_job ON job.about_job_id = about_job.about_job_id WHERE client_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getJobByClientandJob($clientId, $jobId){
            $query = "SELECT * FROM " . $this->table . " JOIN about_job ON job.about_job_id = about_job.about_job_id WHERE client_id = :clientId AND job_id = :jobId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
            ":clientId" => $clientId,
            ":jobId" => $jobId
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addJob($clientId, $projectTitle, $projectCategory, $description, $startDate, $endDate, $budget, $location, $education, $experience, $aboutUs, $role, $tasks, $benefits, $requirements) {
            try {
                $aboutJobQuery = "INSERT INTO about_job (about_us, role, tasks, benefits, requirements) VALUES (:aboutUs, :role, :tasks, :benefits, :requirements)";
                $astmt = $this->conn->prepare($aboutJobQuery);
                $astmt->execute([
                    ":aboutUs" => $aboutUs,
                    ":role" => $role,
                    ":tasks" => $tasks,
                    ":benefits" => $benefits,
                    ":requirements" => $requirements
                ]);
                $aboutJobId = $this->conn->lastInsertId();

                $query = "INSERT INTO " . $this->table . " (client_id, project_title, project_category, description, start_date, end_date, budget, location, education, experience, about_job_id) VALUES (:clientId, :projectTitle, :projectCategory, :description, :startDate, :endDate, :budget, :location, :education, :experience, :aboutJobId)";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([
                    ":clientId" => $clientId,
                    ":projectTitle" => $projectTitle,
                    ":projectCategory" => $projectCategory,
                    ":description" => $description,
                    ":startDate" => $startDate,
                    ":endDate" => $endDate,
                    ":budget" => $budget,
                    ":location" => $location,
                    ":education" => $education,
                    ":experience" => $experience,
                    ":aboutJobId" => $aboutJobId
                ]);
        
                return true;
            } catch (Exception $e) {
                error_log("Error in addJob: " . $e->getMessage());
                return false;
            }
        }
    }
?>