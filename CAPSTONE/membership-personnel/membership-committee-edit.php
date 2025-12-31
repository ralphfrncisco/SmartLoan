<?php

  $servername = "localhost:3306";
  $username = "root";
  $password = "";
  $dbname = "hfscco";


  $conn = mysqli_connect($servername,$username,$password, $dbname);


  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $LastName = "";
  $FirstName = "";
  $MiddleName = "";
  $Suffix = "";
  $address = "";
  $contact_num = "";
  $email_add = "";
  $gender = "";
  $DateOfBirth = "";
  $PlaceOfBirth = "";
  $occupation = "";
  $CivilStatus = "";
  $educ_attainment = "";
  $password = "";
  $acc_status = "";

  if($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    if (!isset($_GET["account_id"])){
        echo 'i';
        exit;
    }

    $account_id = $_GET["account_id"];

    $sql = "SELECT * FROM members_db WHERE account_id = '$account_id'";

    $result= $conn->query($sql);
    $row = $result->fetch_assoc();

    
    if(!$row){
        header("");
        exit;
    }

    $LastName = $row['LastName'];
    $FirstName = $row['FirstName'];
    $MiddleName = $row['MiddleName'];
    $Suffix = $row['Suffix'];
    $address = $row['address'];
    $contact_num = $row['contact_no'];
    $email_add = $row['email_address'];
    $gender = $row['gender'];
    $DateOfBirth = $row['date_of_birth'];
    $PlaceOfBirth = $row['place_of_birth'];
    $occupation = $row['occupation'];
    $CivilStatus = $row['civil_status'];
    $educ_attainment = $row['educ_attainment'];
    $password = $row['password'];
    $acc_status = $row['acc_status'];
    $DateTime = $row['DateTime'];
  }
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFSCCO | Membership Committee</title>
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
  .info-section
  {
    padding-bottom: 5%;
  }
  .form-controls-section
  {
    padding-left: 3%!important;
    padding-bottom: 5%;
  }

  .form-check-label
  {
    font-size: 1.038rem;
  }
  .btn
  {
    padding: 10px 20px;
  }
  #cancel-btn
  {
    border: 1px solid rgb(182, 188, 200);
    color: rgba(0, 0, 0, 0.8);
  }
  #cancel-btn i
  {
    font-size: 17px;
    margin-left: -5px;
    margin-right: 5px;
  }
  #cancel-btn span
  {
    margin-top: -5px!important;
  }

  @media (max-width: 768px) {
    .col-md-8, .col-md-4 {
      width: 100%;
      margin-bottom: 15px;
    }
  }

  @media (max-width: 576px) {
    .container-xxl
    {
      margin-top: 1%;
    }
    .header img {
      display: none;
    }
    
    .header h1
    {
      font-size: 1.28rem!important;
      margin-left: -7px;
    }

    h5, label, .form-control
    {
      font-size: 0.878rem;
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
        <nav class="navbar navbar-expand-lg " id = "side-navbar">
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

      <div class="container-xxl mb-5">
        <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

          <div class = "header mt-2">
            <img src="../Resources/logo.png" alt="Logo" style="width: 50px; height: 50px;">
            <h1 class="modal-title fs-3" id="exampleModalLabel">&nbsp;&nbsp;Membership Application Form</h1>
          </div>


          <div class = "row mt-4" id = "approval-form">

            <div class = "info-section col col-12 p-3">
              <div class = "row col-12 mb-4">
                <h5><b>Account Number&nbsp;</b></h5>
                <div class="mt-3 mb-2" style = "width: 245px;">
                    <input type="text" name="AccountID" inputmode="numeric" value = "<?php echo $account_id?>" class="form-control border border-dark-subtle" placeholder="" aria-label="Account_Num" required>
                </div>
              </div>
              <h5><b>Account Name</b></h5>
              <div class="row mt-3">
                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                      <label class="form-label">Last Name</label>
                      <input type="text" name="LastName" class="form-control border border-dark-subtle" value = "<?php echo $LastName?>">
                  </div>
                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                      <label class="form-label">First Name</label>
                      <input type="text" name="FirstName" class="form-control border border-dark-subtle" value = "<?php echo $FirstName?>">
                  </div>
                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                      <label class="form-label">Middle Name</label>
                      <input type="text" name="MiddleName" class="form-control border border-dark-subtle" value = "<?php echo $MiddleName?>">
                  </div>
                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                      <label class="form-label">Suffix</label>
                      <input type="text" name="SuffixName" class="form-control border border-dark-subtle" value = "<?php echo $Suffix?>">
                  </div>
              </div>
              
              <div class="row mt-4">
                <h5><b>Other Details</b></h5>
                <div class = "row mt-3">
                  <div class="col-12 col-md-6 mb-2">
                      <label class="form-label">Address</label>
                      <input type="text" name="address" class="form-control border border-dark-subtle" value = "<?php echo $address?>">
                  </div>
                  <div class="col-12 col-md-3">
                      <label class="form-label">Contact Number</label>
                      <input type="text" name="ContactNum" class="form-control border border-dark-subtle" value = "<?php echo $contact_num?>">
                  </div>
                  <div class="col-12 col-md-3">
                      <label class="form-label">Email Address</label>
                      <input type="text" name="Email_Address" class="form-control border border-dark-subtle" value = "<?php echo $email_add?>">
                  </div>
                </div>
                
              </div>

              <div class="row mt-4">
                <div class="col-12 col-md-3 mt-1 mb-4">
                    <p>Date of Birth</p>
                    <input type="text" name="DateOfBirth" class="form-control border border-dark-subtle" value = "<?php echo $DateOfBirth?>" id="birthdate">
                </div>

                <div class="col-12 col-md-5 mt-1 mb-4">
                    <p>Place of Birth</p>
                    <input type="text" name="PlaceOfBirth" class="form-control border border-dark-subtle" id="place-of-birth" value = "<?php echo $PlaceOfBirth?>">
                </div>

                <div class="col-12 col-md-4 mt-1 mb-4">
                    <p>Sex</p>
                    <input type="text" name="gender" class="form-control border border-dark-subtle" id="" style = "width: 245px;" value = "<?php echo $gender?>">
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-12 col-md-3 mt-1 mb-4">
                  <label class="form-label">Civil Status</label>
                  <input type="text" name="Civil-Status" id = "civil-status" class="form-control border border-dark-subtle" value = "<?php echo $CivilStatus?>">
                </div>
                <div class="col-12 col-md-5 mt-1 mb-4">
                    <label class="form-label">Occupation</label>
                    <input type="text" name="occupation" class="form-control border border-dark-subtle" value = "<?php echo $occupation?>" >
                </div>
                <div class="col-12 col-md-4 mt-1 mb-4">
                  <label class="form-label">Educational Attainment</label>
                  <input type="text" class="form-control border border-dark-subtle" name="educational-attainment" id = "educ-attainment" style = "width: 245px;" value = "<?php echo $educ_attainment?>">
                </div>
              </div>
            </div>
          </div>

          <a href="membership-committee-memberList.php" class="btn me-auto" id = "cancel-btn"><i class="bi bi-chevron-left"></i><span>Back</span></a>

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
                  
</html>