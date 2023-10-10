<?php
	include "connect.php";
    session_start();
    // ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
    if (empty($_SESSION["username"]) || !$_SESSION["admin"]) { 
        header("location: login-form.php");
    }
?>

<html>
<head><meta charset="utf-8"></head>
<body>
<?php
    $stmt = $pdo->prepare(
        "SELECT * FROM product;"
    );
    $stmt->execute();
    while($row = $stmt->fetch()){
        echo "
            <div>ชื่อสินค้า : {$row["pname"]}</div>
            <div>รายละเอียด : {$row["pdetail"]}</div>
            <div>ราคา :{$row["price"]}</div>
            <div>จำนวน :{$row["amount"]}</div>
            <hr>
        ";
       }
?>
</body>
</html>
