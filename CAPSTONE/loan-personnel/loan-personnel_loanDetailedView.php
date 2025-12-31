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

    $applicationID = "";
    $loanAmount = "";
    $dateApplied = "";
    $loanTermApplied = "";
    $loanInterest = "";
    $MannerOfPayment = "";
    $loanPurpose = "";
    $accountID = "";
    $LastName = "";
    $FirstName = "";
    $MiddleName = "";
    $Suffix = "";
    $contact_num = "";
    $email_add = "";
    $typeOfApplication = "";

    
    $credit_loan_type = "";
    $credit_loan_amount = "";
    $credit_loan_terms = "";
    $credit_remarks = "";
    $credit_approval_status = "";



    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
      if (!isset($_GET["application_id"])){
          echo 'i';
          exit;
      }

      $applicationID = $_GET["application_id"];

      $sql = "SELECT * FROM financial_db WHERE application_id = $applicationID";

      $result= $conn->query($sql);
      $row = $result->fetch_assoc();


      $sql1 = "SELECT * FROM loan_person_approvals WHERE application_id = $applicationID";

      $result1= $conn->query($sql1);
      $row1 = $result1->fetch_assoc();
      

      $sql2 = "SELECT * FROM ceo_approvals WHERE application_id = $applicationID";

      $result2= $conn->query($sql2);
      $row2 = $result2->fetch_assoc();

      $sql3 = "SELECT * FROM creditcomm_approvals WHERE application_id = $applicationID";

      $result3 = $conn->query($sql3);
      $row3 = $result3->fetch_assoc();
      
      if(!$row){
          header("");
          exit;
      }

        $applicationID = $row['application_id'];
        $loanAmount = $row['loan_Amount'];
        $dateApplied = $row['date_applied'];
        $loanTermApplied = $row['loan_term_applied'];
        $loanInterest = $row['loan_interest'];
        $MannerOfPayment = $row['manner_of_payment'];
        $loanPurpose = $row['loan_purpose'];
        $accountID = $row['account_id'];
        $LastName = $row['LastName'];
        $FirstName = $row['FirstName'];
        $MiddleName = $row['MiddleName'];
        $Suffix = $row['Suffix'];
        $contact_num = $row['contact_no'];
        $email_add = $row['email'];
        $typeOfApplication = $row['type_of_application'];
        $approval_status = $row['application_status'];
    }
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFSCCO | Loan Application Approval Form - Detailed View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css-files/admin-design.css">
    <link rel="stylesheet" href="../css-files/font-import.css">
    <link rel="icon" type="image/x-icon" href="../Resources/hfscco-logo-title.ico">
