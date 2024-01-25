<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>UPLOAD FILE</title>
</head>
<body>
<?php
// Include the connection file
include('connect.php');

// Check if the form is submitted for file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete button is clicked
    if (isset($_POST['delete'])) {
        $filenameToDelete = $_POST['delete'];

        // Construct the file path
        $filepath = 'fileupload/' . $filenameToDelete;

        // Check if the file exists before attempting to delete
        if (file_exists($filepath)) {
            // Delete file from the server
            unlink($filepath);

            // Delete file record from the database
            $deleteQuery = "DELETE FROM uploadfile WHERE fileupload = '$filenameToDelete'";
            mysqli_query($con, $deleteQuery);
        } else {
            // Handle the case where the file does not exist
            echo "File not found: $filenameToDelete";
        }
    }

    // Refresh the page after deleting to update the file list
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Query data from the database
$query = "SELECT * FROM uploadfile" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);

// Display the file upload form
?>
<form action="" method="post" enctype="multipart/form-data">
    <table border="1" align="center" width="500">
        <!-- Table header -->
        <tr align="center" bgcolor="#CCCCCC">
            <td>Filename</td>
            <td>Image</td>
            <td>Delete</td>
        </tr>

        <!-- Display uploaded files -->
        <?php
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row['fileupload']}</td>";
            echo "<td><img src='fileupload/{$row['fileupload']}' width='100'></td>";
            echo "<td><button type='submit' name='delete' value='{$row['fileupload']}'>Delete</button></td>";
            echo "</tr>";
        }
        ?>
    </table>
</form>

<!-- File upload form -->
<form action="add_file_db.php" method="post" enctype="multipart/form-data">
    <p>&nbsp;</p>
    <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td height="40" colspan="2" align="center" bgcolor="#D6D6D6">Form Upload&nbsp;File</td>
        </tr>
        <tr>
            <td width="126" bgcolor="#EDEDED">&nbsp;</td>
            <td width="574" bgcolor="#EDEDED">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" bgcolor="#EDEDED">File Browser</td>
            <td bgcolor="#EDEDED">
                <label>
                    <input type="file" name="fileupload" id="fileupload" required="required"/>
                </label>
            </td>
        </tr>
        <tr>
            <td bgcolor="#EDEDED">&nbsp;</td>
            <td bgcolor="#EDEDED">&nbsp;</td>
        </tr>
        <tr>
            <td bgcolor="#EDEDED">&nbsp;</td>
            <td bgcolor="#EDEDED"><input type="submit" name="button" id="button" value="Upload" /></td>
        </tr>
        <tr>
            <td bgcolor="#EDEDED">&nbsp;</td>
            <td bgcolor="#EDEDED">&nbsp;</td>
        </tr>
    </table>
</form>
</body>
</html>
