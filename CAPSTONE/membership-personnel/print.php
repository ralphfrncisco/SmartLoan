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

    $application_id = $_GET["account_id"];

    $sql = "SELECT * FROM members_db WHERE account_id = '$application_id'";

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Membership Application Form</title>
    <link rel = "icon" type="image/x-icon" href="../Resources/hfscco-logo-title.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 5px;
        }
        .header img {
            height: 60px;
            vertical-align: middle;
            margin-right: 10px;
        }
        .header h1, .header p {
            margin: 5px 0;
        }
        .header p
        {
            font-size: 10px;
        }
        table {
            width: 100%;
            margin: 10px 0;
        }
        th, td {
            padding: 7px;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
            font-size: 1.1em;
        }
        .section-title {
            font-weight: bold;
            font-size: 1.2em;
            padding-top: 12px;
        }
        .field {
            width: 100%;
            border-bottom: 1px solid #000;
            height: 1.5em;
            margin-bottom: 5px;
        }
        input[type="text"]
        {
            border: none;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
        }
        .terms {
            margin-top: 20px;
            font-size: 0.9em;
        }
        .signature {
            margin-top: 0px;
            text-align: right;
        }
        .signature label {
            display: inline-block;
            margin-right: 75px;
        }
        .signature .field {
            width: 200px;
            display: inline-block;
        }
        /* Print-specific styling */
        @media print {
            body * {
                visibility: hidden;
            }
            #printableArea, #printableArea * {
                visibility: visible;
            }
            #printableArea {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div id="printableArea">
    <!-- Header Section -->
    <div class="header">
        <img src="../Resources/logo.png" style = "width: 50px; height: 50px;" alt="">
        <h3 style = "font-family: Times New Roman; margin-top: 10px;">HOLY FAMILY SAVINGS AND CREDIT COOPERATIVE</h3>
        <p>9-A Pablo Street, Karuhatan, Valenzuela City</p>
        <p>Telephone Nos: 8294-4838 / 8295-3171 | Cellphone Nos: 0927-421-2232 / 0933-821-1609</p>
        <p>Email/Facebook: hfscco@yahoo.com</p>
    </div>

    <!-- Personal Information Section -->
    <form>
        <div class="section-title" style = "margin-left: 6px;">Personal Information</div>
        <table>
        <tr>
            <!-- Column 1 -->
            <td style="width: 50%;">
                Last Name <input type = "text" class="field" value = "<?php echo $LastName?>"readonly></input>
            </td>
            <td style="width: 50%;">
                Sex <input type = "text" class="field" value = "<?php echo $gender?>"readonly></div>
            </td>
        </tr>
        <tr>
            <td>
                First Name <input type = "text" class="field" value = "<?php echo $FirstName?>"readonly></div>
            </td>
            <td>
                Date of Birth <input type = "text" class="field" value = "<?php echo $DateOfBirth?>"readonly></div>
            </td>
        </tr>
        <tr>
            <td>
                Middle Name <input type = "text" class="field" value = "<?php echo $MiddleName?>"readonly></div>
            </td>
            <td>
                Place of Birth <input type = "text" class="field" value = "<?php echo $PlaceOfBirth?>"readonly></div>
            </td>
        </tr>
        <tr>
            <td>
                Suffix <input type = "text" class="field" value = "<?php echo $Suffix?>"readonly></div>
            </td>
            <td>
                Civil Status <input type = "text" class="field" value = "<?php echo $CivilStatus?>"readonly></div>
            </td>
        </tr>
        <tr>
            <td>
                Address <input type = "text" class="field" value = "<?php echo $address?>"readonly></div>
            </td>
            <td>
                Occupation <input type = "text" class="field" value = "<?php echo $occupation?>"readonly></div>
            </td>
        </tr>
        <tr>
            <td>
                Contact Number <input type = "text" class="field" value = "<?php echo $contact_num?>"readonly></div>
            </td>
            <td>
                Level of Education <input type = "text" class="field" value = "<?php echo $educ_attainment?>"readonly></div>
            </td>
        </tr>
        </table>


        <!-- Membership Application Terms and Conditions -->
        <div class="terms">
            <div class="section-title mb-2">Membership Application Terms and Conditions</div>
            <p style = "text-align:justify; font-size: 12px;">"Holy Family Savings and Credit Cooperative (HFSCCO) is committed to respecting your privacy and recognizes the importance of protecting the information collected about you. Personal information that you provided in this form shall only be processed in relation to its legal purpose. By filling out this form, you agree that all personal information you submit shall be protected with reasonable and appropriate measures, and shall only be retained as long as necessary. Rest assured that any information exchanged or that comes into possession of HFSCCO shall be maintained in strict confidentiality and secrecy and shall not be disclosed to any third party, except for the purposes abovementioned, and shall be protected in accordance with RA 10173, Data Privacy Act of 2012.</p>
            <p style = "text-align:justify; font-size: 12px;">By signing this form, I hereby certify and attest to the fact that all information given by me is true and correct, and that any and all material misinterpretation or falsity shall be construed as an act to defraud HFSCCO for which civil and/or criminal liability can be pursued against me. Any changes in the foregoing information shall be promptly communicated to HFSCCO. I hereby authorize HFSCCO to verify, investigate, and validate any/all information given by me as HFSCCO may deem appropriate."</p><br>
        </div>

        <!-- Signature Section -->
        <div class="signature">
        <div class="field"></div><br>
            <label style = "font-size: 10px; margin-top: -10px;">Signature</label> 
        </div>
    </form>
</div>

<!-- Print Button -->
<button class="no-print" onclick="window.print()">Print Application Form</button>

</body>
</html>
