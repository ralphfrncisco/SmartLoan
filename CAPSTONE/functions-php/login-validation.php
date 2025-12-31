<?php
session_start();
$servername = "localhost: 3306";
$username = "root";
$password = "";
$dbname = "hfscco";

// Creating connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Checking connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if (isset($_POST['sign-in'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["Email-txt"];
        $password = $_POST["Password-txt"];

        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        $encrypted_pw = md5($password);

        $sql = "SELECT * FROM members_acc WHERE Email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Check if the entered password matches the stored password
            if ((md5($password)) == $row['password']) {
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['access_type'] = $row['access_type'];

                // Signing-in Audit Log
                $timestamp = date("Y-m-d H:i:s");
                $sql3 = "INSERT INTO audit_logs(action, actor, timestamp) VALUES('Signed-in', '$email', '$timestamp')";
                $result3 = $conn->query($sql3);

                if ($_SESSION['access_type'] == 'ceo') {
                    header('Location: ../ceo/ceo_dashboard.php');
                    exit;
                } elseif ($_SESSION['access_type'] == 'loan_personnel') {
                    header("Location: ../loan-personnel/loan-personnel-dashboard.php");
                    exit;
                } elseif ($_SESSION['access_type'] == 'credit_committee') {
                    header("Location: ../credit-committee/credit-committee-dashboard.php");
                    exit;
                } elseif ($_SESSION['access_type'] == 'membership_committee') {
                    header("Location: ../membership-personnel/membership-committee-dashboard.php");
                    exit;
                } elseif ($_SESSION['access_type'] == 'board_of_director') {
                    // Update column names to match those in the members_acc table
                    $sql2 = "SELECT account_id FROM members_acc WHERE Email = '$email'";
                    $result2 = $conn->query($sql2);
                
                    if ($result2 && $result2->num_rows == 1) {
                        $row2 = $result2->fetch_assoc();
                        $_SESSION['account_id'] = $row2['account_id'];
                        header("Location: ../bod/bod_dashboard.php?account_id=" . $_SESSION['account_id']);
                        exit;
                    } else {
                        // User does not exist
                        header("Location: ../login-page.php?error=user_not_exist");
                        exit;
                    }

                } 
                elseif ($_SESSION['access_type'] == 'member') {
                    $sql1 = "SELECT account_id, acc_status FROM members_db WHERE email_address = '$email' AND password = '$encrypted_pw'";
                    $result1 = $conn->query($sql1);
                
                    if ($result1 && $result1->num_rows == 1) {
                        $row1 = $result1->fetch_assoc();
                        
                        if ($row1['acc_status'] == 'Disapproved') {
                            echo "<script>
                                    alert('Your application is disapproved. Contact the HFSCCO Office for further clarification.');
                                    window.location.href = '../login-page.php';
                                  </script>";
                        }
                        elseif ($row1['acc_status'] == 'Pending')
                        {
                            echo "<script>
                                    alert('Your application is still waiting for approval. \\n\\nContact the HFSCCO Office for further clarification.');
                                    window.location.href = '../login-page.php';
                                  </script>";
                        }
                        else 
                        {
                            $_SESSION['account_id'] = $row1['account_id'];
                            header("Location: ../dashboard/member_dashboard.php?account_id=" . $_SESSION['account_id']);
                            exit;
                        }
                    } 
                    else {
                        // User does not exist
                        header("Location: ../login-page.php?error=user_not_exist");
                        exit;
                    }
                }

            }
             else {
                // Incorrect password
                header("Location: ../login-page.php?error=incorrect_password");
                exit;
            }
        } 
        else {
            // User does not exist
            header("Location: ../login-page.php?error=user_not_exist");
            exit;
        }
    }
}

?>