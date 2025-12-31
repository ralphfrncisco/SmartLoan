<?php
    session_start();
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "hfscco";
    

    $conn = mysqli_connect($servername,$username,$password, $dbname);
    
 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFSCCO | Credit Committee</title>
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

<body>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-heading text-center py-4">
            <img src="../Resources/logo.png" alt="Logo" style="width: 50px; height: 50px;">
            <span id = "sidenav-heading-text">HFSCCO</span>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="credit-committee-dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="credit-committee-loan-requests.php">
                    <i class='bx bxs-archive-in'></i>
                    <span>Loan Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="credit-committee-memberList.php">
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
            <span class="navbar-brand mb-0 h1 text-white">Dashboard</span>

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
                            <a class="nav-link" href="credit-committee-dashboard.php">
                                
                                <span id = "nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left: 2px;">
                            <a class="nav-link" href="credit-committee-loan-requests.php">
                                
                                <span id = "nav-text" >Loan Requests</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="credit-committee-memberList.php">
                                
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
            <div class="row g-2 mt-2" id = "total-data">
                <div class="col-6 col-md-4">
                    <div id="registered-total">
                        <div>
                            <?php
                                $sql = "SELECT COUNT(*) AS regd_loan_apps FROM financial_db WHERE application_status = 'For Credit Committee Evaluation'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $regdLoanApps = $row["regd_loan_apps"];
                                } else {
                                    echo "0";
                                }
                            ?>
                            <span id="total-data-text" style="color: #30A552;"><?php echo $regdLoanApps; ?></span>
                            <br><small id="data-section-subheader">Pending Loan Applications</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="" id="pending-member-total">
                        <div class="">
                            <?php
                                $sql = "SELECT COUNT(*) AS pending_mem_apps FROM members_db WHERE approval_status = 'Waiting for Approval'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $pendingMemAppCount = $row["pending_mem_apps"];
                                } else {
                                    echo "0";
                                }
                            ?>
                            <span id="total-data-text" style="color: #F45C2F;"><?php echo $pendingMemAppCount; ?></span>
                            <br><span class = "lh-sm" id="data-section-subheader">Pending Membership Applications</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="" id="active-member-total">
                        <div class="">
                            <?php
                                $sql = "SELECT COUNT(*) AS active_members FROM members_db WHERE acc_status = 'Active'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $activeMembersCount = $row["active_members"];
                                } else {
                                    echo "0";
                                }
                            ?>
                            <span id="total-data-text" style="color: #085A3E;"><?php echo $activeMembersCount; ?></span>
                            <br><span id="data-section-subheader">Active Member Accounts</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class = "row g-2 mt-3">
                <div class = "col-md-6" id = "data-analytics-section">
                    <div class = "" id = "analytics-loan">
                        <div class = "-body">
                            <script>
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                    // Make AJAX call to get data from PHP script
                                    $.ajax({
                                        url: '../functions-php/analytics-loan-data.php',
                                        type: 'GET',
                                        dataType: 'json', // Specify JSON dataType
                                        success: function(response) {
                                            // Create DataTable object
                                            var data = new google.visualization.DataTable();
                                            data.addColumn('string', 'loan_Type');
                                            data.addColumn('number', 'Mhl');

                                            // Add rows to the DataTable
                                            $.each(response, function(index, row) {
                                                data.addRow([row.loan_Type, parseInt(row.Mhl)]);
                                            });

                                            // Set chart options
                                            var options = {
                                                title: 'Inquired Loans by Types',
                                                colors: [
                                                    '#18a54e','#39ae4a','#68c03f','#7fc838','#add82b','#c4df25','#f6eb1e',
                                                    '#fad800','#feb100','#fe9d00','#fa7409','#f65e19','#e9252b','#dc470a',
                                                    '#cb5e00','#b86f00','#a47e00','#8e8900','#779200','#5f9a0a','#43a031'],
                                                backgroundColor: 'transparent' 
                                            };

                                            // Instantiate and draw the chart
                                            var chart = new google.visualization.PieChart(document.getElementById('analytics-loan'));
                                            chart.draw(data, options);
                                        },
                                        error: function(xhr, status, error) {
                                            console.error(error);
                                        }
                                    });
                                }
                            </script>
                        </div>
                    </div>
                </div>

                <div class = "col-md-6" id = "data-analytics-section">
                    <div class = "" id = "analytics-membership">
                        <div class = "-body">
                            <script>
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                    // Make AJAX call to get data from PHP script
                                    $.ajax({
                                        url: '../functions-php/analytics-membership-data.php',
                                        type: 'GET',
                                        dataType: 'json',
                                        success: function(response) {
                                            // Create DataTable object
                                            var data = new google.visualization.DataTable();
                                            data.addColumn('string', 'Month');
                                            data.addColumn('number', 'Num');

                                            // Add rows to the DataTable
                                            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                            for (var i = 0; i < months.length; i++) {
                                                var monthName = months[i];
                                                var found = false;
                                                for (var j = 0; j < response.length; j++) {
                                                    if (response[j].Month === monthName) {
                                                        data.addRow([monthName, parseInt(response[j].Num)]);
                                                        found = true;
                                                        break;
                                                    }
                                                }
                                                if (!found) {
                                                    data.addRow([monthName, 0]);
                                                }
                                            }

                                            // Set chart options with dynamic title
                                            var currentYear = new Date().getFullYear();
                                            var options = {
                                                title: 'Membership Applications per Month - Year ' + currentYear,
                                                colors: ['#18A64F'],
                                                legend: 'none',
                                                backgroundColor: 'transparent' 
                                            };

                                            // Instantiate and draw the chart
                                            var chart = new google.visualization.BarChart(document.getElementById('analytics-membership'));
                                            chart.draw(data, options);
                                        },
                                        error: function(xhr, status, error) {
                                            console.error(error);
                                        }
                                    });
                                }
                            </script>
                        </div>
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
                document.getElementById("total-data").classList.remove('g-2');
                document.getElementById("total-data").classList.add('g-4');
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