</head>
<style>
    .container
    {
        border-top: 7px solid #368965;
        border-left: 1px solid #B6BCC8;
        border-right: 1px solid #B6BCC8;
        border-bottom: 1px solid #B6BCC8;
        border-radius: 4px;
        margin-top: 0.47%;
    }
    .header {
        display: flex;
        align-items: center;
        gap: 1px;
    }
    .info-section, .approval-section
    {
        border-bottom: 1px dotted #616161;
        padding-bottom: 5%;
    }
    .form-check-label
    {
        font-size: 1.038rem;
    }
    input[type = submit]
    {
        padding: 7px 17px;
        border-radius: 5px;
    }
    #submitBtn
    {
        color: white;
        border: 1px solid #18A64F;
        background-color: #085A3E;
    }
    #cancelBtn
    {
        color: white;
        border: 1px solid #EC1E25;
        background-color: #EC1E25;
    }

    @media (max-width: 768px) {
        .first-section {
            flex-direction: column;
        }

        .col-md-8, .col-md-4 {
            width: 100%;
            margin-bottom: 15px;
        }
    }

    @media (max-width: 576px) {
        .header img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
        
        .header h1 {
            font-size: 0.878rem!important;
            display: inline-block; 
            vertical-align: middle;
        }
        #sidebarToggle2
        {
            font-size: 12px;
        }
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
            <span class="navbar-brand mb-0 h1 text-white">Loan Requests</span>

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
                            <a class="nav-link" href="../functions-php/logout.php">
                                <i class='bx bx-log-out'></i>
                                <span id="nav-text" style="margin-left: 4px;">Log out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>                       
        </div>

        <div class="container-xxl mb-5">
            <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class = "p-3" id = "approval-form">
                    <div class = "header mt-2">
                        <img src="../Resources/logo.png" alt="Logo" style="width: 50px; height: 50px;">
                        <h1 class="modal-title fs-3" id="exampleModalLabel">&nbsp;&nbsp;Loan Application Approval Form - Detailed View</h1>
                    </div>
                    <div class = "info-section">
                        <div class = "row">
                            <div class = "col-md-8">
                                <div class = "row col-12 mt-5">
                                    <h5>PERSONAL INFORMATION</h5>
                                </div>
                                <div class="row mt-4 mb-3" id="account-details">
                                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control border border-dark-subtle" name = "FirstName" value="<?php echo $FirstName?>" readonly>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                                        <label class="form-label">Middle Name:</label>
                                        <input type="text" class="form-control border border-dark-subtle" name = "MiddleName" value="<?php echo $MiddleName?>" readonly>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                                        <label class="form-label">Last Name:</label>
                                        <input type="text" class="form-control border border-dark-subtle" name = "LastName" value="<?php echo $LastName?>" readonly>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                                        <label class="form-label">Suffix:</label>
                                        <input type="text" class="form-control border border-dark-subtle" name = "SuffixName" value="<?php echo $Suffix?>" readonly>
                                    </div>
                                </div>
                        
                                <div class = "row mb-3">
                                    <!-- First column -->
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                        <label class="form-label">Account ID:</label>
                                        <input type="text" class="form-control border border-dark-subtle" name = "Account_ID" value = "<?php echo $accountID?>" readonly>
                                    </div>
                                    <!-- Second column -->
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                        <label class="form-label">Email Address:</label>
                                        <input type="text" class="form-control border border-dark-subtle" name = "email_add" value = "<?php echo $email_add?>" readonly>
                                    </div>
                                    <!-- Third column -->
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                        <label class="form-label">Contact Number:</label>
                                        <input type="number" class="form-control border border-dark-subtle" name = "contact_no" value = "<?php echo $contact_num?>" readonly>
                                    </div>
                                </div>
                        
                                <div class="row mt-5">
                                    <div class = "row col-12 mb-4">
                                        <h5>APPLICATION DETAILS</h5>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <!-- First column -->
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                <label class="form-label">Loan Amount Applied:</label>
                                                <input type="text" class="form-control border border-dark-subtle" value = "<?php echo $loanAmount?>" readonly>
                                            </div>
                                            <!-- Second column -->
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                <label class="form-label">Loan Term Applied:</label>
                                                <input type="text" class="form-control border border-dark-subtle" value = "<?php echo $loanTermApplied?>" readonly>
                                            </div>
                                            <!-- Third column -->
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                <label class="form-label">Date Applied:</label>
                                                <input type="text" class="form-control border border-dark-subtle" value = "<?php echo $dateApplied?>" readonly>
                                            </div>
                                        </div>
                        
                                        <div class="row mt-2 mb-2">
                                            <!-- Fourth column -->
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                <label class="form-label">Promissory Note Number:</label>
                                                <input type="text" class="form-control border border-dark" name = "Application_ID" value = "<?php echo $applicationID?>" readonly>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                <label class="form-label">Manner of Payment:</label>
                                                <input type="text" class="form-control border border-dark-subtle" value = "<?php echo $MannerOfPayment?>" readonly>
                                            </div>
                                            <!-- Fifth column -->
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                <label class="form-label">Type of Application:</label>
                                                <input type="text" class="form-control border border-dark-subtle" value = "<?php echo $typeOfApplication?>" readonly>
                                            </div>
                                        </div>
                        
                                        <!-- Responsive textarea -->
                                        <div class="row mt-3 mb-2">
                                            <div class="col-12">
                                                <label class="form-label">Loan Purpose:</label>
                                                <textarea class="form-control border border-dark-subtle" placeholder="" required name = "loan-purpose-txtarea" id="floatingTextarea" rows="3" style="resize: none;" readonly>
                                                    <?php echo $loanPurpose?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>

                            <div class = "col-md-4 mt-3">
                                <h4>OUTSTANDING LOAN/PAYABLES</h4>
                                <div class = "align-items-center mt-4">
                                    <div class = "row justify-content-center">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-7 mb-2">
                                            <label class="form-label">Loan Type:</label>
                                            <input type="text" class="form-control border border-dark-subtle" value = "<?php echo isset ($row1['outstanding_loanType']) && $row1['outstanding_loanType'] != 0 ? $row1['outstanding_loanType'] : 'Not Yet Evaluated'; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class = "row justify-content-center">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-7 mb-2">
                                            <label class="form-label">Balance:</label>
                                            <input type="text" class="form-control border border-dark-subtle" value = "<?php echo isset ($row1['outstanding_balance']) && $row1['outstanding_balance']!= 0 ? ($row1['outstanding_balance']) : 'Not Yet Evaluated'; ;?>" readonly>
                                        </div>
                                    </div>
                                    <div class = "row justify-content-center">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-7 mb-2">
                                            <label class="form-label">Interest on Loans:</label>
                                            <input type="text" class="form-control border border-dark-subtle" value = "<?php echo isset ($row1['outstanding_interestOnLoans']) && $row1['outstanding_interestOnLoans']!= 0 ? ($row1['outstanding_interestOnLoans']) : 'Not Yet Evaluated'; ;?>" readonly>
                                        </div>
                                    </div>
                                    <div class = "row justify-content-center">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-7 mb-2">
                                            <label class="form-label">Fines:</label>
                                            <input type="text" class="form-control border border-dark-subtle" value = "<?php echo isset ($row1['outstanding_Fines']) && $row1['outstanding_Fines']!= 0 ? ($row1['outstanding_Fines']) : 'Not Yet Evaluated'; ;?>" readonly>
                                        </div>
                                    </div>
                                    <div class = "row justify-content-center">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-7 mb-2">
                                            <label class="form-label">Past Due Interest:</label>
                                            <input type="text" class="form-control border border-dark-subtle" value = "<?php echo isset ($row1['outstanding_PastDueInterest']) && $row1['outstanding_PastDueInterest']!= 0 ? ($row1['outstanding_PastDueInterest']) : 'Not Yet Evaluated'; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div> 
                    </div>

                    <!--Loan Personnel comittee-->
                    <div class = "approval-section row mt-5">
                        <div class = "row col-12 mt-3">
                            <h4>Summary of Approval</h4><small>(by Loan Personnel)</small>
                        </div>
                        <div class="row mt-5 mb-3" id="account-details">
                            <div class = "col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="col-12 col-md-6 col-lg-9 mb-3">
                                    <label class="form-label">Loan Type:</label>
                                    <input type="text" class="form-control border border-dark-subtle" value="<?php echo isset($row1['loanPersonnel_loanType']) && $row1['loanPersonnel_loanType'] != 0 ? $row1['loanPersonnel_loanType'] : 'Not Yet Evaluated'; ?>" readonly>
                                </div>
                                <div class="col-12 col-md-6 col-lg-9 mb-2">
                                    <label class="form-label">Loan Amount:</label>
                                    <input type="text" class="form-control border border-dark-subtle" value="<?php echo isset($row1['loanPersonnel_loanAmount']) && $row1['loanPersonnel_loanAmount'] != 0 ? $row1['loanPersonnel_loanAmount'] : 'Not Yet Evaluated'; ?>" readonly>
                                </div>
                                <div class="col-12 col-md-6 col-lg-9 mb-2">
                                    <label class="form-label">Loan Term:</label>
                                    <input type="text" class="form-control border border-dark-subtle" value="<?php echo isset($row1['loanPersonnel_loanTerm']) && $row1['loanPersonnel_loanTerm'] != 0 ? $row1['loanPersonnel_loanTerm'] : 'Not Yet Evaluated'; ?>" readonly>
                                </div>
                            </div>

                            <div class = "col-12 col-sm-6 col-md-6 col-lg-4">
                                <label class="form-label">Remarks:</label>
                                <textarea class="form-control border border-dark-subtle" placeholder="" name = "loan-purpose-txtarea" id="floatingTextarea" rows="6" style="resize: none;" readonly><?php echo isset($row1['loanPersonnel_remarks']) && $row1['loanPersonnel_remarks'] != 0 ? $row1['loanPersonnel_remarks'] : 'Not Yet Evaluated'; ?></textarea>
                            </div>

                            <div class = "col-12 col-sm-6 col-md-6 col-lg-4" style = "padding-left: 5%;">
                                <div class="form-check mt-4">
                                    <input class="form-check-input border border-dark-subtle" type="radio" name="loan-personnel-Approval-Selection" value="Approved" 
                                    <?php echo (isset($row1['loanPersonnel_approvalStatus']) && $row1['loanPersonnel_approvalStatus'] === "Approved") ? "checked" : ""; ?> disabled>
                                    <label class="form-check-label" for="Approved">
                                    Approved
                                    </label>
                                </div>
                                <div class="form-check mt-4">
                                    <input class="form-check-input border border-dark-subtle" type="radio" name="loan-personnel-Approval-Selection" value ="Approved with Modification" 
                                    <?php echo (isset($row1['loanPersonnel_approvalStatus']) && $row1['loanPersonnel_approvalStatus'] === "Approved with Modification") ? "checked" : ""; ?> disabled>
                                    <label class="form-check-label" for="Approved">
                                    Approved with Modification
                                    </label>
                                </div>
                                <div class="form-check mt-4">
                                    <input class="form-check-input border border-dark-subtle" type="radio" name="loan-personnel-Approval-Selection" value = "Disapproved" 
                                    <?php echo (isset($row1['loanPersonnel_approvalStatus']) && $row1['loanPersonnel_approvalStatus'] === "Disapproved") ? "checked" : ""; ?> disabled>
                                    <label class="form-check-label" for="Approved">
                                    Disapproved
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!--CEO comittee-->
                    <?php if ($row1['loanPersonnel_approvalStatus'] !== "Disapproved"): ?>
                    <div class = "approval-section row mt-5">
                        <div class = "row col-12 mt-3">
                            <h4>Summary of Approval</h4><small>(by CEO)</small>
                        </div>
                        <div class="row mt-5 mb-3" id="account-details">
                            <div class = "col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="col-12 col-md-6 col-lg-9 mb-3">
                                    <label class="form-label">Loan Type:</label>
                                    <input type="text" class="form-control border border-dark-subtle" value="<?php echo isset($row2['CEO_loanType']) && $row2['CEO_loanType'] != 0 ? $row2['CEO_loanType'] : 'Not Yet Evaluated'; ?>" readonly>
                                </div>
                                <div class="col-12 col-md-6 col-lg-9 mb-2">
                                    <label class="form-label">Loan Amount:</label>
                                    <input type="text" class="form-control border border-dark-subtle" value="<?php echo isset($row2['CEO_loanAmount']) && $row2['CEO_loanAmount'] != 0 ? $row2['CEO_loanAmount'] : 'Not Yet Evaluated'; ?>"readonly>
                                </div>
                                <div class="col-12 col-md-6 col-lg-9 mb-2">
                                    <label class="form-label">Loan Term:</label>
                                    <input type="text" class="form-control border border-dark-subtle" value="<?php echo isset($row2['CEO_loanTerm']) && $row2['CEO_loanTerm'] != 0 ? $row2['CEO_loanTerm'] : 'Not Yet Evaluated'; ?>" readonly>
                                </div>
                            </div>

                            <div class = "col-12 col-sm-6 col-md-6 col-lg-4">
                                <label class="form-label">Remarks:</label>
                                <textarea class="form-control border border-dark-subtle" placeholder="" name = "loan-purpose-txtarea" id="floatingTextarea" rows="6" style="resize: none;" readonly><?php echo isset($row2['CEO_remarks']) && $row2['CEO_remarks'] != 0 ? $row2['CEO_remarks'] : 'Not Yet Evaluated'; ?></textarea>
                            </div>

                            <div class = "col-12 col-sm-6 col-md-6 col-lg-4" style = "padding-left: 5%;">
                                <div class="form-check mt-4">
                                    <input class="form-check-input border border-dark-subtle" type="radio" name="ceo-approval-selection" value="Approved" 
                                    <?php echo (isset($row2['CEO_approvalStatus']) && $row2['CEO_approvalStatus'] === "Approved") ? "checked" : ""; ?> disabled>
                                    <label class="form-check-label" for="Approved">
                                    Approved
                                    </label>
                                </div>
                                <div class="form-check mt-4">
                                    <input class="form-check-input border border-dark-subtle" type="radio" name="ceo-approval-selection" value ="Approved with Modification" 
                                    <?php echo (isset($row2['CEO_approvalStatus']) && $row2['CEO_approvalStatus'] === "Approved with Modification") ? "checked" : ""; ?> disabled>
                                    <label class="form-check-label" for="Approved">
                                    Approved with Modification
                                    </label>
                                </div>
                                <div class="form-check mt-4">
                                    <input class="form-check-input border border-dark-subtle" type="radio" name="ceo-approval-selection" value = "Disapproved" 
                                    <?php echo (isset($row2['CEO_approvalStatus']) && $row2['CEO_approvalStatus'] === "Disapproved") ? "checked" : ""; ?> disabled>
                                    <label class="form-check-label" for="Approved">
                                    Disapproved
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!--credit comittee-->
                    <?php if ($row1['loanPersonnel_approvalStatus'] !== "Disapproved" || $row2['CEO_approvalStatus'] !== "Disapproved"): ?>
                        <div class = "approval-section row mt-5">
                            <div class = "row col-12 mt-3">
                                <h4>Summary of Approval</h4><small>(by Credit Committee Officer)</small>
                            </div>
                            <div class="row mt-5 mb-3" id="account-details">
                                <div class = "col-12 col-sm-6 col-md-6 col-lg-4">
                                    <div class="col-12 col-md-6 col-lg-9 mb-3">
                                        <label class="form-label">Loan Type:</label>
                                        <input type="text" class="form-control border border-dark-subtle" value="<?php echo isset($row3['creditcomm_loanType']) && $row3['creditcomm_loanType'] != 0 ? $row3['creditcomm_loanType'] : 'Not Yet Evaluated'; ?>" readonly>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-9 mb-2">
                                        <label class="form-label">Loan Amount:</label>
                                        <input type="text" class="form-control border border-dark-subtle" value="<?php echo isset($row3['creditcomm_loanAmount']) && $row3['creditcomm_loanAmount'] != 0 ? $row3['creditcomm_loanAmount'] : 'Not Yet Evaluated'; ?>" readonly>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-9 mb-2">
                                        <label class="form-label">Loan Term:</label>
                                        <input type="text" class="form-control border border-dark-subtle" value="<?php echo isset($row3['creditcomm_loanTerm']) && $row3['creditcomm_loanTerm'] != 0 ? $row3['creditcomm_loanTerm'] : 'Not Yet Evaluated'; ?>" readonly>
                                    </div>
                                </div>

                                <div class = "col-12 col-sm-6 col-md-6 col-lg-4">
                                    <label class="form-label">Remarks:</label>
                                    <textarea class="form-control border border-dark-subtle" placeholder="" required name = "loan-purpose-txtarea" id="floatingTextarea" rows="6" style="resize: none;" readonly><?php echo isset($row3['creditcomm_remarks']) && $row3['creditcomm_remarks'] != 0 ? $row3['creditcomm_remarks'] : 'Not Yet Evaluated'; ?></textarea>
                                </div>

                                <div class = "col-12 col-sm-6 col-md-6 col-lg-4" style = "padding-left: 5%;">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input border border-dark-subtle" type="radio" name="credit-approval-selection" value="Approved"
                                            <?php echo (isset($row3['creditcomm_approvalStatus']) && $row3['creditcomm_approvalStatus'] === "Approved") ? "checked" : ""; ?> disabled>
                                        <label class="form-check-label" for="Approved">
                                        Approved
                                        </label>
                                    </div>
                                    <div class="form-check mt-4">
                                        <input class="form-check-input border border-dark-subtle" type="radio" name="credit-approval-selection" value ="Approved with Modification"
                                            <?php echo (isset($row3['creditcomm_approvalStatus']) && $row3['creditcomm_approvalStatus'] === "Approved with Modification") ? "checked" : ""; ?> disabled>
                                        <label class="form-check-label" for="Approved">
                                        Approved with Modification
                                        </label>
                                    </div>
                                    <div class="form-check mt-4">
                                        <input class="form-check-input border border-dark-subtle" type="radio" name="credit-approval-selection" value = "Disapproved"
                                            <?php echo (isset($row3['creditcomm_approvalStatus']) && $row3['creditcomm_approvalStatus'] === "Disapproved") ? "checked" : ""; ?> disabled>
                                        <label class="form-check-label" for="Approved">
                                        Disapproved
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($row1['loanPersonnel_approvalStatus'] !== "Disapproved" || $row2['CEO_approvalStatus'] !== "Disapproved" || $row3['creditcomm_approvalStatus'] !== "Disapproved"): ?>
                    <div class = "row mt-5">
                        <div class = "row col-12 mt-3">
                            <h4>Summary of Approvals</h4><small>(by Board of Directors)</small>
                        </div>
                        <div class = "table-responsive">
                            <table class = "table table-striped-columns mt-4">
                                <?php
                                     $servername = "localhost:3306";
                                     $username = "root";
                                     $password = "";
                                     $dbname = "hfscco";
                                 
                                 
                                     $conn = mysqli_connect($servername,$username,$password, $dbname);

                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }

                                    $query = "SELECT * FROM bod_approvals WHERE application_id = '$applicationID'";
                                    $result5 = mysqli_query($conn, $query);

                                    if ($result5 && mysqli_num_rows($result5) > 0) {
                                        echo '<div class="table-responsive mt-4">';
                                        echo '<table class="table table-striped-columns">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th>BOD#</th>';
                                        echo '<th>Loan Type</th>';
                                        echo '<th>Loan Amount</th>';
                                        echo '<th>Loan Term</th>';
                                        echo '<th>Comments</th>';
                                        echo '<th>Remarks</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';

                                        // Loop through each row in the result set
                                        while ($row5 = mysqli_fetch_assoc($result5)) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($row5['bod_acc_id']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row5['bod_loanType']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row5['bod_loanAmount']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row5['bod_loanTerm']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row5['bod_remarks']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row5['board_approvalStatus']) . '</td>';
                                            echo '</tr>';
                                        }

                                        echo '</tbody>';
                                        echo '</table>';
                                        echo '</div>';
                                    } else {
                                        echo '<p>No records found for BOD Approvals.</p>';
                                    }

                                    // Close the connection after finishing database operations
                                    mysqli_close($conn);
                                ?>
                            </table>
                        </div>
                        
                    </div>
                    <?php endif; ?>

                    <div class = "row mt-2 d-flex justify-content-center">
                        <input type="hidden" name="Account_ID" value="<?php echo $accountID; ?>">
                        <input type="hidden" name="Application_ID" value="<?php echo $applicationID; ?>">
                        <a href = "loan-personnel-laf-approved.php" class = "btn btn-secondary col-3 col-lg-1">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type = "submit" class = "btn btn-primary col-4 col-lg-1" name = "approved" value = "Approved">&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php

                            $servername = "localhost:3306";
                            $username = "root";
                            $password = "";
                            $dbname = "hfscco";

                            $conn = mysqli_connect($servername, $username, $password, $dbname);

                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            $sql = "SELECT * FROM financial_db WHERE application_id = '$applicationID'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();

                            $application_status = $row['application_status'];

                            if ($application_status === "For Releasing") {
                                echo '<input type="submit" class="btn btn-success col-5 col-lg-1" name="received" value="Received">';
                            }
                        ?>
                    </div>

                    <?php
                        $servername = "localhost:3306";
                        $username = "root";
                        $password = "";
                        $dbname = "hfscco";

                        $conn = mysqli_connect($servername, $username, $password, $dbname);

                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        if (isset($_POST['approved'])) {
                            $accountID = $_POST['Account_ID'];
                            $applicationID = $_POST['Application_ID'];

                            // Query after variables are set
                            $query = "SELECT * FROM bod_approvals WHERE application_id = '$applicationID'";
                            $result5 = mysqli_query($conn, $query);

                            if (!$result5) {
                                die("Error in SELECT query: " . mysqli_error($conn));
                            }

                            echo "Row count for BOD approvals: " . mysqli_num_rows($result5) . "<br>";

                            // Check if the row count meets your condition
                            if (mysqli_num_rows($result5) >= 4) {
                                $sql4 = "UPDATE financial_db SET application_status = 'For Releasing' WHERE application_id = '$applicationID' AND account_id = '$accountID'";
                                $result4 = $conn->query($sql4);

                                echo "<script>alert('Record was updated successfully!'); window.location.href='loan-personnel-laf-approved.php';</script>";
                            } else {
                                echo "<script>alert('Not yet evaluated by BOD'); window.location.href='loan-personnel_loanDetailedView.php?application_id=$applicationID'</script>";
                            }
                        }
                        else if (isset($_POST['received'])) {
                            $accountID = $_POST['Account_ID'];
                            $applicationID = $_POST['Application_ID'];
                        
                            // Update application status to 'Received'
                            $sqlUpdate = "UPDATE financial_db SET application_status = 'Received' WHERE application_id = '$applicationID' AND account_id = '$accountID'";
                            $resultUpdate = $conn->query($sqlUpdate);
                        
                            if ($resultUpdate) {
                                echo "<script>alert('Application status updated to Received successfully!'); window.location.href='loan-personnel-laf-approved.php';</script>";
                            } else {
                                echo "<script>alert('Error updating status: " . $conn->error . "'); window.location.href='loan-personnel_loanDetailedView.php?application_id=$applicationID'</script>";
                            }
                        }                        

                        mysqli_close($conn);
                    ?>

                </div>
            </form>
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
</html