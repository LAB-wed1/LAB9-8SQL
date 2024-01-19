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

  // 3) สั่งคำสั่ง SQL
 $sql = "INSERT INTO book (book_id, book_name) VALUES('" . $_POST['book_id'] . "', '" . $_POST['book_name'] . "')";
 mysqli_query($con, $sql);
 echo "สัมมะเร็จจ้าจ้าจ้า!!!<br /><br />";

  // 5) ปิดการเชื่อมต่อ
 mysqli_close($con);

?>
</body>
</html>