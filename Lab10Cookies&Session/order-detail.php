<?php 
    include "connect.php";
    session_start(); 
?>

<html>
<body>
<?php 
    if (empty($_SESSION["username"]) || !$_SESSION["admin"]) { 
        header("location: login-form.php");
    }
    
    $stmt = $pdo->prepare(
        "SELECT item.ord_id,orders.ord_date,pname,pdetail,quantity,price,price*quantity total 
        FROM member JOIN orders ON member.username=orders.username 
        JOIN item ON orders.ord_id = item.ord_id 
        JOIN product ON item.pid = product.pid 
        where member.username = ?;"
        
    );
    $stmt->bindParam(1, $_GET["username"]);
    $stmt->execute();

    if($row = $stmt->fetch()==null){
        echo "ลูกค้าท่านนี้ไม่มีออเดอร์";
    }

    echo "<h1>{$_GET['username']}</h1>";
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
</body>
</html>