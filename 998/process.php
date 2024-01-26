<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการไฟล์ที่เลือก</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        #container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .back-btn {
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
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div id="container">
    <?php

    include("snow.php");
    if(isset($_POST['selected_files'])) {
        $selectedFiles = $_POST['selected_files'];

        echo "<h1> Star:</h1>";
        echo "<table>";
        echo "<tr><th>ลำดับ</th><th>ชื่อไฟล์</th><th>ลบ</th></tr>";
        $count = 1;
        foreach ($selectedFiles as $file) {
            echo "<tr>";
            echo "<td>" . $count . "</td>";
            echo "<td><a href='" . $file . "'>" . $file . "</a></td>";
           echo "<td><button class='delete-btn' onclick='deleteFile(this)' data-file='" . $file . "'>ลบ</button></td>";

            echo "</tr>";
            $count++;
        }
        echo "</table>";
    } else {
        echo "<p>ไม่มีไฟล์ที่ถูกเลือก</p>";
    }
    ?>
    
    <a class="back-btn" href="javascript:history.go(-1)">กลับ</a>
</div>

<script>
    function deleteFile(button) {
        var fileToDelete = button.getAttribute('data-file');
        if (confirm('คุณต้องการลบไฟล์ ' + fileToDelete + ' หรือไม่?')) {
            button.parentNode.parentNode.remove(); // ลบแถวที่มีปุ่มลบนี้ (โดยหากลับไปที่ Element tr แล้วลบ)
        }
    }
</script>


</body>
</html>
