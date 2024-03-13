<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php include 'helper2.php'; 
var_dump($_POST);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST') {
    $custId = $_POST['custId'];        
    $name = trim($_POST['name']);
    $arriveDate= trim($_POST['arriveDate']);
    $seatNum = trim($_POST['seatNum']);
    $petAmount=$_POST['petAmount'];
    $petTypes=trim($_POST['petTypes']);
    
    if(empty($name) || strlen($name) > 30||(!preg_match("/[a-zA-Z]+$/",$name))) {
        $error['name'] = 'Please insert a name within 30 characters or only consists letter';
    }
    if(empty($arriveDate)) {
        $error['arriveDate'] = 'Please type the arrive date or make sure the date format such as dd-mm-yyyy.';
    }
    if(empty($seatNum)||(!preg_match("/[a-zA-Z][0-9]{2}+$/",$seatNum))) {
        $error['seatNum'] = 'Please type a seat.';
    }
    if(empty($petTypes)){
        $error['petTypes']='Please type your pet types.';
    }
    
    if(isset($error)) {
        echo '<div>
  <h4>Warning!</h4>
  <ul>';
        foreach ($error as $e => $t) {
            echo "<li>$t</li>";
        }
        echo '</ul></div>';
    } else {
 $sql = "UPDATE seatBooking SET name = ?, arriveDate = ?, seatNum = ?,petAmount=?,petTypes=? WHERE custId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssisi', $name, $arriveDate, $seatNum,$petAmount,$petTypes ,$custId);
        if ($stmt->execute()) {
            echo '<div >
  <h4>Success!</h4>';
            echo "Student <strong>$name</strong> has been updated.</div>";
        } else {
            echo '<div >
  <h4>Warning!</h4>
  <ul>';
            echo"<li>Database update error!</li>";
            echo '</ul></div>';
        }
    }
    
} else { // GET Method
    $custId = $_GET['custId'];
    $sql = "SELECT * from seatbooking WHERE custId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$custId);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $arriveDate = $row['arriveDate'];
        $seatNum = $row['seatNum'];
        $petAmount=$row['petAmount'];
        $petTypes=$row['petTypes'];
    }
}

?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <table>
        <tr>
            <th>Customer ID :</th>
            <td><?= $custId ?><input class='form-control' type="hidden" name="custId" value='<?= $custId ?>'></td>
        </tr>
        <tr>
            <th>Name :</th>
            <td><input class='form-control' type="text" name="name" maxlength="30"
                       value='<?= $name??'' ?>'></td>
        </tr>
        <tr>
            <th>arrive Date :</th>
            <td>
               <input class='form-control' type="text" name="arriveDate" maxlength="30"
                       value='<?= $arriveDate??'' ?>'></td>
        </tr>
        <tr>
            <th>seat number :</th>
            <td>
                 <input class='form-control' type="text" name="seatNum" maxlength="30"
                       value='<?= $seatNum??'' ?>'></td>
        </tr>
        <tr>
            <th>pet Amount :</th>
            <td>
                 <input class='form-control' type="text" name="petAmount" maxlength="30"
                       value='<?= $petAmount??'' ?>'></td>
        </tr>
         <tr>
            <th>pet Types :</th>
            <td>
                 <input class='form-control' type="text" name="petTypes" maxlength="30"
                       value='<?= $petTypes??'' ?>'></td>
        </tr>
    </table>
    <input type='submit' class='btn btn-primary'>
    <a href='list-student.php' class='btn btn-outline-secondary'>Cancel</a>
</form>

        ?>
    </body>
</html>
