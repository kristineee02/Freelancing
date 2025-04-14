<?php
class Freelancer {
    private $conn;
    private $table = "freelancer";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addFreelancer($firstName, $lastName, $email, $password, $address) {
            $query = "INSERT INTO " . $this->table . " (firstname, lastname, email, password, address) VALUES (:firstName, :lastName, :email, :password, :address)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":firstName" => $firstName, ":lastName" => $lastName, ":email" => $email, ":password" => $password, ":address" => $address]);
            return true;
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
}
?>