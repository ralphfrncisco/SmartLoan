<?php
    $connect = mysqli_connect("localhost:3306", "root", "", "hfscco");
    $message = '';
    
    // Initialize preview_data to hold CSV data for previewing
    $preview_data = [];
    
    // Preview CSV
    if (isset($_POST["preview"])) {
        // Check if a file is selected
        if ($_FILES['product_file']['name']) {
            $filename = explode(".", $_FILES['product_file']['name']);
    
            // Validate if the file is in CSV format
            if (end($filename) == "csv") {
                $handle = fopen($_FILES['product_file']['tmp_name'], "r"); // Open the CSV file for reading
                // Skip the first row (headers)
                fgetcsv($handle);
                
                // Read each subsequent row of CSV data
                while ($data = fgetcsv($handle)) {
                    // Store CSV data in the preview_data array
                    $preview_data[] = [
                        'application_num' => $data[0],
                        'account_id' => $data[1],
                        'LastName' => $data[2],
                        'FirstName' => $data[3],
                        'MiddleName' => $data[4],
                        'Suffix' => $data[5],
                        'address' => $data[6],
                        'contact_no' => $data[7],
                        'email_address' => $data[8],
                        'gender' => $data[9],
                        'date_of_birth' => $data[10],
                        'place_of_birth' => $data[11],
                        'occupation' => $data[12],
                        'civil_status' => $data[13],
                        'educ_attainment' => $data[14],
                        'password' => $data[15],
                        'DateTime' => $data[16],
                        'approval_time' => $data[17],
                        'approval_status' => $data[18],
                        'acc_status' => $data[19]
                    ];
                    
                }
                fclose($handle); // Close the CSV file after reading
            } else {
                $message = '<label class="text-danger">Please Select CSV File only</label>'; // Error message if the file is not CSV
            }
        } else {
            $message = '<label class="text-danger">Please Select File</label>'; // Error message if no file is selected
        }
    }

    if (isset($_POST["save_changes"])) {
        $appNums = $_POST['application_num'];
        $accIDs = $_POST['account_id'];
        $lastNames = $_POST['LastName'];
        $firstNames = $_POST['FirstName'];
        $middleNames = $_POST['MiddleName'];
        $suffixs = $_POST['Suffix'];
        $addresss = $_POST['address'];
        $contactNos = $_POST['contact_no'];
        $emailAdds = $_POST['email_address'];
        $genders = $_POST['gender'];
        $doBirths = $_POST['date_of_birth'];
        $poBirths = $_POST['place_of_birth'];
        $occupations = $_POST['occupation'];
        $civStatuss = $_POST['civil_status'];
        $educAttmnts = $_POST['educ_attainment'];
        $passwords = $_POST['password'];
        $dateTimes = $_POST['DateTime'];
        $appTimes = $_POST['approval_time'];
        $appStatuss = $_POST['approval_status'];
        $accStatuss = $_POST['acc_status'];
        
        $errors = [];
        
        foreach ($appNums as $index => $appNum) {
            $accID = $accIDs[$index];
            $lastName = $lastNames[$index];
            $firstName = $firstNames[$index];
            $middleName = $middleNames[$index];
            $suffix = $suffixs[$index];
            $address = $addresss[$index];
            $contactNo = $contactNos[$index];
            $emailAdd = $emailAdds[$index];
            $gender = $genders[$index];
            $doBirth = $doBirths[$index];
            $poBirth = $poBirths[$index];
            $occupation = $occupations[$index];
            $civStatus = $civStatuss[$index];
            $educAttmnt = $educAttmnts[$index];
            $password = $passwords[$index];
            $dateTime = $dateTimes[$index];
            $appTime = $appTimes[$index];
            $appStatus = $appStatuss[$index];
            $accStatus = $accStatuss[$index];
            
    
            // Query to insert or update the loan balance data
            $query = "
                INSERT INTO members_db (application_num, account_id, LastName, FirstName, MiddleName, Suffix, address, contact_no, email_address, gender, date_of_birth, place_of_birth, occupation, civil_status, educ_attainment, password, DateTime, approval_time, approval_status, acc_status)
                VALUES ('$appNum', '$accID', '$lastName', '$firstName', '$middleName', '$suffix', '$address', '$contactNo', '$emailAdd', '$gender', '$doBirth', '$poBirth', '$occupation', '$civStatus', '$educAttmnt', '$password', '$dateTime', '$appTime', '$appStatus', '$accStatus')
                ON DUPLICATE KEY UPDATE
                    account_id = '$accID',
                    LastName = '$lastName',
                    FirstName = '$firstName',
                    MiddleName = '$middleName',
                    Suffix = '$suffix',
                    address = '$address',
                    contact_no = '$contactNo',
                    email_address = '$emailAdd',
                    gender = '$gender',
                    date_of_birth = '$doBirth',
                    place_of_birth = '$poBirth',
                    occupation = '$occupation',
                    civil_status = '$civStatus',
                    educ_attainment = '$educAttmnt',
                    password = '$password',
                    DateTime = '$dateTime',
                    approval_time = '$appTime',
                    approval_status = '$appStatus',
                    acc_status = '$accStatus'";
    
            // Execute each query individually
            if (!mysqli_query($connect, $query)) {
                $errors[] = "Error for Application Number $appNum: " . mysqli_error($connect);
            }
        }
        
        if (empty($errors)) {
            echo "<script>alert('Data is imported successfully.');</script>";
        } else {
            echo "<script>alert('Errors occurred: " . implode(", ", $errors) . "');</script>";
        }
    }       
    
    // Display data from the members_db table
    $query = "SELECT * FROM members_db";
    $result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFSCCO | Membership Committee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel = "stylesheet" href = "../css-files/admin-design.css">
    <link rel="stylesheet" href="../css-files/font-import.css">
    <link rel = "icon" type="image/x-icon" href="../Resources/hfscco-logo-title.ico">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<style>
    input[type=text] {
        border: none;
    }
