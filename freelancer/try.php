<?php

// Load session data
$firstName = $_SESSION['firstName'] ?? '';
$lastName = $_SESSION['lastName'] ?? '';
$fullName = trim($firstName . " " . $lastName);
$address = $_SESSION['address'] ?? '';
$contact = $_SESSION['contact'] ?? '';
$birthday = $_SESSION['birthday'] ?? '';
$skills = $_SESSION['skills'] ?? '';
$history = $_SESSION['history'] ?? '';
$socials = $_SESSION['socials'] ?? '';


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editname'])) {
    $newName = $_POST['editname'];
    $newContact = $_POST['editnumber'];
    $newBirthdate = $_POST['editbirthday'];
    $newSkills = $_POST['editskills'];
    $newHistory = $_POST['edithistory'];
    $newSocials = $_POST['editsocials'];


    // Update profile
    if ($freelancer->updateAbout($account_id, $newContact, $newBirthdate, $newSkills, $newHistory, $newSocials)) {
        // Update session data
        $_SESSION['Name'] = $newName;
        $_SESSION['contact'] = $newContact;
        $_SESSION['birthday'] = $newBirthdate;
        $_SESSION['skills'] = $newSkills;
        $_SESSION['history'] = $newHistory;
        $_SESSION['socials'] = $newSocials;

        
     }
    }
?>

<div class="about-section">
    <div class="about-left">
        <h2>ABOUT YOU</h2>
        <p> Name <?php echo htmlspecialchars($fullName); ?></p>
        <p> Contact <?php echo htmlspecialchars($contact); ?></p>
        <p> Birthdate <?php echo htmlspecialchars($birthday); ?></p>
        <br/>
        <h2>SKILLS</h2>
        <p><?php echo htmlspecialchars($skills); ?></p>
    </div>
    <div class="about-right">
        <h2>WORK HISTORY AND EXPERIENCE</h2>
        <p><?php echo htmlspecialchars($experience); ?></p>
        <br/>
        <h2>SOCIALS</h2>
        <p><?php echo htmlspecialchars($socials); ?></p>
    </div>
    <button class="edit-about" id="editAbout">EDIT ABOUT</button>
</div>

  <!--edit modal-->
  <div id="editAboutModal" class="modal-about">
    <div class="modal-content-about">
        <span class="close_about">&times;</span>
        <h3>Edit About</h3>
        <form id="aboutUpdateForm">
            <div class="form-grid-about">
                <div class="form-group-about">
                    <h1>ABOUT YOU</h1>
                    <label for="editname">Name</label>
                    <input type="text" id="editUserName" name="editname" placeholder="Name" value="<?php echo htmlspecialchars($fullName); ?>">

                    <label for="editnumber">Contact</label>
                    <input type="number" id="editUserNumber" name="editnumber" placeholder="Contact" value="<?php echo htmlspecialchars($contact); ?>">

                    <label for="editbirthday">Birth Date</label>
                    <input type="date" id="editUserBirthday" name="editbirthday" placeholder="Birthday" value="<?php echo htmlspecialchars($birthday); ?>">  
                    
                    <label for="editskill">Skills</label>
                    <textarea name="editskills"><?php echo htmlspecialchars($skills); ?></textarea>

                    <label for="edit_History">Work History</label>
                    <textarea name="edithistory"><?php echo htmlspecialchars($history); ?></textarea>

                    <label for="edit_Social">Socials</label>
                    <textarea name="editsocials" id="edituserSocial" placeholder="Social Media" value="<?php echo htmlspecialchars($socials); ?>" ></textarea>
                </div>
            </div>
            <button type="submit" class="button-edit-about">Save Changes</button>
        </form>
    </div>
    </div>

    public function updateAbout($account_id, $about) {
        try {
            $query = "UPDATE " . $this->table . " SET about = :about WHERE account_id = :account_id";
            $stmt = $this->conn->prepare($query);
            $params = [
                ":about" => $about,
                ":account_id" => $account_id
            ];
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("UpdateAbout error: " . $e->getMessage());
            return false;
        }
    }

    
create table about(
    about_id INT AUTO_INCREMENT PRIMARY KEY,
    contact INT(11) NOT NULL,
    birthday DATE NOT NULL,
    skills TEXT NOT NULL,
    history TEXT NOT NULL,
    socials TEXT NOT NULL
);

create table freelancer (
    account_id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR (100) NOT NULL,
    lastname VARCHAR (100) NOT NULL,
    email VARCHAR (100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL,
    profile_pic VARCHAR(255),
    about_id INT,
    FOREIGN KEY(about_id) REFERENCES about(about_id)
);