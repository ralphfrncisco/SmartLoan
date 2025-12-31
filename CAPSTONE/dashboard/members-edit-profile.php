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

    // Initialize variables to prevent undefined variable warnings
    $LastName = $FirstName = $MiddleName = $Suffix = $address = $contact_num = $email_add = $Gender = $DateOfBirth = $PlaceOfBirth = $occupation = $CivilStatus = $educ_attainment = $password = $profilePic = '';

    // Check if account_id is passed through the URL
    if (isset($_GET['account_id'])) {
        $account_id = $_GET['account_id'];

        // Query to retrieve account details
        $sql = "SELECT * FROM members_db WHERE account_id = '$account_id'";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Set values from the database
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
            $profilePic = $row['profile_pic']; // Assuming there's a column `profile_pic` in the database
        } else {
            echo "Account not found.";
        }
    }
    // Variables to store file upload path
    $uploadDir = "../uploads/profile_pics/"; // Folder to store uploaded images
    $imagePath = "../Resources/blank-profile.jpg";  // Default image path

    // Check if the form is submitted (Insert button clicked) and account_id is available
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profilePic']) && isset($_POST['account_id'])) {
        $file = $_FILES['profilePic'];
        $account_id = $_POST['account_id'];  // Get the account_id from POST data

        // Check for errors during upload
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Get the file extension and generate a unique name
            $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid('profile_', true) . '.' . $fileExt;
            $filePath = $uploadDir . $newFileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                // Insert the profile_pic into the database, linked to a specific account_id
                $sql = "UPDATE members_db SET profile_pic = '$filePath' WHERE account_id = '$account_id'";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Image uploaded successfully!'); window.location.href = 'members-profile.php?account_id=$account_id';</script>";
                    $imagePath = $filePath;  // Update the imagePath to show the new image
                } else {
                    echo "Error inserting into database: " . mysqli_error($conn);
                }
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "File upload error.";
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
    .bx
    {
        font-size: 20px!important;
        position: relative;
        top: 4px; /* Fine-tune for vertical alignment */
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
            width: 90%;
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
            <span class="navbar-brand mb-0 h1 text-white">Edit Profile</span>

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
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Left Section -->
                                <div class="col-md-4 text-center">
                                    <?php 
                                        // Check if the profile_pic field is empty or null
                                        $imagePath = (!empty($row['profile_pic']) && file_exists($row['profile_pic'])) ? $row['profile_pic'] : "../Resources/blank-profile.jpg";
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" id = "profilePic" alt="Profile Picture" class="profile-pic mb-3 object-fit-cover">
                                    <div class="col-md-12 mb-1 d-flex justify-content-center align-items-center text-center" style="height: 80px;">
                                        <button type="button" class="btn border border-dark-subtle" id="editBtn">Change <i class='bx bx-image-add'></i></button>
                                    </div>
                                    <input type="text" name="account_id" value="<?php echo $account_id; ?>" hidden>
                                    <!-- Hidden File Input for Image Selection -->
                                    <input type="file" name="profilePic" id="fileInput" accept="image/*" style="display: none;" onchange="changeProfilePic(event)">

                                    <script>
                                        // Function to trigger file input when the 'Edit' button is clicked
                                        document.getElementById('editBtn').addEventListener('click', function() {
                                            document.getElementById('fileInput').click();
                                        });

                                        // Function to change the profile picture preview before uploading
                                        function changeProfilePic(event) {
                                            const file = event.target.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    // Update the src of the profile image with the selected file
                                                    document.getElementById('profilePic').src = e.target.result;
                                                };
                                                reader.readAsDataURL(file); // Read the selected file as a data URL
                                            }
                                        }
                                    </script>
                                </div>

                                <!-- Right Section (Form Fields) -->
                                <div class="col-md-8 col-12" id = "profile-right-side">
                                    <div class = "row w-100" id = "profile-header">
                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                            <h3>Personal Details</h3>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control border border-dark-subtle" name = "firstName" id="firstName" value = "<?php echo $FirstName?>" placeholder = "<?php echo $FirstName?>">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control border border-dark-subtle" name = "lastName" id="lastName" value = "<?php echo $LastName?>" placeholder = "<?php echo $LastName?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="middleName" class="form-label">Middle Name</label>
                                            <input type="text" class="form-control border border-dark-subtle" name = "middleName" id="middleName" value = "<?php echo $MiddleName?>" placeholder = "<?php echo $MiddleName?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="suffix" class="form-label">Suffix</label>
                                            <input type="text" class="form-control border border-dark-subtle" name = "suffixName" id="suffix" value = "<?php echo $Suffix?>" placeholder = "<?php echo $Suffix?>">
                                        </div>
                                    </div>


                                    <div class="row mt-4">
                                        <div class="col-md-6 mb-4">
                                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control border border-dark-subtle" id="date_of_birth" value="<?php echo $DateOfBirth; ?>">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="sex-text" class="form-label">Sex</label>
                                            <select class = "form-select border border-dark-subtle" name = "gender" id = "sex_text">
                                                <option value="Male" <?php echo $Gender == "Male" ? "selected" : ""; ?>>Male</option>
                                                <option value="Female" <?php echo $Gender == "Female" ? "selected" : ""; ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="occupation_text" class="form-label">Occupation</label>
                                            <input type="text" class="form-control border border-dark-subtle" id="occupation_text" value="<?php echo $occupation;?>" placeholder="<?php echo $occupation;?>">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="Civil-Status" class="form-label">Civil Status</label>
                                            <select class="form-select border border-dark-subtle" name="Civil-Status" id = "civil-status" required>
                                                <option value="Single" <?php echo $CivilStatus == "Single" ? "selected" : ""; ?>>Single</option>
                                                <option value="Married" <?php echo $CivilStatus == "Married" ? "selected" : ""; ?>>Married</option>
                                                <option value="Widowed" <?php echo $CivilStatus == "Widowed" ? "selected" : ""; ?>>Widowed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="occupation_text" class="form-label">Educational Attainment</label>
                                            <select class = "form-select border border-dark-subtle" name="educational-attainment" >
                                                <option value="Elementary" <?php echo $educ_attainment == "Elementary" ? "selected" : ""; ?>>Elementary</option>
                                                <option value="High_School" <?php echo $educ_attainment == "High_School" ? "selected" : ""; ?>>High School</option>
                                                <option value="Senior_High_School" <?php echo $educ_attainment == "Senior_High_School" ? "selected" : ""; ?>>Senior High School</option>
                                                <option value="College" <?php echo $educ_attainment == "College" ? "selected" : ""; ?>>College</option>
                                                <option value="Masters" <?php echo $educ_attainment == "Masters" ? "selected" : ""; ?>>Master's</option>
                                                <option value="Doctorate" <?php echo $educ_attainment == "Doctorate" ? "selected" : ""; ?>>Doctorate</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="Civil-Status" class="form-label">Place of Birth</label>
                                            <input type="text" class="form-control border border-dark-subtle" id="suffix" value = "<?php echo $PlaceOfBirth?>">
                                        </div>
                                    </div>

                                    <div class="row mt-2 mb-2">
                                        <div class = "row mt-4 mb-4" id = "profile-header">
                                            <h3>Contact Details</h3>
                                        </div>
    
                                        <div class="col-md-6 mb-4">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control border border-dark-subtle" id="address" value = "<?php echo $address?>" placeholder = "<?php echo $address?>">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="contactNumber" class="form-label">Contact Number</label>
                                            <input type="text" class="form-control border border-dark-subtle" id="contactNumber" value = "<?php echo $contact_num?>" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="emailAddress" class="form-label">Email Address</label>
                                            <input type="email" class="form-control border border-dark-subtle" id="emailAddress" value="<?php echo $email_add;?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mt-2 mb-2">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <input type="submit" class="btn btn-primary mt-2" id="uploadBtn" value="Update" style="width: 50%;">
                                        </div>
                                    </div>
                                    <div class = "row mt-2 mb-4">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <a href="members-profile.php?account_id=<?php echo $account_id?>" class="btn btn-danger mt-2 d-block" style = "width: 50%;">Back</a>
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
