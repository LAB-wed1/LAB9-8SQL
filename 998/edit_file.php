<?php
// Include the connection file
include('connect.php');

// Check if the form is submitted for file edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $newFilename = $_POST['new_filename'];
        $oldFilename = $_POST['old_filename'];

        // Escape user inputs to prevent SQL injection
        $newFilename = mysqli_real_escape_string($con, $newFilename);
        $oldFilename = mysqli_real_escape_string($con, $oldFilename);

        // Update the filename in the database
        $updateQuery = "UPDATE uploadfile SET fileupload = '$newFilename' WHERE fileupload = '$oldFilename'";
        mysqli_query($con, $updateQuery);

        // Construct the old and new file paths
        $oldFilepath = 'fileupload/' . $oldFilename;
        $newFilepath = 'fileupload/' . $newFilename;

        // Rename the file on the server
        if (file_exists($oldFilepath)) {
            rename($oldFilepath, $newFilepath);
        }

        // Redirect back to the main page
        header("Location: main_page.php");
        exit();
    }
}

// Retrieve the filename from the URL parameter
if (isset($_GET['filename'])) {
    $filenameToEdit = $_GET['filename'];

    // Escape user input to prevent SQL injection
    $filenameToEdit = mysqli_real_escape_string($con, $filenameToEdit);

    // Query data from the database for the selected file
    $query = "SELECT * FROM uploadfile WHERE fileupload = '$filenameToEdit'";
    $result = mysqli_query($con, $query);

    // Check if the query was successful and returned a result
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
?>
        <form action="" method="post">
            <table width="500" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                    <td align="right">Old Filename:</td>
                    <td><?php echo htmlspecialchars($row['fileupload'], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td align="right">New Filename:</td>
                    <td><input type="text" name="new_filename" value="<?php echo htmlspecialchars($row['fileupload'], ENT_QUOTES); ?>" required /></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="old_filename" value="<?php echo htmlspecialchars($row['fileupload'], ENT_QUOTES); ?>" /></td>
                    <td colspan="2" align="center"><input type="submit" name="submit" value="Save Changes"  /></td>
                </tr>
            </table>
        </form>
<?php
    } else {
        echo "File not found in the database.";
    }
} else {
    echo "Invalid request.";
}
?>
