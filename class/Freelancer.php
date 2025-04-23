<?php
class Freelancer {
    private $conn;
    private $table = "freelancer";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addFreelancer($firstName, $lastName, $email, $password, $address) {
        try {
            $this->conn->beginTransaction();
            
            // First create an empty about record
            $aboutStmt = $this->conn->prepare("INSERT INTO about (contact, birthday, skills, history, socials) VALUES ('', '0000-00-00', '', '', '')");
            $aboutStmt->execute();
            $aboutId = $this->conn->lastInsertId();
            
            // Then create the freelancer with a reference to the about record
            $query = "INSERT INTO " . $this->table . " (firstname, lastname, email, password, address, about_id) VALUES (:firstName, :lastName, :email, :password, :address, :about_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ":firstName" => $firstName, 
                ":lastName" => $lastName, 
                ":email" => $email, 
                ":password" => $password, 
                ":address" => $address,
                ":about_id" => $aboutId
            ]);
            
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("AddFreelancer error: " . $e->getMessage());
            return false;
        }
    }

    public function getFreelancerById($account_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE account_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$account_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login($email, $password) {
            $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":email" => $email]);
            if ($stmt->rowCount() == 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($password == $user["password"]) {
                    $_SESSION['user_id'] = $user['account_id']; 
                    $_SESSION['firstName'] = $user['firstname'];
                    $_SESSION['lastName'] = $user['lastname'];
                    $_SESSION['address'] = $user['address'];
                    $_SESSION['profile_pic'] = $user['profile_pic'];
                    return $user;
                }
            }
            return false;
        } 
    

    public function updateProfile($account_id, $firstName, $lastName, $address, $profilePic = null) {
        try {
            $query = "UPDATE " . $this->table . " SET firstname = :firstName, lastname = :lastName, address = :address";
            if ($profilePic) {
                $query .= ", profile_pic = :profilePic";
            }
            $query .= " WHERE account_id = :account_id";
            
            $stmt = $this->conn->prepare($query);
            $params = [
                ":firstName" => $firstName,
                ":lastName" => $lastName,
                ":address" => $address,
                ":account_id" => $account_id
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

    public function addAbout($contact, $profession, $skills, $history, $socials) {
        try {
            $query = "INSERT INTO about (contact, profession, skills, history, socials) 
                      VALUES (:contact, :profession, :skills, :history, :socials)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':contact' => $contact,
                ':profession' => $profession,
                ':skills' => $skills,
                ':history' => $history,
                ':socials' => $socials,
            ]);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            error_log("AddAbout error: " . $e->getMessage());
            return false;
        }
    }

    public function updateAbout($account_id, $contact, $skills, $history, $socials, $profession) {
        try {
            $stmt = $this->conn->prepare("SELECT about_id FROM freelancer WHERE account_id = :account_id");
            $stmt->execute([':account_id' => $account_id]);
            $about_id = $stmt->fetchColumn();
    
            if (!$about_id) {
                throw new Exception("No about_id found for account_id: $account_id");
            }
    
            $query = "UPDATE about 
                      SET contact = :contact, profession = :profession, skills = :skills, history = :history, socials = :socials 
                      WHERE about_id = :about_id";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([
                ':contact' => $contact,
                ':profession' => $profession,
                ':skills' => $skills,
                ':history' => $history,
                ':socials' => $socials,
                ':about_id' => $about_id
            ]);
        } catch (PDOException $e) {
            error_log("UpdateAbout error: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Custom error: " . $e->getMessage());
            return false;
        }
    }
}
?>
