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
//list-student.php
$page_title = 'List Student';
include 'helper.php';
include 'header.php';

$sql = "SELECT StudentID, StudentName, Gender, Program FROM student";
$result = $conn->query($sql);
$c1='StudentID';
$c2='StudentName';
$c3='Gender';
$c4='Program';
if ($result->num_rows > 0) {
    echo "<table class='table table-striped'><tr><th>Student ID</th><th>Student Name</th><th>Gender</th><th>Program</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $g = getGender($row[$c3]);
        $p = getProgram($row[$c4]);
        echo "<tr><td>$row[$c1]</td><td>$row[$c2]</td>"
           . "<td>$g</td><td>$row[$c4] - $p</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();

// put your code here
?>
    </body>
</html>

  
