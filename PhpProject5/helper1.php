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
//helper.php
$servername = "localhost";
$username = "p4";
$password = "123456";
$dbname = "p4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getGenderList() {
    return ['M'=>'Male','F'=>'Female'];
}
function getGender($g) {
    $genders = getGenderList();
    if(array_key_exists($g, $genders)) {
        return $genders[$g];
    } else {
        return NULL;
    }
}
function getProgramList() {
    return ['FT'=>'Information Technology',
        'IS'=>'Information System'];
}
function getProgram($p) {
    $program = getProgramList();
    if(array_key_exists($p, $program)) {
        return $program[$p];
    } else {	
        return NULL;
    }
}
?>
    </body>
</html>
