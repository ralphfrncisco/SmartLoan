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

    if (isset($account_id)) {
    
        $name = "";
        // Query to retrieve account details
        $sql = "SELECT * FROM members_db WHERE account_id = '$account_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    
        $LastName = $row['LastName'];
        $FirstName = $row['FirstName'];
        $MiddleName = $row['MiddleName'];
        $Suffix = $row['Suffix'];
        $email_address = $row['email_address'];
        $contact_num = $row['contact_no'];

        $name = $LastName . ", " . $FirstName . " ";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFSCCO | Loan Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="members-dashboard.css">
    <link rel="stylesheet" href="../css-files/font-import.css">
    <link rel="icon" type="image/x-icon" href="../Resources/hfscco-logo-title.ico">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
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
            <span class="navbar-brand mb-0 h1 text-white">Loan Calculator</span>

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

        <div class="container-fluid p-4" id = "cont">
            <div class="modal fade" id="disclaimer-notice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog col-12 modal-lg">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center align-items-center mb-2 w-100">
                            <img src="../Resources/logo.png" alt="Logo" id="hfscco-logo" class="me-3">
                            <h4 class="modal-title fs-4" id="staticBackdropLabel">Loan Computation Disclaimer</h4>
                        </div>

                        
                        <div class="modal-body lh-lg" style="text-align: justify;">
                        The loan computation provided herein is for illustrative purposes only and is based on standard parameters. Actual loan terms, interest rates, and payment amounts may vary depending on individual circumstances, creditworthiness, and prevailing market conditions at the time of application.<br><br>						
						
                        This sample loan computation is not a guarantee of the terms and conditions that will be offered upon loan approval. Final loan terms will be determined by the lending institution after a thorough evaluation of the borrower's credit profile, financial capacity, and other relevant factors.<br><br>					
                                                
                        While we strive to provide accurate and up-to-date information, we make no warranties or representations regarding the accuracy, completeness, or reliability of the loan computation provided. Borrowers are encouraged to consult with the authorized loan personnel to obtain personalized advice tailored to their specific needs and circumstances.<br><br>					
                                                
                        By using this sample loan computation, you acknowledge and agree that the figures presented are for informational purposes only and are subject to change without notice. We disclaim any liability for errors, omissions, or inaccuracies in the loan computation and any reliance placed on the information contained herein.
                        </div>
                        <div class="modal-footer d-flex justify-content-between w-100">
                            <div class="form-check">
                                <input class="form-check-input border border-dark-subtle" type="checkbox" value="" id="understood">
                                <label class="form-check-label" for="understood">
                                    Ok, I understand.
                                </label>
                            </div>
                            <div>
                                <button type="button" id="next-button" class="btn btn-primary" disabled>Next</button>
                            </div>
                        </div>
            
                        <script>
                            const checkbox = document.getElementById('understood');
                            const nextButton = document.getElementById('next-button');
            
                            // Enable the button when the checkbox is checked
                            checkbox.addEventListener('change', function() {
                                nextButton.disabled = !this.checked;
                            });
            
                            // Close the modal when the Next button is clicked
                            nextButton.addEventListener('click', function() {
                                const modal = document.getElementById('disclaimer-notice');
                                const bootstrapModal = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
                                bootstrapModal.hide(); // Close the modal
                                // Optionally, perform any additional actions here
                            });
                        </script>
                    </div>
                </div>
            </div>
            <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="row">
                    <!-- Loan Form -->
                    <div class="col-md-3" id = "loan-calcu">
                        <div class="card p-3" id="loan-inputs">
                            <script>
                                function RemoveErrorElementLoanTerm()
                                {
                                    const RequiredLoanTerm = document.getElementById("requiredLoanTerm");
                                    const loanTermInput = document.getElementById("loanTerm");

                                    RequiredLoanTerm.style.display = "none";
                                    loanTermInput.classList.remove('border-danger');
                                    loanTermInput.classList.add('border-dark-subtle');
                                }
                                
                            </script>
                            <div class="mb-3">
                                <label for="loanType" class="form-label">Loan Type:<span id = "requiredLoanType" style = "color: red; display: none;">*</span></label>
                                <select class="form-select border border-dark-subtle" name = "loan_Type" id="loanType" onchange="showInterestRate()">
                                    <option selected>Select Loan Type</option>
                                    <option value="(VL)Vendors Loan">(VL)Vendor's Loan</option>
                                    <option value="(MEL)Micro Enterprise Loan">(MEL)Micro Enterprise Loan</option>
                                    <option value="(SEL)Small Enterprise Loan">(SEL)Small Enterprise Loan</option>
                                    <option value="(BL)Business Loan">(BL)Business Loan</option>
                                    <option value="(CL)Commercial Loan">(CL)Commercial Loan</option>
                                    <option value="(IL)Infrastructure Loan">(IL)Infrastructure Loan</option>
                                    <option value="(CRL-PROD)Check Rediscounting (Productive)">(CRL-PROD)Check Rediscounting (Productive)</option>
                                    <option value="(LAD-PROD)Loan Against Deposit (Productive)">(LAD-PROD)Loan Against Deposit (Productive)</option>
                                    <option value="(FLL-PROD)Fast Lane Loan (Productive)">(FLL-PROD)Fast Lane Loan (Productive)</option>
                                    <option value="(CRL-PROV)Check Rediscounting (Providential)">(CRL-PROV)Check Rediscounting (Providential)</option>
                                    <option value="(LAD-PROV)Loan Against Deposit (Providential)">(LAD-PROV)Loan Against Deposit (Providential)</option>
                                    <option value="(FLL-PROV)Fast Lane Loan (Providential)">(FLL-PROV)Fast Lane Loan (Providential)</option>
                                    <option value="(EL)Educational Loan">(EL)Educational Loan</option>
                                    <option value="(INVL)Investment Loan">(INVL)Investment Loan</option>
                                    <option value="(MAL)Medical Assistance Loan">(MAL)Medical Assistance Loan</option>
                                    <option value="(PL)Personal Loan">(PL)Personal Loan</option>
                                    <option value="(TL)Travel Loan">(TL)Travel Loan</option>
                                    <option value="(UTL)Utilities Assistance Loan">(UTL)Utilities Assistance Loan</option>
                                    <option value="(LEL)Life Events Loan">(LEL)Life Events Loan</option>
                                    <option value="(GAFL)Gadget-Appliance-Furniture Loan">(GAFL)Gadget-Appliance-Furniture Loan</option>
                                    <option value="(EML)Emergency Loan">(EML)Emergency Loan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="loanTerm" class="form-label">Loan Term (month/s):<span id = "requiredLoanTerm" style = "color: red; display: none;">*</span></label>
                                <input type="number" class="form-control border border-dark-subtle" name = "loan_Term" id="loanTerm" inputmode="numeric" onkeydown="RemoveErrorElementLoanTerm()">
                                <span id="error" style="color: red; display: none;"></span>
                            </div>
                            <script>
                                document.getElementById('loanTerm').addEventListener('input', function() {
                                    const loanType = document.getElementById('loanType').value;
                                    const loanTermInput = document.getElementById('loanTerm');
                                    const errorElement = document.getElementById('error');
                                    const calculateBtn = document.getElementById('Calculate-btn');
                                    
                                    const loanTerm = parseFloat(loanTermInput.value);

                                    if (loanType === "(VL)Vendors Loan") {
                                        if (isNaN(loanTerm) || loanTerm < 3 || loanTerm > 6) {
                                            // Display the error message
                                            errorElement.innerHTML = "Please enter a value between 3 and 6 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;

                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    }
                                    
                                    else if (loanType === "(MEL)Micro Enterprise Loan") {
                                        if (loanTerm < 1 || loanTerm > 18 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 1 and 18 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(SEL)Small Enterprise Loan") {
                                        if (loanTerm < 12 || loanTerm > 24 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 12 and 24 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(BL)Business Loan") {
                                        if (loanTerm < 12 || loanTerm > 36 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 12 and 36 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(CL)Commercial Loan") {

                                        if (loanTerm < 12 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value of 12 or more months.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(IL)Infrastructure Loan") {
                                        if (loanTerm < 12 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value of 12 or more months.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    }
                                    
                                    else if (loanType === "(CRL-PROD)Check Rediscounting (Productive)") {
                                        if (loanTerm !== 1 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter exactly 1 month.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(LAD-PROD)Loan Against Deposit (Productive)") {
                                        if (loanTerm < 1 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter 1 or more months.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(FLL-PROD)Fast Lane Loan (Productive)") {
                                        if (loanTerm < 1 || loanTerm > 24 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 1 and 24 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(CRL-PROV)Check Rediscounting (Providential)") {
                                        if (loanTerm !== 1 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter exactly 1 month.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(LAD-PROV)Loan Against Deposit (Providential)") {
                                        if (loanTerm < 1 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter 1 or more months.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(FLL-PROV)Fast Lane Loan (Providential)") {
                                        if (loanTerm < 1 || loanTerm > 24 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 1 and 24 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(EL)Educational Loan") {
                                        if (loanTerm < 1 || loanTerm > 10 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 1 and 10 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(INVL)Investment Loan") {
                                        if (loanTerm < 12 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value of 12 or more months.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(MAL)Medical Assistance Loan") {
                                        if (loanTerm < 1 || loanTerm > 12 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 1 and 12 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(PL)Personal Loan") {
                                        if (loanTerm < 1 || loanTerm > 24 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 1 and 24 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(TL)Travel Loan") {
                                        if (loanTerm < 1 || loanTerm > 18 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 1 and 18 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(UTL)Utilities Assistance Loan") {
                                        if (loanTerm < 1 || loanTerm > 6 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 1 and 6 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(LEL)Life Events Loan") {
                                        if (loanTerm < 1 || loanTerm > 24 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 1 and 24 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(GAFL)Gadget-Appliance-Furniture Loan") {
                                        if (loanTerm < 3 || loanTerm > 12 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 3 and 12 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    } 
                                    
                                    else if (loanType === "(EML)Emergency Loan") {
                                        if (loanTerm < 1 || loanTerm > 12 || isNaN(loanTerm)) {
                                            errorElement.innerHTML = "Please enter a value between 1 and 12 only.";
                                            errorElement.style.display = 'inline';
                                            
                                            loanTermInput.className = 'form-control input-error';
                                            loanTermInput.classList.remove('border-dark-subtle');
                                            loanTermInput.classList.add('border-danger');
                                            
                                            calculateBtn.disabled = true;
                                            calculateBtn.style.opacity = 0.3;
                                            
                                        } else {

                                            errorElement.style.display = 'none';

                                            loanTermInput.className = 'form-control input-normal';
                                            loanTermInput.classList.remove('border-danger');
                                            loanTermInput.classList.add('border-dark-subtle');

                                            calculateBtn.disabled = false;
                                            calculateBtn.style.opacity = 1;
                                        }
                                    }

                                    else 
                                    {
                                        loanTermInput.placeholder = "";
                                        calculateBtn.style.opacity = 0;
                                        errorElement.style.display = 'none';
                                        calculateBtn.disabled = false;
                                        loanTermbtn.style.border = '1px solid #767676'
                                    }
                                });
                            </script>
                            <div class="mb-3">
                                <label for="loanAmount" class="form-label">Loan Amount:<span id = "requiredLoanAmount" style = "color: red; display: none;">*</span></label>
                                <input type="text" class="form-control border border-dark-subtle" name = "loan_Amount" id="loanAmount" inputmode="numeric" oninput="formatLoanAmount(this)" onkeyup="LoanAmountOnChange()">
                            </div>
                            <div class="mb-3">
                                <label for="interest_rate_text" class="form-label">Interest Rate:<span id = "requiredInterestRate" style = "color: red; display: none;">*</span></label>
                                <input type="text" class="form-control border border-dark-subtle" id="interest_rate_text" readonly>
                            </div>
                            <button type="button" class="btn btn-success w-100 mt-3 mb-2 p-2" id="calculate-btn" onclick="calculateLoan()">Calculate</button>
                            <input type="hidden" id="interestRateInput" name="interest_Rate">

                            <div class="mt-2 mb-2" id = "loanApplicationContainer" style = "display: none;">
                                <button type="button" class="btn btn-primary w-100 mt-3 p-2 d-flex flex-column align-items-center justify-content-center" id = "RegisterLoan" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Register Loan
                                </button>
                            </div>
                        </div>
                    </div>
                    <script src = "../js-files/loan-calcu-function.js"></script>
                    <!-- Loan Details Display -->
                    <div class="col-md-9 mb-3" id = "loan-calcu" required>
                        <div class="table-responsive p-3 justify-content-center align-items-center text-center" id="scheduled_payment_table">
                            <h4 class="text-muted">Detailed payment per terms will show here.</h4>
                        </div>
                    </div>
 
                    
                    
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <img src="../Resources/logo.png" alt="Logo" id = "loan-appForm-logo" style="width: 50px; height: 50px;">
                                    <h1 class="modal-title fs-3" id="loan-appForm-header">&nbsp;&nbsp;Loan Application Form</h1>
                                    <button type="button" class="btn-close" id = "closeBtnModal" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                    
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <!-- Account details section -->
                                        <div class="row mb-3" id="account-details">
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
                                                <input type="text" class="form-control border border-dark-subtle" name = "accountID" value = "<?php echo $account_id?>" readonly>
                                            </div>
                                            <!-- Second column -->
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                <label class="form-label">Email Address:</label>
                                                <input type="text" class="form-control border border-dark-subtle" name = "email_add" value = "<?php echo $email_address?>" readonly>
                                            </div>
                                            <!-- Third column -->
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                <label class="form-label">Contact Number:</label>
                                                <input type="number" class="form-control border border-dark-subtle" name = "contact_no" value = "<?php echo $contact_num?>" readonly>
                                            </div>
                                        </div>
                    
                                
                                        <div class="row mt-5">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <!-- First column -->
                                                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                        <label class="form-label">Loan Amount Applied:</label>
                                                        <input type="text" class="form-control border border-dark-subtle" name = "loanAmountApplied" id = "LoanAmountApplied" readonly>
                                                    </div>
                                                    <!-- Second column -->
                                                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                        <label class="form-label">Loan Term Applied:</label>
                                                        <input type="text" class="form-control border border-dark-subtle" name = "loanTermApplied" id = "LoanTermApplied" readonly>
                                                    </div>
                                                    <!-- Third column -->
                                                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                                        <?php
                                                            $registrationDate = date('m/d/Y');
                                                        ?>
                                                        <label class="form-label">Date Applied:</label>
                                                        <input type="text" class="form-control border border-dark-subtle" name = "date_applied" value = "<?php echo $registrationDate?>" readonly>
                                                    </div>
                                                </div>
                    
                                                <div class="row mt-2 mb-2">
                                                    <!-- Fourth column -->
                                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                        <label class="form-label">Manner of Payment:</label>
                                                        <select class="form-select border border-dark-subtle" name = "mannerOfpayment" required>
                                                            <option selected>Select Manner of Payment</option>
                                                            <option value="Walk In">Walk-In</option>
                                                            <option value="Bank Deposit">Bank Deposit/Transfer</option>
                                                            <option value="Issuance of PDC">Issuance of PDC</option>
                                                            <option value="Auto Debit">Auto Debit</option>
                                                        </select>
                                                    </div>
                                                    <!-- Fifth column -->
                                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                        <label class="form-label">Type of Application:</label>
                                                        <select class="form-select border border-dark-subtle" name = "type_Of_application" required>
                                                            <option selected>Select Type</option>
                                                            <option value="New">New</option>
                                                            <option value="Renewal">Renewal</option>
                                                            <option value="Restructure">Restructure</option>
                                                        </select>
                                                    </div>
                                                </div>
                    
                                                <!-- Responsive textarea -->
                                                <div class="row mt-3 mb-2">
                                                    <div class="col-12">
                                                        <label class="form-label">Loan Purpose:</label>
                                                        <textarea class="form-control border border-dark-subtle" placeholder="" required name = "loan-purpose-txtarea" id="floatingTextarea" rows="3" style="resize: none;"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name = "submitBtn" class="btn btn-primary">Register</button>
                                </div>

                                <?php
                                    $servername = "localhost:3306";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "hfscco";


                                    $conn = new mysqli($servername, $username, $password, $dbname);


                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    if (isset($_POST['submitBtn'])) {

                                        $account_id = $_SESSION['account_id'];

                                        $sql2 = "SELECT * FROM members_db WHERE account_id = '$account_id'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        $row = mysqli_fetch_assoc($result2);
                                        
                                        $loanAmount = $_POST['loanAmountApplied'];
                                        $dateApplied = $_POST['date_applied'];
                                        $loanTermApplied = $_POST['loanTermApplied'];
                                        $loanInterest = $_POST['interest_Rate'];
                                        $loanType = $_POST['loan_Type'];
                                        $mannerOfPayment = $_POST['mannerOfpayment'];
                                        $loanPurpose = $_POST['loan-purpose-txtarea'];
                                        $account_id = $_POST['accountID'];
                                        $LastName = $row['LastName'];
                                        $FirstName = $row['FirstName'];
                                        $MiddleName = $row['MiddleName'];
                                        $Suffix = $row['SuffixName'];
                                        $EmailAddress = $_POST['email_add'];
                                        $ContactNo = $row['contact_no'];
                                        $typeOfApplication = $_POST['type_Of_application'];
                                        
                                        $sql1 = "INSERT INTO financial_db (loan_Amount, date_Applied, loan_term_applied, loan_interest, loan_type, manner_of_payment, loan_purpose, account_id, LastName, FirstName, MiddleName, Suffix, email, contact_no, type_of_application, application_status) 
                                        VALUES ('$loanAmount', '$dateApplied', '$loanTermApplied', '$loanInterest', '$loanType' ,'$mannerOfPayment','$loanPurpose', '$account_id', '$LastName', '$FirstName', '$MiddleName', '$Suffix', '$EmailAddress', '$ContactNo', '$typeOfApplication', 'Pending')";
                                        
                                        $result1 = $conn->query($sql1);

                                        if($result1)
                                        {
                                            echo "<script>
                                            alert('Loan application was registered successfully!')
                                            window.location.href='../dashboard/members_loan_calculator.php?account_id=$account_id';
                                            </script>";
                                        }
                                        else {
                                            echo "<script>
                                            alert('Unable to register your loan application.')
                                            window.location.href='members_loan_calculator.php?account_id=$account_id';
                                            </script>";
                                        }

                                        
                                    }
                                    
                                ?>
                            </div>
                        </div>
                    </div>
                                       
                    
                </div>
            </form>
        </div>
    </div>

    <style>

        input:focus {
            box-shadow: none;
        }

        /* CSS for the incorrect input state */
        .input-error {
            border: 2px solid red; /* red border for error state */
            box-shadow: 0 0 5px red; /* red glow effect */
        }

        /* CSS for resetting to normal state */
        .input-normal {
            border: 1px solid #ccc; /* default subtle border */
            box-shadow: none; /* no glow effect */
        }

        #loan-inputs {
            border: none;
        }
        label, #calculate-btn {
            font-weight: 600;
            font-family: 'Public Sans';
        }
        #loanType, #loanTerm, #loanAmount, #interest_rate_text {
            border-radius: 4px;
            border: 1px solid rgba(118, 118, 118, 0.7);
        }
        #scheduled_payment_table {
            height: 100%;
            background-color: #D9D9D9;
        }

        table th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            white-space: nowrap;
        }
        
        th {
            background-color: #f2f2f2;
        }
        .odd-table-td
        {
            border: 1px solid #9AA0A6;
            background-color: #CCCCCC;
        }
        tr:nth-child(even) 
        {
            background-color: #CCCCCC;
            border: 1px solid #B4B8BC;
        }
        tr:nth-child(odd) 
        {
            background-color: #fff;
            border: 1px solid #B4B8BC;
        }
        

        @media (max-width: 425px) {
            #loan-calcu
            {
                padding-top: 0px;
            }
            #scheduled_payment_table {
                height: 95%;
                margin-top: 2%;
            }
            #scheduled_payment_table .text-muted
            {
                font-size: 1.002rem!important;
            }
            #loan-appForm-logo
            {
                height: 35px!important;
                width: 35px!important;
            }
            #loan-appForm-header
            {
                font-size: 1.068rem!important;
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

    // Function to format loan amount input
    function formatLoanAmount(input) {
        let numericValue = input.value.replace(/[^0-9.]/g, '');
        let formattedValue = numericValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        input.value = formattedValue;
        input.setAttribute('data-numeric-value', numericValue);
    }

    // Function to get the loan amount
    function getLoanAmount() {
        let input = document.getElementById('loanAmount');
        return parseFloat(input.getAttribute('data-numeric-value')) || 0;
    }

    // Function to validate loan amount on change
    function LoanAmountOnChange() {
        const RequiredLoanAmount = document.getElementById("requiredLoanAmount");
        const loanAmountInput = document.getElementById("loanAmount");
        const loanAmountValue = getLoanAmount();

        // Reset the display and border
        RequiredLoanAmount.style.display = "none";
        loanAmountInput.classList.remove('border-danger');
        loanAmountInput.classList.add('border-dark-subtle');

        // Get the loan type value
        var loanTypeValue = document.getElementById("loanTerm").value;

        // Only validate for "(VL)Vendors Loan"
        if (loanTypeValue === "(VL)Vendors Loan") {
            // Check if loan amount is invalid (NaN or outside the range)
            if (isNaN(loanAmountValue) || loanAmountValue < 5000 || loanAmountValue > 9999) {
                loanAmountInput.classList.remove('border-dark-subtle');
                loanAmountInput.classList.add('border-danger');
            }
        }
    }

    // Focus on input when modal is shown
    const myModal = document.getElementById('exampleModal');
    const myInput = document.getElementById('RegisterLoan');

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus();
    });
</script>
<script src = "../js-files/disabled.js"></script>
</body>
</html>
