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
//delete-student.php
$page_title = 'Delete details';
include 'helper2.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
       $custId = trim($_GET['custId']);

    
    $sql = "DELETE FROM seatbooking WHERE custId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $custId);

    if ($stmt->execute()) {
        echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-success">Success!</h4>';
        echo "Student has been deleted."
        . "<a href='seatList.php' class='btn btn-primary'>Back to List</a></div>";
    } else {
        echo '<div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Warning!</h4>
  <ul>';
        echo"<li>Database update error!</li>";
        echo '</ul></div>';
    }
} else {
    $custId = $_GET['id'] ?? 'whee';

    $sql = "SELECT * FROM seatbooking WHERE custId= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $custId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $arriveDate = $row['arriveDate'];
        $seatNum = $row['seatNum'];
        $petAmount=$row['petAmount'];
        $petTypes=$row['petTypes'];    
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <p>Are you sure you want to delete the following customer details?</p>
        <table>
            <tr>
                <th>customer ID :</th>
                <td><?php echo $custId; ?>
                    </td>
            </tr>
            <tr>
                <th>Name :</th>
                <td><?= $name ?>
                    <input type="hidden" name="name" 
                           value="<?= $name ?>"></td>
            </tr>
            <tr>
                <th>arrive date :</th>
                <td><?= $arriveDate ?>
                    <input type="hidden" name="arriveDate" 
                           value="<?= $arriveDate ?>"></td>
            </tr>
            <tr>
                <th>seat number :</th>
                <td><?= $seatNum ?>
                    <input type="hidden" name="seatNum" 
                           value="<?= $seatNum ?>"></td>
            </tr>
            <tr>
                <th>pet amount :</th>
                <td><?= $petAmount ?>
                    <input type="hidden" name="petAmount" 
                           value="<?= $petAmount ?>"></td>
            </tr>
            <tr>
                <th>Pet Types:</th>
                <td><?= $petTypes?>
                    <input type="hidden" name="petTypes" 
                           value="<?= $petTypes ?>"></td>
            </tr>
        </table>
        <input type="submit" class="btn btn-primary" value="Yes">
        <a href="list-student.php" class="btn btn-outline-secondary">Cancel</a>
    </form>
<?php    
}

