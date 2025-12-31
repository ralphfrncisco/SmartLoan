<?php
    session_start();

    if (!isset($_SESSION['account_id'])) {
        // Not logged in, redirect to login page
        header("Location: ../login-page.php");
        exit;
    }
    else {
        $account_id = $_SESSION['account_id'];
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFSCCO | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel = "stylesheet" href = "members-dashboard.css">
    <link rel="stylesheet" href="../css-files/font-import.css">
    <link rel = "icon" type="image/x-icon" href="../Resources/hfscco-logo-title.ico">
</head>

<?php
    // Connect to the database globally
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "hfscco";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to retrieve necessary data from the detailed_payments table
    $sql3 = "SELECT loan, balance, interest, total, data_as_of FROM loan_balance WHERE account_id = '$account_id'";

    // Execute the query on detailed_payments
    $result3 = $conn->query($sql3);
    $row3 = $result3->fetch_assoc();

    $formatted_balance = isset($row3['balance']) ? number_format($row3['balance'], 2) : "-";
    $formatted_interest = isset($row3['interest']) ? number_format($row3['interest'], 2) : "-";
    $formatted_total = isset($row3['total']) ? number_format($row3['total'], 2) : "-";

?>


<body>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-heading text-center py-4">
            <img src="../Resources/logo.png" alt="Logo" style="width: 50px; height: 50px;">
            <span id = "sidenav-heading-text">HFSCCO</span>
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
            <span class="navbar-brand mb-0 h1 text-white">Dashboard</span>

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
                        <li class="nav-item" style="margin-top: 15px;">
                            <a class="nav-link" href="../functions-php/logout.php">
                                <i class='bx bx-log-out' style = "margin-top: 5px; font-size: 16px!important;"></i>
                                <span id="nav-text" style="margin-left: 4px;">Log out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>                       
        </div>

        <!-- Main content goes here -->
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 text-white p-3 object-fit-cover" id = "loan-due-payment">
                        <!--REMAINING BALANCE // LOAN DUE-->
                        <div class = "p-2 d-flex justify-content-between" id = "card-header">
                            <h3>Total Amount Due</h3>
                            <img src = "../Resources/logo.png" id = "card-logo" style = "width: 6vh; margin-right: 10px;">     
                        </div>

                        <div class="card-body p-5">

                            <h1 class = "text-center" id = "remaining-balance-data">
                                <b><?php echo "₱ " . $formatted_total; ?></b>
                            </h1>
                            <div class="d-flex justify-content-center align-items-center text-center" id = "balance-interest" style="margin: 0 auto;">
                                <p><span id = "balance-text">Balance:</span> <span id="lighter"><?php echo "₱ " . $formatted_balance; ?></span></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <p><span id = "interest-text">Interest:</span> <span id="lighter"><?php echo "₱ " . $formatted_interest; ?></span></p>
                            </div>
                        </div>
                        
                        <div class = "d-flex mt-3 p-1" id = "loan-details">
                            <div class = "col-5 fs-5" id = "due-amount">
                                <p class = "fw-lighter" id = "loan-type">
                                    <span class = "fw-light" style = "font-family: 'Arial';">Loan Type: </span><?php echo isset($row3['loan']) ? $row3['loan'] : "-"; ?>
                                </p>
                            </div>
                            
                            <div class = "col-7 fs-5" id = "due-date">
                                
                                <p class = "text-end" id = "data-as-of">Data as of: <span><b>&nbsp;<?php echo isset($row3['data_as_of']) ? $row3['data_as_of'] : "-"; ?></b></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light mb-3 table-responsive" style="border-top: 4px solid #338763;" id = "loan-requests-div">
                        <div class="card-header">
                            <h3>Loan Requests</h3>
                        </div>
                        <div class="card-body" style="height: 300px; max-height: 300px; overflow-y: auto; padding-bottom: 1%;" id="loan-history-table-body">
                            <table class="table" id="loan-history-table">
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM financial_db WHERE account_id = '$account_id' AND application_status != 'Received'";
                                        $result = $conn->query($sql);

                                        if (!$result) {
                                            die("Invalid query");
                                        }
                                        if ($result->num_rows == 0) {
                                            echo "<tr style = 'height: 5px;'>";
                                            echo "<td colspan = 5 style = 'text-align:center;'><b><span style = 'font-size: 18px;'><i class='bi bi-info-circle-fill' style = 'font-size: 18px;'></i>&nbsp;No records found.</span></b></td>";
                                            echo"</tr>";
                                        }
                                        else
                                        {
                                            while($row = $result->fetch_assoc())
                                            {
                                                echo "<tr>";
                                                echo "<td id='td-icon'>";
                                                    echo "<i class='bx bxs-wallet' id='wallet'></i>";
                                                echo "</td>";
                                                echo "<td><p class='fw-bolder' id='loan-name'>" . $row['loan_type'] . "</p>";
                                                echo "<p class='fw-lighter' id='wallet-due-date' style='font-size: 8pt; color: #8a8a8a;'>" . $row['date_applied'] . "</p></td>";
                                                $statusColor = '';
                                                $strikethrough = '';
                                                if ($row['application_status'] == 'Pending' || $row['application_status'] == 'For CEO Evaluation' || $row['application_status'] == 'For Credit Committee Evaluation' || $row['application_status'] == 'For BOD Evaluation')
                                                {
                                                    $statusColor = 'color: #F45C2F;';
                                                    $strikethrough = 'text-decoration: none; color: black;';
                                                } 
                                                else if ($row['application_status'] == 'For Releasing') {
                                                    $statusColor = 'color: green;';
                                                    $strikethrough = 'text-decoration: none; color: black;';
                                                }
                                                else
                                                {
                                                    $statusColor = 'color: red;';
                                                    $strikethrough = 'text-decoration: line-through; color: red;';
                                                }
                                                echo "<td><p id='p-loan-amount' style = '$strikethrough'><span id='peso-sign-table'>₱</span> " . ((is_numeric($row['loan_Amount'])) ? number_format(floatval($row['loan_Amount']), 2) : "") . "</p></td>";
                                                echo "<td><p id='p-loan-status' style = '$statusColor'>" . $row['application_status'] . "</p></td>";
                                                echo "</tr>";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                                    
                </div>
            </div>


            <div class = "col-md-12 mt-3 margin-bottom: 1%;">
                <div class="card table-responsive" style = "border-top: 4px solid #338763;" id = "recent-transac-div">
                    <div class="card-header"><h3>Recent Transactions</h3></div>
                    <div class="card-body" style="height: 350px; max-height: 350px; overflow-y: auto;" id = "recent-transac-dashb">
                        <table class = "table" id = "loan-history-table">
                                
                            <tbody style = "margin-top: 5px;">
                                <?php
                                    $sql = "SELECT * FROM financial_db WHERE account_id = '$account_id' AND (application_status = 'Received' OR application_status = 'Declined')";
                                    $result = $conn->query($sql);

                                    $sql2 = "SELECT * FROM loan_balance WHERE account_id = '$account_id'";
                                    $result2 = $conn->query($sql2);
                                    $row2 = $result2->fetch_assoc();
                                    if (!$result) {
                                        die("Invalid query");
                                    }
                                    if ($result->num_rows == 0) {
                                        echo "<tr style = 'height: 130px;'>";
                                        echo "<td colspan = 5 style = 'text-align:center;'><b><span style = 'font-size: 18px;'><i class='bi bi-info-circle-fill' style = 'font-size: 18px;'></i>&nbsp;No records found.</span></b></td>";
                                        echo"</tr>";
                                    }
                                    else
                                    {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td id='td-icon'>";
                                                echo "<i class='bx bxs-wallet' id='wallet'></i>";
                                            echo "</td>";
                                            echo "<td><p class='fw-bolder' id='loan-name'>" . $row['loan_type'] . "</p>";
                                            echo "<p class='fw-lighter' id='wallet-due-date' style='font-size: 8pt; color: #8a8a8a;'>" . 
                                                 (isset($row2['granted']) && $row2['granted'] !== '' ? $row2['granted'] : '-') . 
                                                 "</p></td>";
                                            echo "<td><p id='td-loan-type'>" . $row['manner_of_payment'] . "</p>";
                                            if ($row['application_status'] == 'Received') {
                                                $statusColor = 'color: green;';
                                                $strikethrough2 = 'text-decoration: none; color: black;';
                                            } else {
                                                $statusColor = 'color: red;';
                                                $strikethrough2 = 'color: red; text-decoration: line-through;';
                                            }
                                            echo "<td><p id='p-loan-amount' style='$strikethrough2'><span id='peso-sign-table'>₱</span> " . 
                                                 ((is_numeric($row['loan_Amount'])) ? number_format(floatval($row['loan_Amount']), 2) : "") . 
                                                 "</p></td>";
                                            echo "<td><p id='p-loan-status' style='$statusColor'>" . $row['application_status'] . "</p></td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            </tbody>
                            
                        </table>
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
                document.getElementById('loan-due-payment').style.marginTop = '20px';
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