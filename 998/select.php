<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Information</title>
</head>
<body>
<?php

include("snow.php");

// 1) เชื่อมต่อเซิร์ฟเวอร์
$con = mysqli_connect("localhost", "root", "");
if(!$con) {
    die("Could not connect: " . mysql_error());
}
echo "เชื่อมต่อสำเร็จ!!!<br />";
mysqli_set_charset($con, "utf8");

// 2) ระบุฐานข้อมูล
mysqli_select_db($con, "library");
echo "เลือกฐานข้อมูลสำเร็จ!!!<br />";

// 3) คำสั่ง SQL เลือกแสดงข้อมูลในตาราง
$sql = "SELECT * FROM book";
$result = mysqli_query($con, $sql);
echo "คิวรี่ข้อมูลสำเร็จ!!!<br /><br />";

// 4) ใช้งานข้อมูล
echo "<table border='1' cellspacing='0'>";
echo "<tr><th>Book ID</th><th>Book Name</th><th>author</th><th>publisher</th><th>price</th><th>Action</th></tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row["book_id"] . "</td>";
    echo "<td>" . $row["book_name"] . "</td>";
    echo "<td>" . $row["author"] . "</td>";
    echo "<td>" . $row["publisher"] . "</td>";
    echo "<td>" . $row["price"] . "</td>";
    echo "<td><a href='delete_book.php?id=" . $row["book_id"] . "'>Delete</a></td>";
    echo "</tr>";
}

echo "</table>";

// 5) ปิดการเชื่อมต่อ
mysqli_close($con);
?>
</body>
</html>
