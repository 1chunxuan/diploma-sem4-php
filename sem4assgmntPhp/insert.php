<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<?php
include'helper2.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = trim($_POST['name']);
    $arriveDate = trim($_POST['arriveDate']);
    $seatNum = trim($_POST['seatNum']);
    $petAmount = trim($_POST['petAmount']);
    $petTypes=trim($_POST['petTypes']);
    var_dump($_POST);
   /* $pattern="/[A-Z]{3}[0-9]{3}/";
  if (!preg_match($pattern, $seatNum)) {
        $error['id_pattern'] = 'Seat Number Pattern not matched';
    }     */
    
      //check if ID is repeated
    $sql = "SELECT * from seatbooking WHERE seatNum=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $seatNum);
    $stmt->execute();
    $stmt->store_result();  
    
     if ($stmt->num_rows) {
        $error['seatNum not unique'] = 'seat number is repeated';
    }
    
    if(empty($name)|| strlen($name)>30||(!preg_match("/[a-zA-Z]+$/",$name))){
        $error['nameErr']='Name is required!';
    }
    
    if(empty($arriveDate)){
        $error['arriveDateErr']='Arrive Date is required!';
    }
    
    if(empty($petAmount)){
        $error['petAmountErr']='Pet Amount is required!';
    } 
    
    if(empty($petTypes)){
        $error['petTypesErr']='Pet Types is required!';
    } 
    
    if (isset($error)) {
        echo '<div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Warning!</h4>
  <ul class="mb-0">';
        foreach ($error as $e => $t) {
            echo "<li>$t</li>";
        }
        echo '</ul></div>';
    } else {
        $sql = "INSERT INTO seatbooking (name,arriveDate,seatNum,petAmount,petTypes) 
                 VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssis', $name, $arriveDate, $seatNum, $petAmount,$petTypes);
        if ($stmt->execute()) {
            echo '<div>
       <h4>Success!</h4>';
            echo "Customer <strong>$name</strong> has been inserted.</div>";
        } else {
            echo '<div class="alert alert-dismissible alert-warning">
  <h4>Warning!</h4>
  <ul>';
            echo"<li>Database Insert error!</li>";
            echo '</ul></div>';
        }
    }

}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Insert seat booking</title>
        <link href="bootstrap.min.css" rel="stylesheet">
        <style>
            body{
                background-color: yellow;
                    margin:10px;
            }
        </style>
    </head>
    <body>
        <h1>Insert seat booking</h1>
        <p>Please enter the following details</p>
        <form action='<?= $_SERVER['PHP_SELF'] ?>' method='POST' autocomplete="on">
            <table>
                <tr>
                    <td>
                        <label for="Name">Name:</label><br>
                    </td>
                    <td>
                        <input type="text" id="name" name="name" maxlength='30' ><br>
                    </td>          
                </tr>
                <tr>
                    <td>
                        <label for="arriveDate">arrive Date(format:dd-mm-yyyy):</label><br>
                    </td>    
                    <td>
                        <input type="text" id="arriveDate" name="arriveDate" >
                    </td>
                </tr>
                <tr>
                    <td><label for='seatNum'>seat Number(A-Z)(1-100):</label></td>
                    <td><input type="text" id="seatNum" name="seatNum" required></td>
                </tr>
                <tr>
                    <td><label for="petAmount">How many pet are you going to bring with you(max 4)?</label></td>
                    <td>
                        <select id="petAmount" name="petAmount" required>
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="petTypes">What are the types of pets you are going to bring(eg:dog)?</label></td>
                </tr>
                <tr>
                    <td><input type="textarea" id="petTypes" name="petTypes"></td>
                </tr>

            </table>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
            </form>
        <?php
        echo "<h2>Your Input:</h2>";
        echo $name;
        echo "<br>";
        echo $arriveDate;
        echo "<br>";
        echo $seatNum;
        echo "<br>";
        echo $petAmount;
        echo "<br>";
        echo $petTypes;
        echo "<br>";
        ?>
       
    </body>
</html>
