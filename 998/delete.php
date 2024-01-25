<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
 <?php
 $con = mysqli_connect("localhost", "root", "");

// Check the connection
if (!$con) {
    die("Could not connect: " . mysqli_connect_error());
}

mysqli_select_db($con, "library");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the book_id from the form
    $book_id = $_POST["book_id"];

    // SQL query to delete the record
    $sql = "DELETE FROM book WHERE book_id = '$book_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        echo "1 record deleted.";
    } else {
        // Display the error message
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Form not submitted.";
}

// Close the database connection
mysqli_close($con);
 ?>
</body>
</html>
