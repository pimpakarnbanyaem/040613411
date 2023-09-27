<?php include "connect.php" ?>
<html><head><meta charset="utf-8"></head>
<body>
<form>
<input type="text" name="keyword">
<input type="submit" value="ค้นหา">
</form>
<div style="display:flex">
<?php
$stmt = $pdo->prepare("SELECT * FROM member WHERE name LIKE ?");
if (!empty($_GET))
$value = '%' . $_GET["keyword"] . '%';
$stmt->bindParam(1, $value);
$stmt->execute();
?>
<?php while ($row = $stmt->fetch()) : ?>
<div style="padding: 30px; text-align: center">
<img src='member_photo/<?=$row["username"]?>.jpg' width='100'><br>
<?=$row ["name"]?><br>
<?=$row ["email"]?><br>
<?=$row ["address"]?><br>
</div>
<?php endwhile; ?>
</div>
</body></html>