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

        <div class="container p-3">
            <div class="row align-items-center mt-3 mb-4">
                <div class="col-12 col-md-8 mb-2 mb-md-0">
                    <h2>Past Transactions</h2>
                </div>
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <input class="form-control border border-dark-subtle" type="text" id="search-bar" placeholder="Search" aria-label="Search" style="width: 230px;">
                        <select class="form-select border border-dark-subtle" aria-label="Sort by">
                            <option selected disabled>Sort by</option>
                            <option value="name">Name</option>
                            <option value="date">Date</option>
                            <option value="invoice">Invoice ID</option>
                            <option value="amount">Amount</option>
                            <option value="status">Status</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive p-1">
                <table class="table" id="members-loan-history-table">
                    <thead id="history-header" style="background-color: #e0e0e0;">
                        <tr class="align-bottom">
                            <th id="td-loanType" style="text-align: left; width: 19%; padding-left: 1.3%;">Loan Type</th>
                            <th id="td-date" style="width: 15%; text-align: left; padding-left: 3%;">Date</th>
                            <th id="td-invoice" style="width: 14%;">Promissory Note Number</th>
                            <th id="td-Amount" style="width: 18%; text-align: center;">Amount</th>
                            <th id="td-Status" style="width: 18%;">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM financial_db WHERE account_id = '$account_id' ORDER BY date_applied DESC";
                            if(isset($_POST['search-btn'])) {

                                $search = $_POST['txt_search'];
                                $sql = "SELECT application_id, LastName, FirstName, loan_Amount, date_applied, type_of_application, application_status FROM financial_db 
                                WHERE application_id LIKE '%$search%'OR LastName LIKE '%$search%' OR FirstName LIKE '%$search%' OR loan_Amount LIKE '%$search%' OR date_applied
                                LIKE '%$search%' OR application_status LIKE '%$search%'";
                            }
                            $result = $conn->query($sql);

                            if (!$result) {
                                die("Invalid query");
                            }
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $applicationID = $row["application_id"];
                                    echo "<tr id='transaction-tr'>";
                                    echo "<td class='fw-medium' style='text-align: left; padding-left: 1%;'>" . htmlspecialchars($row["loan_type"]) . "</td>";
                                    echo "<td style='text-align: left; padding-left: 3%;' id='dateAndTime'>" . date("d/m/Y", strtotime($row["date_applied"])) . "<br><small id='time' style='opacity: 0.92; font-size: 0.778rem;'>At " . date("h:i A", strtotime($row["date_applied"])) . "</small></td>";
                                    echo "<td class='fw-normal' style='opacity: 0.95; font-weight: 500;'> #" . htmlspecialchars(sprintf('%04d', $applicationID)) . "</td>";
                                    $statusColor = '';
                                    $strikethrough = '';
                                    if ($row['application_status'] == 'Declined') {
                                        $statusColor = 'color: red;';
                                        $strikethrough = 'color: red; text-decoration: line-through;';
                                    } elseif ($row['application_status'] == 'For Releasing' || $row['application_status'] == 'Received') {
                                        $statusColor = 'color: green;';
                                        $strikethrough = 'text-decoration: none; color: black;';
                                    } elseif ($row['application_status'] == 'For CEO Evaluation' || $row['application_status'] == 'For Credit Committee Evaluation' || $row['application_status'] == 'For BOD Evaluation') {
                                        $statusColor = 'color: #F45C2F;';
                                        $strikethrough = 'text-decoration: none; color: black;';
                                    }else {
                                        $statusColor = 'color: #F45C2F;';
                                        $strikethrough = 'text-decoration: none; color: black;';
                                    }
                                    echo "<td class='fw-medium' style='text-align: center; $strikethrough'>₱ " . number_format($row["loan_Amount"], 2) . "</td>";
                                    echo "<td class='fst-normal' style = '$statusColor'>" . htmlspecialchars($row["application_status"]) . "</td>";
                                    echo "<td class='text-decoration-underline' id = 'view'><a class = 'text-secondary-emphasis' href='members_loanDetailedView.php?application_id=$applicationID'>Details</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No loan history found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>

        #members-loan-history-table
        {
            overflow-x: hidden;
            font-family: 'Roboto', 'Public Sans', sans-serif;
            font-size: 0.978rem!important;
            width: 100%;
            padding: 12px;
            text-align: center;
            white-space: nowrap;
    
            margin-top: 1%;
            
        }
    
        .text-danger
        {
            text-align: center;
        }
    
        #members-loan-history-table thead tr
        {
            color: #151C2B;
            height: 15px;
            border-bottom: 1px solid rgba(198, 210, 222, 0.8)!important;
        }
        #members-loan-history-table tbody tr
        {
            color: #444447;
        }
        #td-spacer td
        {
            display: block;
            height: 20px!important;
            padding: 0;
            border: 1px solid red;
        }
        #transcation-tr td
        {
            padding-bottom: 55px!important;
            font-weight: 600;
            font-size: 0.900rem;
        }
        
        #history-header th
        {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight: bold;
            padding-bottom: 0.7%;
            padding-top: 0.7%;
        }
    
        #members-loan-history-table thead, #members-loan-history-table tr, #members-loan-history-table td
        {
            border: none;
        }
        #view
        {
            cursor: pointer;
        }


        /* Media query for mobile screens (adjust font size) */
        @media (max-width: 450px) {
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