<?php include "connect.php";
    $username = $_GET["name"];
    $conn = mysqli_connect("localhost", "root", "","blueshop");
        // if ($conn) {
        //     mysql_select_db("blueshop");
        //     mysql_query("SET NAMES utf8");
        // } else {
        //     echo mysql_errno();
        // }
    $sql = "SELECT * FROM member WHERE username LIKE '%$username%'";
    $objQuery = mysqli_query($conn,$sql);
?>
<table border="1">
    <?php while($row = mysqli_fetch_array($objQuery)): ?>
    <tr>
        <td>
            <a href="name.php?username=<?php echo $row["username"]?>">
            <?php echo$row["username"]?>
            </a>
        </td>
        <td>
            <?php echo $row["address"]?>
        </td>
        <td>
            <img src="member_photo/<?php echo $row["username"] ?>.jpg" width="100">
        </td>
        <td>
            <?php echo $row["mobile"]?>
        </td>
        <td>
            <?php echo $row["email"]?>
        </td>
    </tr>
    <?php endwhile;?>
</table>