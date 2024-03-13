<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include'helper2.php';
        
$c1='custId';
$c2='name';
$c3='arriveDate';
$c4='seatNum';
$c5='petAmount';
$c6='petTypes';

$p = $_GET['p'] ?? null;
$sql = "SELECT $c1, $c2, $c3, $c4,$c5,$c6 FROM seatbooking ";
$sql .= $p?"WHERE $c6 = '$p'":null;
$result = $conn->query($sql);
        ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
<?php
if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>"
    . "<tr>"
    . "<th></th>"
    ."<th>Customer id</th>"
    . "<th>Name</th>"
    . "<th>arrive Date</th>"
    . "<th>Seat Num</th>"
    . "<th>pet amount</th>"
    . "<th>Pet Types</th>"
    . "<th></th>"
    . "</tr>";

    while ($row = $result->fetch_assoc()) {
        $n= getPetAmount($row[$c4]);
        echo "<tr>"
        . "<td><input type='checkbox' name='checked[]' value='$row[$c1]' class='form-check-input'>"
        . "<td>$row[$c1]</td>"
        . "<td>$row[$c2]</td>"
        . "<td>$row[$c3]</td>"
        . "<td>$row[$c4]</td>"
        . "<td>$row[$c5]</td>"
        . "<td>$row[$c6]</td>"
        . "<td><a href='edit.php?custId=$row[$c1]' '>Edit</a> "
        . "<a href='delete.php?custId=$row[$c1]' '>Delete</a></tr>";

    }

}
?>
            <a href="insert.php">insert customer seat booking</a>
            <a href="login(1).php">login as admin</a>
            <a href="login.php">user login</a>
            <a href="register.php"></a>
            <a href="seatList.php">show customer seat list</a>
            <a href="viewOrderTicket.php"></a>
 
        
    </body>
</html>
