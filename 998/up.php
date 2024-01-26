<!DOCTYPE html>
<html>
<head>
    <title>หน้ารวมไฟล์</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #container {
            width: 60%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        li:last-child {
            border-bottom: none;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .file-checkbox {
            margin-right: 10px;
        }
        #back-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: block;
        }
        #back-btn:hover {
            background-color: #0056b3;
        }
        button[type="submit"] {
    display: block;
    width: 100%;
    margin: 20px auto;
    text-align: center;
    padding: 10px;
    background-color: #3498DB; /* เปลี่ยนสีพื้นหลัง */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #6495ED; /* เปลี่ยนสีเมื่อ hover */
}

    </style>
</head>
<body>

<div id="container">
    <h1>รายการไฟล์ทั้งหมดในโฟลเดอร์</h1>

    <form action="process.php" method="post">
        <ul>
            <?php

            include("snow.php");
            // กำหนดโฟลเดอร์ที่ต้องการสแกนไฟล์
            $directory = "."; // เริ่มต้นที่โฟลเดอร์ปัจจุบัน

            // สแกนไฟล์ในโฟลเดอร์
            $files = scandir($directory);

            // วนลูปผ่านไฟล์ทั้งหมด
            foreach($files as $file) {
                // ตรวจสอบว่าเป็นไฟล์จริง ๆ และไม่ใช่ . หรือ ..
                if(is_file($directory . "/" . $file) && $file != "." && $file != "..") {
                    echo "<li>";
                    echo "<input type='checkbox' class='file-checkbox' name='selected_files[]' value='" . $file . "'>";
                    echo "<a href='" . $file . "'>" . $file . "</a>";
                    echo "</li>";
                }
            }
            ?>
        </ul>

        <button type="submit">จัดลำดับไฟล์ที่เลือก</button>
    </form>

    <!-- ปุ่มกลับ -->
    <a id="back-btn" href="javascript:history.go(-1)">กลับ</a>
</div>

</body>
</html>
