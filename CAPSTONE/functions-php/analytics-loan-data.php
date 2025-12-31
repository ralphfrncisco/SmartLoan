<?php
    // Establish database connection
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "hfscco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT loan_Type, COUNT(*) AS Mhl FROM financial_db GROUP BY loan_type";
    $result = $conn->query($sql);

    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Convert data to JSON format and output
    echo json_encode($rows);

    $conn->close();
?>