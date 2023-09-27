<?php include "connect.php" ?>
<html>
<head>
    <meta charset="utf-8">
    <script>
    function confirmDelete(username) { // ฟังก์ชันจะถูกเรียกถ้าผู้ใช้คลิกที่ link ลบ
        var ans = confirm("ต้องการลบผู้ใช้" + username); // แสดงกล่องถามผู้ใช ้
        if (ans==true) // ถ้าผู้ใช้กด OK จะเข้าเงื่อนไขนี้
            document.location = "delete.php?username=" + username; // ส่งรหัสผู้ใช ้ไปให ้ไฟล์ delete.php
    }
    </script>
</head>
<body>
<?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "username : " . $row ["username"] . "<br>";
        echo "ชื่อสมาชิก : " . $row ["name"] . "<br>";
        echo "ที่อยู่ : " . $row ["address"] . "<br>";
        echo "อีเมล์ : " . $row ["email"] . "<br>";
        echo "<a href='#' onclick='confirmDelete(`{$row["username"]}`)'>ลบ</a>";
        echo "<hr>\n";
    }
?>
</body>
</html>