</style>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-heading text-center py-4">
            <img src="../Resources/logo.png" alt="Logo" style="width: 50px; height: 50px;">
            <span id = "sidenav-heading-text">HFSCCO</span>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="membership-committee-dashboard.php">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="membership-committee-PendingMSA.php">
                    <i class='bx bxs-file' ></i>
                    <span>Pending MSA</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="membership-upload-records.php">
                    <i class="bi bi-person-fill-add"></i>
                    <span style = "margin-top: 5px;">Import Accounts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="membership-committee-setPassword.php">
                    <i class='bx bxs-lock'></i>
                    <span>Set Password</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="membership-committee-memberList.php">
                    <i class='bx bxs-group'></i>
                    <span>Member's List</span>
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
            <span class="navbar-brand mb-0 h1 text-white">Import Accounts</span>

            <a class="navbar-toggler d-block ms-auto" id="sidebarToggle2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <i class="bi bi-list" id="ToggleIcon"></i>
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
                            <a class="nav-link" href="membership-committee-dashboard.php">
                                
                                <span id = "nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left: 2px;">
                            <a class="nav-link" href="membership-committee-PendingMSA.php">
                                
                                <span id = "nav-text" >Pending MSA</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left: 2px;">
                            <a class="nav-link" href="membership-committee-PendingMSA.php">
                                
                                <span id = "nav-text">Import Accounts</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left: 2px;">
                            <a class="nav-link" href="membership-committee-setPassword.php">
                                <span id = "nav-text">Set Password</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="membership-committee-memberList.php">
                                
                                <span id = "nav-text" style="margin-left: 2px;">Member's List</span>
                            </a>
                        </li>

                        <li class="nav-item" style="margin-top: 15px;">
                            <a class="nav-link" href="../functions-php/logout.php">
                                <i class='bx bx-log-out'></i>
                                <span id="nav-text" style="margin-left: 4px;">Log out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>                       
        </div>

        <!-- Main content goes here -->
        <div class="container-xxl mb-5">
            <form method="post" enctype='multipart/form-data'>
                <label>Please Select File<br />File Format: CSV</label>
                <br>
                <input type="file" name="product_file" class = "mt-2">
                <br>
                <input type="submit" name="preview" class="btn btn-warning mt-4" value="Preview" />
            </form>

            <?php if (!empty($preview_data)) : ?>
                <h3 align="center">CSV File Preview</h3>
                <br />
                <form method="post">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Application Number</th>
                                <th>Account ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Middle Name</th>
                                <th>Suffix</th>
                                <th>Address</th>
                                <th>Contact No.</th>
                                <th>Email</th>
                                <th>Sex</th>
                                <th>Birthday</th>
                                <th>Birthplace</th>
                                <th>Occupation</th>
                                <th>Civil Status</th>
                                <th>Education</th>
                                <th>Password</th>
                                <th>DateTime</th>
                                <th>Approval Time</th>
                                <th>Approval Status</th>
                                <th>Account Status</th>
                                
                            </tr>
                            <?php foreach ($preview_data as $row) : ?>
                                    <tr>
                                        <td><input type="text" name="application_num[]" value="<?php echo $row['application_num']; ?>" readonly></td>
                                        <td><input type="text" name="account_id[]" value="<?php echo $row['account_id']; ?>" readonly></td>
                                        <td><input type="text" name="LastName[]" value="<?php echo $row['LastName']; ?>" readonly></td>
                                        <td><input type="text" name="FirstName[]" value="<?php echo $row['FirstName']; ?>" readonly></td>
                                        <td><input type="text" name="MiddleName[]" value="<?php echo $row['MiddleName']; ?>" readonly></td>
                                        <td><input type="text" name="Suffix[]" value="<?php echo $row['Suffix']; ?>" readonly></td>
                                        <td><input type="text" name="address[]" value="<?php echo $row['address']; ?>" readonly></td>
                                        <td><input type="text" name="contact_no[]" value="<?php echo $row['contact_no']; ?>" readonly></td>
                                        <td><input type="text" name="email_address[]" value="<?php echo $row['email_address']; ?>" readonly></td>
                                        <td><input type="text" name="gender[]" value="<?php echo $row['gender']; ?>" readonly></td>
                                        <td><input type="text" name="date_of_birth[]" value="<?php echo $row['date_of_birth']; ?>" readonly></td>
                                        <td><input type="text" name="place_of_birth[]" value="<?php echo $row['place_of_birth']; ?>" readonly></td>
                                        <td><input type="text" name="occupation[]" value="<?php echo $row['occupation']; ?>" readonly></td>
                                        <td><input type="text" name="civil_status[]" value="<?php echo $row['civil_status']; ?>" readonly></td>
                                        <td><input type="text" name="educ_attainment[]" value="<?php echo $row['educ_attainment']; ?>" readonly></td>
                                        <td><input type="text" name="password[]" value="<?php echo $row['password']; ?>" readonly></td>
                                        <td><input type="text" name="DateTime[]" value="<?php echo $row['DateTime']; ?>" readonly></td>
                                        <td><input type="text" name="approval_time[]" value="<?php echo $row['approval_time']; ?>" readonly></td>
                                        <td><input type="text" name="approval_status[]" value="<?php echo $row['approval_status']; ?>" readonly></td>
                                        <td><input type="text" name="acc_status[]" value="<?php echo $row['acc_status']; ?>" readonly></td>
                                    </tr>
                                <?php endforeach; ?>

                        </table>
                    </div>
                    <input type="submit" name="save_changes" class="btn btn-success" value="Save Changes">
                </form>
            <?php endif; ?>
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