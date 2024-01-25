<?php
if(isset($_GET['file'])) {
    $fileToDelete = $_GET['file'];
    if (unlink($fileToDelete)) {
        echo "ลบไฟล์ $fileToDelete เรียบร้อยแล้ว";
    } else {
        echo "ไม่สามารถลบไฟล์ $fileToDelete ได้";
    }
} else {
    echo "ไม่ได้ระบุไฟล์ที่ต้องการลบ";
}
?>
