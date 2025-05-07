<?php
    class Buy{
        private $conn;
        private $table = "buy";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getBuy($id) {
            $query = "SELECT 
                        b.buy_id,
                        b.client_id,
                        b.work_id,
                        b.freelancer_id,
                        b.project_details,
                        b.target_date,
                        b.project_budget,
                        
                        c.first_name AS client_first_name,
                        c.last_name AS client_last_name,
                        c.email AS client_email,
                        c.address AS client_address,
                        c.profile_pic AS client_profile_pic,
                        
                        w.picture AS work_picture,
                        w.title AS work_title,
                        w.description AS work_description,
                        w.category AS work_category,
                        w.date AS work_date,
                        
                        f.first_name AS freelancer_first_name,
                        f.last_name AS freelancer_last_name,
                        f.email AS freelancer_email,
                        f.address AS freelancer_address,
                        f.profile_pic AS freelancer_profile_pic
                        
                    FROM " . $this->table . " b
                    JOIN client c ON b.client_id = c.client_id 
                    JOIN work w ON b.work_id = w.work_id 
                    JOIN freelancer f ON b.freelancer_id = f.freelancer_id 
                    WHERE b.freelancer_id = :id";
                    
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addBuy($clientId, $workId, $freelancerId, $projectDetail, $targetDate, $projectBudget){
            $query = "INSERT INTO " . $this->table . " (client_id, work_id, freelancer_id, project_details, target_date, project_budget) VALUES (:clientId, :workId, :freelancerId, :projectDetail, :targetDate, :projectBudget)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":clientId" => $clientId, ":workId" => $workId, ":freelancerId" => $freelancerId, ":projectDetail" => $projectDetail, ":targetDate" => $targetDate, ":projectBudget" => $projectBudget]);
        }

        public function deleteBuy($id) {
            $query = "DELETE FROM " . $this->table . " WHERE buy_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
    }
?>