<?php include "connect.php" ?>
<?php
    $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ?");
    $stmt->bindParam(1, $_GET["username"]);
    $stmt->execute();
    $row = $stmt->fetch();
?>
<html>
<head><meta charset="utf-8"></head>
<body>
    <form action="edit-member.php" method="post" enctype="multipart/form-data">
    username : <input type="text" name="username" value="<?=$row["username"]?>"><br>
    password : <input type="text" name="password" value="<?=$row["password"]?>"><br>
    ชื่อสมาชิก : <input type="text" name="name" value="<?=$row["name"]?>"><br>
    ที่อยู่ : <input type="text" name="address" value="<?=$row["address"]?>"><br>
    เบอร์โทร : <input type="textarea" name="mobile" value="<?=$row["mobile"]?>"><br>
    อีเมล์ : <input type="textarea" name="email" value="<?=$row["email"]?>"><br>
    <input type="file" name="image" id="image"><br>
    <input type="submit" value="แก้ไขข้อมูล">
    </form>
</body>
</html>