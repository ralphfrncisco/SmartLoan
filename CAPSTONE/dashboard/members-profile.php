<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hfscco";

// Creating connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Checking connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if account_id is passed through the URL
if (isset($_GET['account_id'])) {
    $account_id = $_GET['account_id'];

    // Query to retrieve account details
    $sql = "SELECT * FROM members_db WHERE account_id = '$account_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $LastName = $row['LastName'];
    $FirstName = $row['FirstName'];
    $MiddleName = $row['MiddleName'];
    $Suffix = $row['Suffix'];
    $address = $row['address'];
    $contact_num = $row['contact_no'];
    $email_add = $row['email_address'];
    $Gender = $row['gender'];
    $DateOfBirth = $row['date_of_birth'];
    $PlaceOfBirth = $row['place_of_birth'];
    $occupation = $row['occupation'];
    $CivilStatus = $row['civil_status'];
    $educ_attainment = $row['educ_attainment'];
    $password = $row['password'];

    if ($educ_attainment == "High_School")
    {
        $formatted_educ = "High School";
    }
    else if ($educ_attainment == "Senior_High_School")
    {
        $formatted_educ = "Senior High School";
    }
    else if ($educ_attainment == "Masters")
    {
        $formatted_educ = "Master's";
    }
    else
    {
        $formatted_educ = $educ_attainment;
    }
}       

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFSCCO | My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="members-dashboard.css">
    <link rel="stylesheet" href="../css-files/font-import.css">
    <link rel="icon" type="image/x-icon" href="../Resources/hfscco-logo-title.ico">
</head>

<style>
    .profile-pic {
        border: 1px solid #d4cfcf;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-position: center center;
    }
    #edit-profile
    {
        padding: 7px 15px;
        border-radius: 9px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        color: rgba(0, 0, 0, 0.7);
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .bx
    {
        font-size: 20px!important;
        position: relative;
        top: 2px; /* Fine-tune for vertical alignment */
    }
    #edit-profile:hover
    {
        border: 1px solid rgba(0, 0, 0, 0.5);
        color: rgba(0, 0, 0, 0.8);
    }
    #accountNumber, #firstName, #middleName, #lastName, #suffix, 
    #address, #contactNumber, #emailAddress, #password, #sex_text, #occupation_text, #date_of_birth {
        border: 1px solid #aaa6a6;
    }
    @media (max-width: 425px) {
        #profile-header {
            width: 95%;
        }
        #edit-profile
        {
            margin-left: 1%!important;
            border: none;
            font-size: 14px;
        }
    }
</style>

