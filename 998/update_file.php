<?php
// Include the connection file
include('connect.php');

// Check if the form is submitted for file update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required form fields are set
    if (isset($_POST['submit'], $_POST['new_filename'], $_POST['old_filename'])) {
        $newFilename = $_POST['new_filename'];
        $oldFilename = $_POST['old_filename'];

        // Update the filename in the database
        $updateQuery = "UPDATE uploadfile SET fileupload = ? WHERE fileupload = ?";
        $stmt = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt, "ss", $newFilename, $oldFilename);
        mysqli_stmt_execute($stmt);

        // Check if the update was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Construct the old and new file paths
            $oldFilepath = 'fileupload/' . $oldFilename;
            $newFilepath = 'fileupload/' . $newFilename;

            // Rename the file on the server
            if (file_exists($oldFilepath)) {
                if (rename($oldFilepath, $newFilepath)) {
                    // Redirect back to the main page if successful
                    header("Location: main_page.php");
                    exit();
                } else {
                    echo "Failed to rename the file on the server.";
                }
            } else {
                echo "Old file not found on the server.";
            }
        } else {
            echo "Failed to update the filename in the database.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Required form fields are missing.";
    }
} else {
    // If the form is not submitted, redirect to the main page
    header("Location: main_page.php");
    exit();
}
?>
