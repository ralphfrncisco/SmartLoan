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

    // Get the current year
    $currentYear = date("Y");

    // Initialize array to hold month counts
    $monthCounts = array(
        "January" => 0,
        "February" => 0,
        "March" => 0,
        "April" => 0,
        "May" => 0,
        "June" => 0,
        "July" => 0,
        "August" => 0,
        "September" => 0,
        "October" => 0,
        "November" => 0,
        "December" => 0
    );

    // Fetch data from the database
    $sql = "SELECT approval_time FROM members_db";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        // Extract month and year from DateTime
        $dateTimeParts = explode(",", $row['approval_time']);
        $monthYear = explode(" ", $dateTimeParts[0]);
        $year = trim($dateTimeParts[1]);
        $month = trim($monthYear[0]);

        // Check if the year matches the current year
        if ($year == $currentYear) {
            // Increment count for the extracted month
            $monthCounts[$month]++;
        }
    }

    // Prepare response
    $rows = array();
    foreach ($monthCounts as $month => $count) {
        $rows[] = array(
            "Month" => $month,
            "Num" => $count
        );
    }

    header('Content-Type: application/json');
    echo json_encode($rows);

    $conn->close();
?>