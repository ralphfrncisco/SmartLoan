
<?php
    $servername = "localhost: 3306";
    $username = "root";
    $password = "";
    $dbname = "hfscco";
    
    //creating connection
    $conn = mysqli_connect($servername,$username,$password, $dbname);
    
    //checking connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $LastName = "";
    $FirstName = "";
    $MiddleName = "";

    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $sql = "SELECT LastName, FirstName, MiddleName FROM members_db";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    else
    {
        echo "Error retrieving data: " . mysqli_error($conn);
    }
?>