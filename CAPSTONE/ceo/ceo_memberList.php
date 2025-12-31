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
    <title>HFSCCO | CEO Dashboard</title>
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
                <a class="nav-link" href="ceo_dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ceo_loanRequest.php">
                    <i class='bx bxs-archive-in'></i>
                    <span>Loan Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ceo_memberList.php">
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
            <span class="navbar-brand mb-0 h1 text-white">Member's List</span>

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
                            <a class="nav-link" href="ceo_dashboard.php">
                                
                                <span id = "nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left: 2px;">
                            <a class="nav-link" href="ceo_loanRequest.php">
                                
                                <span id = "nav-text" >Loan Requests</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ceo_memberList.php">
                                
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
            <div class = "table-responsive">
                <table class="table" id="members-loan-history-table">
                    <thead id="history-header" style="background-color: #e0e0e0;">
                        <tr class="align-bottom">
                            <th id="td-invoice" style="width: 10%;">Account ID</th>
                            <th id="td-loanType" style="text-align: left; width: 13%;">Last Name</th>
                            <th id="td-loanType" style="text-align: left; width: 13%; ">First Name</th>
                            <th id="td-date" style="width: 11%; text-align: left;">Middle Name</th>
                            <th id="td-date" style="width: 11%; text-align: center;">Suffix</th>
                            <th id="td-Amount" style="width: 13%; text-align: center;">Account Status</th>
                            <th id="td-Status" style="width: 15%;">Application Status</th>
                            <th id="td-Status" style="width: 13%;">Time of Account Deployment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr id = "transaction-tr">
                            <td>1</td>
                            <td style = "text-align: left; padding-left: 0.7%;">Francisco</td>
                            <td style = "text-align: left; padding-left: 0.7%;">Ralph Angelo</td>
                            <td style = "text-align: left; padding-left: 0.7%;">Marcoso</td>
                            <td style = "text-align: center;">Jr.</td>
                            <td>Active</td>
                            <td>Fully Approved</td>
                            <td>April 23, 2024, 1:22 am</td>
                        </tr> -->
                        <?php

                        $sql = "SELECT * FROM members_db WHERE acc_status = 'Active'";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc())
                            {
                                echo "<tr id = 'transaction-tr'>";
                                echo "<td>" . $row['account_id'] . "</td>";
                                echo "<td style = 'text-align: left; padding-left: 0.7%;'>" . $row['LastName'] . "</td>";
                                echo "<td style = 'text-align: left; padding-left: 0.7%;'>" . $row['FirstName'] . "</td>";
                                echo "<td style = 'text-align: left; padding-left: 0.7%;'>" . $row['MiddleName'] . "</td>";
                                echo "<td style = 'text-align: center;'>" . $row['Suffix']. "</td>";
                                echo "<td>" . $row['acc_status']. "</td>";
                                echo "<td>". $row["approval_status"] . "</td>";
                                echo "<td>" . $row['approval_time']. "</td>";
                                echo "</tr>";
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
            height: 100px;
            padding-bottom: 75px!important;
            font-weight: 600;
            font-size: 0.900rem;
        }
        
        #history-header th
        {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight: bold;
            padding-bottom: 1%;
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