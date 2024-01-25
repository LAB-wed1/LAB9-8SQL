<?php
include("snow.php");

// 1) Connect to the server
$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die("Could not connect: " . mysqli_error($con));
}
mysqli_set_charset($con, "utf8");

// 2) Select the database
mysqli_select_db($con, "library");

// 3) Get the book_id to be deleted
$book_id = isset($_GET['id']) ? $_GET['id'] : '';

// 4) Check if book_id is not empty before proceeding
if (!empty($book_id)) {
    // 5) Build and execute the SQL query
    $sql = "DELETE FROM book WHERE book_id = $book_id";
    $result = mysqli_query($con, $sql);

    // 6) Check if the query was successful
    if ($result) {
        echo "Deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    echo "Invalid book ID";
}

// 7) Close the database connection
mysqli_close($con);
?>
