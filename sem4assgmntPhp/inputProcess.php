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
if(isset($_POST['save']))
{	 
	 $name = $_POST['name'];
	 $arriveDate = $_POST['arriveDate'];
	 $seatNum = $_POST['seatNum'];
	 $petAmount = $_POST['petAmount'];
         $petTypes=$_POST['petTypes'];
	 $sql = "INSERT INTO seatbooking (name,arriveDate,seatNum,petAmount,petTypes)
	 VALUES ('$first_name','$last_name','$city_name','$email')";
	 if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>
    </body>
</html>
