<html>
<body>
<?php
$con = mysqli_connect("localhost", "root", "");

// Check connection
if (!$con) {
    die("Could not connect: " . mysqli_error($con));
}

// Select the database
mysqli_select_db($con, "library");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use mysqli_real_escape_string to prevent SQL injection
    $book_id = mysqli_real_escape_string($con, $_POST['book_id']);
    $book_name = mysqli_real_escape_string($con, $_POST['book_name']);

    // Execute the SQL query
    $sql = "INSERT INTO book (book_id, book_name) VALUES ('$book_id', '$book_name')";
    if (mysqli_query($con, $sql)) {
        echo "1 record added!<br /><br />";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
} else {
    echo "Invalid request method!";
}

// Close the database connection
mysqli_close($con);
?>
</body>
</html>
