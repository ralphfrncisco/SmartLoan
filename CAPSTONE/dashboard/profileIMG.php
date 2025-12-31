<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";  // Change to your database name

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (isset($_GET['account_id'])) {
        $account_id = $_GET['account_id'];
    }

    // Variables to store file upload path
    $uploadDir = "../uploads/profile_pics/"; // Folder to store uploaded images
    $imagePath = "../Resources/blank-profile.jpg";  // Default image path

    // Check if the form is submitted (Insert button clicked) and account_id is available
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profilePic']) && isset($_POST['account_id'])) {
        $file = $_FILES['profilePic'];
        $account_id = $_POST['account_id'];  // Get the account_id from POST data

        // Check for errors during upload
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Get the file extension and generate a unique name
            $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid('profile_', true) . '.' . $fileExt;
            $filePath = $uploadDir . $newFileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                // Insert the profile_pic into the database, linked to a specific account_id
                $sql = "INSERT INTO test1 (account_id, profile_pic) VALUES ('$account_id', '$filePath')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Image uploaded successfully!')</script>";
                    // After successful upload, display the inserted image path
                    $imagePath = $filePath;  // Update the imagePath to show the new image
                } else {
                    echo "Error inserting into database: " . mysqli_error($conn);
                }
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "File upload error.";
        }
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Image Upload</title>
    <style>
        /* Styling for the preview image */
        .preview-img {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Change Profile Picture</h2>

<!-- Display the current or default profile image -->
<div class="col-md-4 text-center">
    <img id="profilePic" src="<?php echo $imagePath; ?>" alt="Profile Picture" class="profile-pic mb-2 object-fit-cover" style="max-width: 200px;">
    <div class="col-md-12 mb-1 d-flex justify-content-center align-items-center text-center" style="height: 80px;">
        <button type="button" class="btn border border-dark-subtle" id="editBtn">Edit</button>
    </div>

    <!-- Form to submit the profile picture -->
    <form method="POST" enctype="multipart/form-data">
        <!-- Hidden File Input for Image Selection -->
        <input type="file" id="fileInput" name="profilePic" accept="image/*" style="display: none;" onchange="changeProfilePic(event)">
        
        <!-- Input field for account_id -->
        <input type="text" name="account_id" value="<?php echo $account_id; ?>"> <!-- Hidden input for account_id -->

        <!-- Insert Button to Submit the Form -->
        <button type="submit" class="btn btn-primary" id="uploadBtn" style="display: none;">Insert Image</button>
    </form>
</div>

<script>
    // Function to trigger file input when the 'Edit' button is clicked
    document.getElementById('editBtn').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    // Function to change the profile picture
    function changeProfilePic(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Update the src of the profile image with the selected file
                document.getElementById('profilePic').src = e.target.result;
                // Show the insert button after selecting an image
                document.getElementById('uploadBtn').style.display = 'inline-block';
            };
            reader.readAsDataURL(file); // Read the selected file as a data URL
        }
    }
</script>

</body>
</html>
