<?php
    session_start();
    $account_id = $_SESSION['account_id'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hfscco";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch loan history data
    $sql = "SELECT * FROM financial_db WHERE account_id = '$account_id' ORDER BY date_applied DESC";
    $result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HFSCCO | Loan History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="members-dashboard.css">
    <link rel="stylesheet" href="../css-files/font-import.css">
    <link rel="icon" type="image/x-icon" href="../Resources/hfscco-logo-title.ico">
</head>

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
            <li class="nav-item" style="margin-left: 4px;">
                <a class="nav-link" href="members_loan_calculator.php?account_id=<?php echo $account_id; ?>">
                    <i class="fas fa-calculator"></i>
                    <span style="margin-left: 2px;">Calculate Loan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="members_loan_history.php?account_id=<?php echo $account_id; ?>">
                    <i class="fas fa-history"></i>
                    <span>Loan History</span>
                </a>
            </li>
            <li class="nav-item" style="margin-left: 2px;">
                <a class="nav-link" href="members-profile.php?account_id=<?php echo $account_id?>">
                    <i class="fas fa-user"></i>
                    <span style="margin-left: 2px;">My Profile</span>
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
        <nav class="navbar navbar-expand-lg" id="side-navbar">
            <a class="navbar-toggler d-block" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </a>
            <img src="../Resources/logo.png" alt="Logo" id="navbar-logo" style="width: 50px; height: 50px; margin-right: 10px; display: none;">
            <span class="navbar-brand mb-0 h1 text-white">Loan History</span>

            <a class="navbar-toggler d-block ms-auto" id="sidebarToggle2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <i class="bi bi-list" id="ToggleIcon" style="display: none;"></i>
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
                                <span id="nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left: 2px;">
                            <a class="nav-link" href="members_loan_calculator.php?account_id=<?php echo $account_id; ?>">
                                <span id="nav-text">Calculate Loan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="members_loan_history.php?account_id=<?php echo $account_id; ?>">
                                <span id="nav-text" style="margin-left: 2px;">Loan History</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="members-profile.php?account_id=<?php echo $account_id?>">
                                <span id="nav-text" style="margin-left: 4px;">My Profile</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 15px;">
                            <a class="nav-link" href="">
                                <i class='bx bx-log-out'></i>
                                <span id="nav-text" style="margin-left: 4px;">Log out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-sm p-3 mt-5">
            <?php
                $sql2 = "SELECT * FROM members_db WHERE account_id = '$account_id'";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();
            ?>
            <div class = "row" id = "LAF-header">
                <h3>Loan Application Details</h3>
            </div>
            <div class="row mt-3 mb-3" id="account-details">
                <div class="col-12 col-md-6 col-lg-3 mb-2">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control border border-dark-subtle" name = "FirstName" value="<?php echo $row2["FirstName"]?>" readonly>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-2">
                    <label class="form-label">Middle Name:</label>
                    <input type="text" class="form-control border border-dark-subtle" name = "MiddleName" value="<?php echo $row2["MiddleName"]?>" readonly>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-2">
                    <label class="form-label">Last Name:</label>
                    <input type="text" class="form-control border border-dark-subtle" name = "LastName" value="<?php echo $row2["LastName"]?>" readonly>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-2">
                    <label class="form-label">Suffix:</label>
                    <input type="text" class="form-control border border-dark-subtle" name = "SuffixName" value="<?php echo $row2["Suffix"]?>" readonly>
                </div>


            </div>

            <div class = "row mb-3">
                <!-- First column -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                    <label class="form-label">Account ID:</label>
                    <input type="text" class="form-control border border-dark-subtle" name = "accountID" value = "<?php echo $account_id?>" readonly>
                </div>
                <!-- Second column -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                    <label class="form-label">Email Address:</label>
                    <input type="text" class="form-control border border-dark-subtle" name = "email_add" value = "<?php echo $row2["email_address"]?>" readonly>
                </div>
                <!-- Third column -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                    <label class="form-label">Contact Number:</label>
                    <input type="number" class="form-control border border-dark-subtle" name = "contact_no" value = "<?php echo $row2["contact_no"]?>" readonly>
                </div>
            </div>

            <div class="row mt-5">
                <?php
                    $applicationID = $_GET["application_id"];
                    $sql3 = "SELECT * FROM financial_db WHERE application_id = $applicationID";
                    $result3 = $conn->query($sql3);
                    $row3 = $result3->fetch_assoc();
                ?>
                
                <div class="col-sm-12">
                    <div class="row">
                        <!-- First column -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                            <label class="form-label">Loan Amount Applied:</label>
                            <input type="text" class="form-control border border-dark-subtle" value = "₱ <?php echo $row3['loan_Amount']?>" readonly>
                        </div>
                        <!-- Second column -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                            <label class="form-label">Loan Term Applied:</label>
                            <input type="text" class="form-control border border-dark-subtle" value = "<?php echo $row3['loan_term_applied']?> months" readonly>
                        </div>
                        <!-- Third column -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                            <label class="form-label">Date Applied:</label>
                            <input type="text" class="form-control border border-dark-subtle" value = "<?php echo $row3['date_applied']?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-2 mb-2">
                        <!-- Fourth column -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                            <label class="form-label">Loan Type:</label>
                            <input type="text" class="form-control border border-dark-subtle" value = "<?php echo $row3['loan_type']?>" readonly>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                            <label class="form-label">Manner of Payment:</label>
                            <input type="text" class="form-control border border-dark-subtle" value = "<?php echo $row3['manner_of_payment']?>" readonly>
                        </div>
                        <!-- Fifth column -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                            <label class="form-label">Type of Application:</label>
                            <input type="text" class="form-control border border-dark-subtle" value = "<?php echo $row3['type_of_application']?>" readonly>
                        </div>
                    </div>

                    <!-- Responsive textarea -->
                    <div class="row mt-3 mb-2">
                        <div class="col-12">
                            <label class="form-label">Loan Purpose:</label>
                            <textarea class="form-control border border-dark-subtle" placeholder="" name = "loan-purpose-txtarea" id="floatingTextarea" rows="3" style="resize: none;" value = "">
                                <?php echo $row3['loan_purpose']?>
                            </textarea>
                        </div>
                    </div>
                    <div class = "col-1 mt-4">
                        <a href="members_loan_history.php?account_id=<?php echo $account_id; ?>" class="btn me-auto" id = "cancel-btn"><i class="bi bi-chevron-left"></i>Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #breadcrumbs
        {
            margin-top: 3%;
        }
        #LAF-header
        {
            margin-top: 4%;
        }
        #cancel-btn
        {
            border: 1px solid rgb(182, 188, 200);
            color:rgba(0, 0, 0, 0.7);
            padding-right: 15px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #cancel-btn i
        {
            font-size: 0.972rem;
            margin-left: -5px;
            margin-top: 5px;
            margin-right: 5px;
        }
        /* Media query for mobile screens (adjust font size) */
        @media (max-width: 450px) {
            #LAF-header
            {
                margin-top: -7%;
            }
            #cancel-btn
            {
                width: 90px;
            }
            .input-group .form-control,
            .input-group .form-select {
                height: 30px; /* Adjust the height */
                font-size: 0.875rem; /* Adjust the font size */
                padding: 0.25rem 0.5rem; /* Adjust the padding */
            }
            #transaction-tr td {
                font-size: 0.675rem!important; 
            }
            #history-header th
            {
                padding-top: 5px;
                font-size: 0.685rem!important;
            }
            #td-spacer td
            {
                height: 13px!important;
            }
            #td-loanType 
            {
                padding-left: 2%!important;
            }
            #td-date 
            {
                padding-left: 1.4%!important;
            }
            #time
            {
                font-size: 0.645rem!important; 
            }
            #dateAndTime
            {
                padding-left: 1.3%!important;
            }
            #search-bar
            {
                width: 130px!important;
            }
        }
    </style>

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
            } else {
                sidebar.classList.remove('d-none');
                sidebar.classList.remove('collapsed');
                pageContent.classList.remove('collapsed');
                sidebarToggle.style.display = 'none';
                toggleIcon.style.display = 'none';
                if (window.innerWidth <= 1024) {
                    sidebar.classList.add('collapsed');
                    pageContent.classList.add('collapsed');
                }
            }
        }
        
        window.addEventListener('DOMContentLoaded', handleResize);
        window.addEventListener('resize', handleResize);
        handleResize();

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
<?php
$conn->close();
?>