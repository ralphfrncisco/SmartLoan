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
                        'Unique_Ref' => $data[0],
                        'Code' => $data[1],
                        'Member_Name' => $data[2],
                        'Loan' => $data[3],
                        'Granted' => $data[4],
                        'Balance' => $data[5],
                        'Interest' => $data[6],
                        'Total' => $data[7],
                        'Data_as_of' => $data[8]
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
        $uniqueRefs = $_POST['Unique_Ref'];
        $Codes = $_POST['Code'];
        $MemberNames = $_POST['Member_Name'];
        $Loans = $_POST['Loan'];
        $Granteds = $_POST['Granted'];
        $Balances = $_POST['Balance'];
        $Interests = $_POST['Interest'];
        $Totals = $_POST['Total'];
        $Data_as_ofs = $_POST['Data_as_of'];
        
        $errors = [];
        
        foreach ($uniqueRefs as $index => $uniqueRef) {
            $Code = $Codes[$index];
            $MemberName = $MemberNames[$index];
            $Loan = $Loans[$index];
            $Granted = $Granteds[$index];
            $Balance = $Balances[$index];
            $Interest = $Interests[$index];
            $Total = $Totals[$index];
            $Data_as_of = $Data_as_ofs[$index];
    
            // Query to insert or update the loan balance data
            $query = "
                INSERT INTO loan_balance (unique_ref, account_id, member_name, loan, granted, balance, interest, total, data_as_of)
                VALUES ('$uniqueRef', '$Code', '$MemberName', '$Loan', '$Granted', '$Balance', '$Interest', '$Total', '$Data_as_of')
                ON DUPLICATE KEY UPDATE
                    account_id = '$Code',
                    member_name = '$MemberName',
                    loan = '$Loan',
                    granted = '$Granted',
                    balance = '$Balance',
                    interest = '$Interest',
                    total = '$Total',
                    data_as_of = '$Data_as_of'";
    
            // Execute each query individually
            if (!mysqli_query($connect, $query)) {
                $errors[] = "Error for Unique Ref $uniqueRef: " . mysqli_error($connect);
            }
        }
        
        if (empty($errors)) {
            echo "<script>alert('Data is imported successfully.');</script>";
        } else {
            echo "<script>alert('Errors occurred: " . implode(", ", $errors) . "');</script>";
        }
    }       
    
    // Display data from the loan_balance table
    $query = "SELECT * FROM loan_balance";
    $result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFSCCO | Loan Personnel</title>
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
                <a class="nav-link" href="loan-personnel-dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="loan-personnel-loan-requests.php">
                    <i class='bx bxs-archive-in'></i>
                    <span>Loan Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="loan-personnel-laf-approved.php">
                    <i class='bx bxs-check-square'></i>
                    <span>Evaluated Loans</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="loan-personnel-import-records.php">
                    <i class="bi bi-database-fill-up"></i>
                    <span style = "margin-top: 5px;">Import Records</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="loan-personnel-memberList.php">
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
            <span class="navbar-brand mb-0 h1 text-white">Import Records</span>

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
                            <a class="nav-link" href="loan-personnel-dashboard.php">
                                
                                <span id = "nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left: 2px;">
                            <a class="nav-link" href="loan-personnel-loan-requests.php">
                                
                                <span id = "nav-text" >Loan Requests</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left: 2px;">
                            <a class="nav-link" href="loan-personnel-laf-approved.php">
                                
                                <span id = "nav-text" >Evaluated Loans</span>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-left: 2px;">
                            <a class="nav-link" href="loan-personnel-import-records.php">
                                
                                <span id = "nav-text" >Import Records</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="loan-personnel-memberList.php">
                                
                                <span id = "nav-text" style="margin-left: 2px;">Member's List</span>
                            </a>
                        </li>

                        <li class="nav-item" style="margin-top: 15px;">
                            <a class="nav-link" href="logout.php">
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
                    <input type="submit" name="save_changes" class="btn btn-success mb-4" value="Save Changes">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Unique Ref</th>
                                <th style = "width: 10%;">Code</th>
                                <th>Member Name</th>
                                <th>Loan</th>
                                <th>Granted</th>
                                <th>Balance</th>
                                <th>Interest</th>
                                <th>Total Amount Due</th>
                                <th>Date as of</th>
                            </tr>
                            <?php foreach ($preview_data as $row) : ?>
                                    <tr>
                                        <td><input type="text" name="Unique_Ref[]" value="<?php echo $row['Unique_Ref']; ?>" readonly></td>
                                        <td><input type="text" name="Code[]" value="<?php echo $row['Code']; ?>" readonly></td>
                                        <td><input type="text" name="Member_Name[]" value="<?php echo $row['Member_Name']; ?>" readonly></td>
                                        <td><input type="text" name="Loan[]" value="<?php echo $row['Loan']; ?>" readonly></td>
                                        <td><input type="text" name="Granted[]" value="<?php echo $row['Granted']; ?>" readonly></td>
                                        <td><input type="text" name="Balance[]" value="<?php echo $row['Balance']; ?>" readonly></td>
                                        <td><input type="text" name="Interest[]" value="<?php echo $row['Interest']; ?>" readonly></td>
                                        <td><input type="text" name="Total[]" value="<?php echo $row['Total']; ?>" readonly></td>
                                        <td><input type="text" name="Data_as_of[]" value="<?php echo $row['Data_as_of']; ?>" readonly></td>
                                    </tr>
                                <?php endforeach; ?>

                        </table>
                    </div>
                    
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