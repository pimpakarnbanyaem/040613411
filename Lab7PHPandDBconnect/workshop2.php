<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "ชื่อสมาชิก : " . $row ["name"] . "<br>";
        echo "ที่อยู่ : " . $row ["address"] . "<br>";
        echo "อีเมล์ : " . $row ["email"] . "<br>";
        echo "<hr>\n";
    }
?>
</body>
</html>