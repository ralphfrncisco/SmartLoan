<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "hfscco";
    
    //creating connection
    $conn = mysqli_connect($servername,$username,$password, $dbname);
    
    //checking connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $Lastname = $_POST['LastName'];
        $Firstname = $_POST['FirstName'];
        $MiddleName = $_POST['MiddleName'];
        $SuffixName = $_POST['SuffixName'];
        $Address = $_POST['address'];
        $Contact_Num = $_POST['ContactNum'];
        $EmailAdd = $_POST['Email_add'];
        $Gender = $_POST['gender'];
        $Date_of_Birth = $_POST['DateOfBirth'];
        $Place_of_Birth = $_POST['PlaceOfBirth'];
        $Occupation = $_POST['occupation'];
        $Civil_Status = $_POST['Civil-Status'];
        $educ_attainment = $_POST['educational-attainment'];
        $Password = $_POST['Password'];
        $encrypted_pw = md5($Password);
    
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $DateTime = date("F j, Y, g:i a");
    
        // Function to generate a unique application ID
        function generateUniqueApplicationId($conn) {
            $year = date('Y');
            $week = date('W');
            $day = date('d');
            $hour = date('H');
    
            do {
                // Generate a random two-digit number
                $randomNumber = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
    
                // Combine parts into application ID
                $application_id = "$year$week$day$hour$randomNumber";
    
                // Check if the generated ID already exists in the database
                $query = "SELECT COUNT(*) as count FROM members_db WHERE application_num = '$application_id'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                $isDuplicate = $row['count'] > 0;
            } while ($isDuplicate); // Repeat if a duplicate is found
    
            return $application_id;
        }
    
        // Generate unique application ID and account ID
        $application_id = generateUniqueApplicationId($conn);
        $account_id = 'PND' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    
        // Begin a database transaction
        $conn->begin_transaction();
    
        try {
            // Insert into members_db
            $sql = "INSERT INTO members_db(application_num, account_id, LastName, FirstName, MiddleName, Suffix, address, contact_no, email_address, gender, date_of_birth, place_of_birth, occupation, civil_status, educ_attainment, DateTime, password, acc_status) 
                    VALUES ('$application_id', '$account_id','$Lastname', '$Firstname', '$MiddleName', '$SuffixName', '$Address', '$Contact_Num', '$EmailAdd', '$Gender', '$Date_of_Birth', '$Place_of_Birth', '$Occupation', '$Civil_Status', '$educ_attainment', '$DateTime', '$encrypted_pw', 'Pending')";
            $conn->query($sql);
    
            // Insert into members_acc
            $sql2 = "INSERT INTO members_acc(account_id, application_num, Email, password, access_type, status) 
                     VALUES ('$account_id', '$application_id','$EmailAdd', '$encrypted_pw', 'member', 'Pending')";
            $conn->query($sql2);
    
            // Commit the transaction if both queries succeed
            $conn->commit();
    
            echo "<script>
                    alert('Registered successfully!');
                    window.location.href='../login-page.php';
                  </script>";
        } catch (Exception $e) {
            // Rollback the transaction if any query fails
            $conn->rollback();
            die('Registration failed: ' . $e->getMessage());
        }
    }
    
    
    
?>