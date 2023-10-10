<?php 
    include "connect.php";
    session_start(); 
?>

<html>
<head>
    <style>
        table,tr,td,th{
            border:1px solid black;
            border-collapse:collapse;
            text-align:center;
        }
    </style>
</head>
<body>
<h1>สวัสดี <?=$_SESSION["fullname"]?></h1>
<?php 
    if (empty($_SESSION["username"])) { 
        header("location: login-form.php");
    }
?>

<?php 
    if($_SESSION["admin"]){

        echo "<a href='product-list.php'>ดูหน้าสินค้าคงเหลือ</a>";
        $stmt = $pdo->prepare(
            "SELECT member.username,COUNT(orders.ord_id) total_order FROM member 
            LEFT JOIN orders ON member.username = orders.username 
            GROUP BY member.username ORDER BY orders.ord_id DESC;"
        );

       $stmt->execute();
?>
    <table style="margin-top:20px">
        <tr>
            <th>Username</th>
            <th>จำนวนออเดอร์</th>
            <th>รายละเอียดออเดอร์</th>
        </tr>
        
<?php
       while($row = $stmt->fetch()){
        echo "
            <tr>
            <td>{$row["username"]}</td>
            <td>{$row["total_order"]}</td>
            <td><a href='order-detail.php?username={$row["username"]}'>คลิกดูรายละเอียด</a></td>
            </tr>
        ";
        
       }
    }
?>
    </table>

<?php
    
    $stmt = $pdo->prepare(
        "SELECT item.ord_id,orders.ord_date,pname,pdetail,quantity,price,price*quantity total 
        FROM member JOIN orders ON member.username=orders.username 
        JOIN item ON orders.ord_id = item.ord_id 
        JOIN product ON item.pid = product.pid 
        where member.username = ?;"
        
    );
    $stmt->bindParam(1, $_SESSION["username"]);
    $stmt->execute();
    while($row = $stmt->fetch()){
        echo "
            <div>หมายเลขออร์เดอร์ : {$row["ord_id"]}</div>
            <div>วันที่ : {$row["ord_date"]}</div>
            <div>ชื่อสินค้า :{$row["pname"]}</div>
            <div>รายละเอียดสินค้า :{$row["pdetail"]}</div>
            <div>จำนวน :{$row["quantity"]}</div>
            <div>ราคาต่อชิ้น :{$row["price"]}</div>
            <div>ราคารวม :{$row["total"]}</div>
            <hr>
        ";
        
       }
?>
หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>


</body>
</html>
