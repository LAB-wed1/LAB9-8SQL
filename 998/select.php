<html>
<body>
<?php
 // 1) เชื่อมต่อเซิร์ฟเวอร์
$con = mysqli_connect("localhost", "root", "");
if(!$con) {
 die("Could not connect: " . mysql_error());
}
echo "สัมมะเร็จ!!!<br />";
mysqli_set_charset($con,"utf8");
 // 2) ระบุฐานข้อมูล
mysqli_select_db($con, "library");
echo "สัมมะเร็จจ้า!!!<br />";
 // 3) คำสั่ง SQL เลือกแสดงข้อมูลในตาราง
$sql = "SELECT * FROM book";
$result = mysqli_query($con, $sql);
echo "สัมมะเร็จจ้าจ้า!!!<br /><br />";
 // 4) ใช้งานข้อมูล
while($row = mysqli_fetch_array($result))
 echo $row["book_id"] . " " . $row["book_name"] . "<br />";
 // 5) ปิดการเชื่อมต่อ
mysqli_close($con);
?>
</body>
</html>
