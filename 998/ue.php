<html>
<body>
<?php
$con = mysqli_connect("localhost", "root", "");
if(!$con) {
 die("Could not connect: " . mysql_error());
}
mysqli_select_db($con, "library");

// คำสั่ง SQL แก้ไขข้อมูล
 $sql="UPDATE book SET price = ";
 . $_POST["price"] . " WHERE book_id = '"
 . $_POST["book_id"] . "'";

 if(!mysqli_query($sql, $con)) {
 die("Error: " . mysqli_error());
 } else {
 echo "1 record updated.";

}
mysqli_close($con);
?>
</body>
</html>