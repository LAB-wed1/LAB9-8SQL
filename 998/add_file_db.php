<meta charset="UTF-8">
<?php
include('connect.php');

// เชื่อมต่อ database:
$fileupload = $_POST['fileupload']; // รับค่าไฟล์จากฟอร์ม

// ฟังก์ชั่นวันที่
date_default_timezone_set('Asia/Bangkok');
$date = date("Ymd");

// ฟังก์ชั่นสุ่มตัวเลข
$numrand = (mt_rand());

// เพิ่มไฟล์
$upload = $_FILES['fileupload'];
if ($upload <> '') { // not select file
    // โฟลเดอร์ที่จะ upload file เข้าไป
    $path = "fileupload/";

    // เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
    $type = strrchr($_FILES['fileupload']['name'], ".");

    // ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
    $newname = $date.$numrand.$type;
    $path_copy = $path.$newname;
    $path_link = "fileupload/".$newname;

    // คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
    move_uploaded_file($_FILES['fileupload']['tmp_name'], $path_copy);
}

// เพิ่มไฟล์เข้าไปในตาราง uploadfile
$sql = "INSERT INTO uploadfile (fileupload) VALUES ('$newname')";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error());
mysqli_close($con);

// JavaScript แสดงการ upload file
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('Upload File Successfully');";
    echo "window.location = 'form.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Error back to upload again');";
    echo "window.location = 'form.php'; ";
    echo "</script>";
}

// Include the connection file
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileupload'])) {
    $file_name = $_FILES['fileupload']['name'];
    $file_tmp = $_FILES['fileupload']['tmp_name'];
    
    // Check if file already exists
    if (file_exists("fileupload/" . $file_name)) {
        echo "Sorry, file already exists.";
    } else {
        // Move uploaded file to upload directory
        move_uploaded_file($file_tmp, "fileupload/" . $file_name);

        // Insert file details into database
        $insert_query = "INSERT INTO uploadfile (fileupload) VALUES ('$file_name')";
        mysqli_query($con, $insert_query);

        echo "File uploaded successfully.";
    }
}
    ?>