<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-heading text-center py-4">
            <img src="../Resources/logo.png" alt="Logo" style="width: 50px; height: 50px;">
            <span>HFSCCO</span>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="member_dashboard.php?account_id=<?php echo $account_id; ?>">
                    <i class='bx bxs-dashboard'></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item" style = "margin-left: 4px;">
                <a class="nav-link" href="members_loan_calculator.php?account_id=<?php echo $account_id; ?>">
                    <i class="fas fa-calculator"></i>
                    <span style = "margin-left: 2px;">Calculate Loan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="members_loan_history.php?account_id=<?php echo $account_id; ?>">
                    <i class="fas fa-history"></i>
                    <span>Loan History</span>
                </a>
            </li>
            <li class="nav-item" style = "margin-left: 2px;">
                <a class="nav-link" href="members-profile.php?account_id=<?php echo $account_id?>">
                    <i class="fas fa-user"></i>
                    <span style = "margin-left: 2px;">My Profile</span>
                </a>
            </li>
        </ul>
        <a href = "../functions-php/logout.php" id = "logout-btn">
            <div class="logout">
                <i class='bx bx-log-out'></i>
                <span id = "logout-text">Log out</span>
            </div>
        </a>
    </div>

    <!-- Page Content -->
    <div id="page-content" class="content">
        <nav class="navbar navbar-expand-lg" id = "side-navbar">
            <a class="navbar-toggler d-block" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </a>
            <img src="../Resources/logo.png" alt="Logo" id = "navbar-logo" style="width: 50px; height: 50px; margin-right: 10px; display: none;">
            <span class="navbar-brand mb-0 h1 text-white">My Profile</span>

            <a class="navbar-toggler d-block ms-auto" id="sidebarToggle2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <i class="bi bi-list" id="ToggleIcon" style = "display: none;"></i>
            </a>
        </nav>
        
        <div class="offcanvas offcanvas-sm offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center">
                        <img src="../Resources/logo.png" alt="Logo" id="navbar-logo" style="width: 50px; height: 50px; margin-right: 8px;">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">HFSCCO</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>
            <div class="offcanvas-body">
                <div id="offcanvas-nav" class="d-flex justify-content-start" style="padding-top: 10px;">
                    <ul class="nav flex-column" style="width: 100%; max-width: 200px; margin-left: 5%;">
                        <li class="nav-item">
                            <a class="nav-link" href="member_dashboard.php?account_id=<?php echo $account_id; ?>">
                                
                                <span id = "nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left: 2px;">
                            <a class="nav-link" href="members_loan_calculator.php?account_id=<?php echo $account_id; ?>">
                                
                                <span id = "nav-text" >Calculate Loan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="members_loan_history.php?account_id=<?php echo $account_id; ?>">
                                
                                <span id = "nav-text" style="margin-left: 2px;">Loan History</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="members-profile.php?account_id=<?php echo $account_id?>">
                                
                                <span id = "nav-text" style="margin-left: 4px;">My Profile</span>
                            </a>
                        </li>
                        <li class = "nav-item" style = "margin-top: 15px;">
                            <a class="nav-link" href="../functions-php/logout.php">
                                <i class='bx bx-log-out' style = "margin-top: 5px; font-size: 16px!important;"></i>
                                <span id = "nav-text" style="margin-left: 4px;">Log out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>                       
        </div>

        <!-- Main content goes here -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-section p-2">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="row">
                                <!-- Left Section -->
                                <div class="col-md-4 text-center">
                                    <?php 
                                        // Check if the profile_pic field is empty or null
                                        $imagePath = (!empty($row['profile_pic']) && file_exists($row['profile_pic'])) ? $row['profile_pic'] : "../Resources/blank-profile.jpg";
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" alt="Profile Picture" class="profile-pic mb-3 object-fit-cover">
                                    <div class="col-md-12 mb-1 d-flex justify-content-center align-items-center text-center" style="height: 80px;">
                                        <p>Account Number : <br><?php echo $account_id?></p>
                                    </div>
                                </div>

                                <!-- Right Section (Form Fields) -->
                                <div class="col-md-8 col-12" id = "profile-right-side">
                                    <div class = "row w-100" id = "profile-header">
                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                            <h3>Personal Details</h3>
                                            <a href="members-edit-profile.php?account_id=<?php echo $account_id?>" class = "text-center" id = "edit-profile">Edit  <i class='bx bxs-edit-alt'></i></a>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName" value = "<?php echo $FirstName?>" readonly>
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" value = "<?php echo $LastName?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="middleName" class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" id="middleName" value = "<?php echo $MiddleName?>" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="suffix" class="form-label">Suffix</label>
                                            <input type="text" class="form-control" id="suffix" value = "<?php echo $Suffix?>" readonly>
                                        </div>
                                    </div>


                                    <div class="row mt-4">
                                        <div class="col-md-6 mb-4">
                                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                                            <?php 
                                                $timestamp = strtotime(str_replace('/', '-', $DateOfBirth));

                                                if ($timestamp) {
                                                    // Format the date into the desired format
                                                    $formattedDate = date('M d, Y', $timestamp); // Output as "Oct 29 2024"
                                                } else {
                                                    // Handle error (optional)
                                                    $formmattedDate = "Invalid date format: $DateOfBirth";
                                                }
                                            ?> 
                                            <input type="text" class="form-control" id="date_of_birth" value="<?php echo $formattedDate; ?>"readonly>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="sex-text" class="form-label">Sex</label>
                                            <input type="text" class="form-control" id="sex_text" value = "<?php echo $Gender?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="occupation_text" class="form-label">Occupation</label>
                                            <input type="text" class="form-control" id="occupation_text" value="<?php echo $occupation;?>" readonly>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="Civil-Status" class="form-label">Civil Status</label>
                                            <input type="text" class="form-control" id="suffix" value = "<?php echo $CivilStatus; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="occupation_text" class="form-label">Educational Attainment</label>
                                            <input type="text" class="form-control" id="occupation_text" value="<?php echo $formatted_educ?>" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Civil-Status" class="form-label">Place of Birth</label>
                                            <input type="text" class="form-control" id="suffix" value = "<?php echo $PlaceOfBirth?>" readonly>
                                        </div>
                                    </div>

                                    

                                    <div class="row mt-2 mb-2">
                                        <div class = "row mt-4 mb-4" id = "profile-header">
                                            <h3>Contact Details</h3>
                                        </div>
    
                                        <div class="col-md-6 mb-4">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" value = "<?php echo $address?>" readonly>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="contactNumber" class="form-label">Contact Number</label>
                                            <input type="text" class="form-control" id="contactNumber" value = "<?php echo $contact_num?>" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="emailAddress" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="emailAddress" value="<?php echo $email_add;?>" readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function handleResize() {
            const sidebar = document.getElementById('sidebar');
            const pageContent = document.getElementById('page-content');
            const sidebarToggle = document.getElementById('sidebarToggle2');
            const toggleIcon = document.getElementById('ToggleIcon');
        
            if (window.innerWidth < 450) {
                sidebar.classList.add('d-none');
                pageContent.style.width = '100%';
                pageContent.style.marginLeft = '0';
                sidebarToggle.style.display = 'block';
                toggleIcon.style.display = 'block';
            } 
            else if (window.innerWidth <= 1024) {
                sidebar.classList.remove('d-none');
                sidebar.classList.add('collapsed');
                pageContent.classList.add('collapsed');
                sidebarToggle.style.display = 'none';
                toggleIcon.style.display = 'none';
            } 
            else {
                sidebar.classList.remove('d-none');
                sidebar.classList.remove('collapsed');
                pageContent.style.width = '';
                pageContent.style.marginLeft = '';
                sidebarToggle.style.display = 'none';
                toggleIcon.style.display = 'none';
            }
        }
        
        window.addEventListener('DOMContentLoaded', handleResize);
        window.addEventListener('resize', handleResize);              

        // Initial check on page load
        handleResize();

        // Check on window resize
        window.addEventListener('DOMContentLoaded', handleResize);
        window.addEventListener('resize', handleResize);

        // Toggle sidebar on button click
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('page-content').classList.toggle('collapsed');
            var logout_text = document.getElementById('logout-text');
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
