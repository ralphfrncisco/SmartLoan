<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "hfscco";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize account variable
    $account_found = false;
    $contact_num = '';

    // Check if the form is submitted
    if (isset($_POST['find-btn'])) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $account_id = $_POST["account-num"];
            $account_name = $_POST["Account_Name"];
            $email_add = $_POST["Email_add"];

            // Debugging SQL query
            $sql = "SELECT * FROM members_db 
                    WHERE account_id = '$account_id' 
                    AND CONCAT(LastName, ', ', FirstName, ' ', MiddleName, ' ', Suffix) = '$account_name'
                    AND email_address = '$email_add'";

            $result = mysqli_query($conn, $sql);
            if ($result === false) {
                echo "Error in SQL query: " . mysqli_error($conn); // Show SQL error if any
            }

            // Check if a match is found
            if (mysqli_num_rows($result) > 0) {
                $account_found = true; // Set variable if account is found
                $row = mysqli_fetch_assoc($result);

                $account_id = $row['account_id'];
                $formatted_account_id = sprintf('%04d', $account_id);


                $FirstName = $row['FirstName'];
                $MiddleName = $row['MiddleName'];
                $LastName = $row['LastName'];
                $Suffix = $row['Suffix'];
                $email_address = $row['email_address'];
                $contact_num = $row['contact_no'];
                $gender = $row['gender'];
                $address = $row['address'];
                $date_of_birth = $row['date_of_birth'];
                $occupation = $row['occupation'];
                $place_of_birth = $row['place_of_birth'];
                $civil_status = $row['civil_status'];
                $educational_attainment = $row['educ_attainment'];
            } else {
                echo "<script>alert('Account not found!');</script>";
            }
        }
    }
    if (isset($_POST['setPassword']))
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $password = $_POST['password_input'];
            $encrypted_pw = md5($password);

            $sql2 = "UPDATE members_db SET password = '$encrypted_pw', approval_status = 'Fully Approved', acc_status = 'Active' WHERE account_id = $account_id";

            $result2 = mysqli_query($conn, $sql2);
            if ($result2 === false) {
                echo "Error in SQL query: " . mysqli_error($conn); // Show SQL error if any
            }
            else
            {
                echo "<script>
                    alert('You can now login using your email address and your password!');
                    window.location.href='../login-page.php';
                </script>";
            }

        }
    }
?>