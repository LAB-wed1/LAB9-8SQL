<html>
<body>
<?php
$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die("Could not connect: " . mysqli_error());
}

mysqli_select_db($con, "library");

// Check if the "action" key is set in the $_POST array
if (isset($_POST["action"])) {
    if ($_POST["action"] == "update") {
        // Update record
        $sql = "UPDATE book SET price = ? WHERE book_id = ?";
        
        $stmt = mysqli_prepare($con, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "is", $_POST["price"], $_POST["book_id"]);

        // Execute the statement
        if (!mysqli_stmt_execute($stmt)) {
            die("Error updating record: " . mysqli_error($con));
        } else {
            echo "1 record updated.";
        }
    } elseif ($_POST["action"] == "delete") {
        // Delete record
        $sql = "DELETE FROM book WHERE book_id = ?";

        $stmt = mysqli_prepare($con, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "s", $_POST["book_id"]);

        // Execute the statement
        if (!mysqli_stmt_execute($stmt)) {
            die("Error deleting record: " . mysqli_error($con));
        } else {
            echo "1 record deleted.";
        }
    } else {
        echo "Invalid action specified.";
    }
} else {
    echo "Action not set.";
}

mysqli_close($con);
?>
</body>
</html>
