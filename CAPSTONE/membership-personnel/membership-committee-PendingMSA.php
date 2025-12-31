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
            <span class="navbar-brand mb-0 h1 text-white">Pending MSA</span>

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
                            <a class="nav-link" href="membership-upload-records.php">
                                
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
            <div class = "table-responsive">
                <table class="table" id="members-loan-history-table">
                    <thead id="history-header" style="background-color: #e0e0e0;">
                        <tr class="align-bottom">
                            <th id="td-loanType" style="text-align: center; width: 7%; padding-left: 1%;">Application Number</th>
                            <th id="td-loanType" style="text-align: center; width: 13%; ">Last Name</th>
                            <th id="td-date" style="width: 11%; text-align: center;">First Name</th>
                            <th id="td-invoice" style="width: 14%; text-align: center;">Middle Name</th>
                            <th id="td-Amount" style="width: 18%; text-align: center;">Date of Application</th>
                            <th id="td-Status" style="width: 10%;">Status</th>
                            <th style="width: 18%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM members_db WHERE acc_status = 'Pending' and DateTime != 'Registered'";
                        $result = $conn->query($sql);

                        if ($result->num_rows == 0) {
                            echo "<tr style = 'height: 300px;'>";
                            echo "<td colspan = 8 style = 'text-align:center; background-color: rgba(0, 0, 0, 0.3);'>
                                <b><p style = 'font-size: 21px; margin-top: 8%; color: black;'><i class='bi bi-info-circle-fill' style = 'font-size: 18px;'></i>&nbsp;No pending loan request at the moment</p></b>
                                </td>";
                            echo"</tr>";
                        }
                        else
                        {
                            while($row = $result->fetch_assoc())
                            {
                                echo "<tr id = 'transaction-tr'>";
                                echo "<td style = 'text-align: center;'>" . $row['application_num'] . "</td>";
                                echo "<td>" . $row['LastName'] . "</td>";
                                echo "<td>" . $row['FirstName'] . "</td>";
                                echo "<td style = 'text-align: center;'>" . $row['MiddleName'] . "</td>";
                                echo "<td style = 'text-align: center;'>" . $row['DateTime']. "</td>";
                                echo "<td style = 'text-align: center; color: #F45C2F;'>" . $row['acc_status']. "</td>";
                                echo "<td style = 'text-align: center;'> <a href='membership-approval-form.php?application_num=$row[application_num]' class = 'edit-btn'><i class='bx bxs-edit'></i></a></td>";
                                echo "</tr>";
                            }
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
        #transaction-tr td
        {
            padding-top: 20px;
            padding-bottom: 20px!important;
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

        .edit-btn
        {
            height: 20px;
            width: 70px;
            margin-left: 5px;
            display: inline;
            border-radius: 5px;
            background-color: #1D6ED8;
            color: white;
            text-decoration: none;
            border: 1px solid #1D6ED8;
            padding: 8px 7px 5px 7px;
            box-sizing: border-box;
        }
        .edit-btn .bxs-edit
        {
            font-size: 20px;
        }
        .edit-btn:hover
        {
            border: 1px solid #307ADB;
            background-color: #307ADB;
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