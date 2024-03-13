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
include 'helper1.php';
include 'header.php';

$c1='StudentID';
$c2='StudentName';
$c3='Gender';
$c4='Program';

$p = $_GET['p']??null;

$sql = "SELECT $c1, $c2, $c3, $c4 FROM student ";
$sql .= $p?"WHERE $c4 = '$p'":null;
$result = $conn->query($sql);

?>
<div>
    Filter : 
    <a href="<?= $_SERVER['PHP_SELF'] ?>">All Programs</a> |
    <a href="<?= $_SERVER['PHP_SELF'].'?p=FT' ?>">FT</a> |
    <a href="<?= $_SERVER['PHP_SELF'].'?p=IS' ?>">IS</a>
</div>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
<?php
//list-student.php
$page_title = 'List Student';
include 'helper1.php';
include 'header.php';

$c1 = 'StudentID';
$c2 = 'StudentName';
$c3 = 'Gender';
$c4 = 'Program';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['delete']) {
    $checked = array_key_exists('checked', $_POST) ? $_POST['checked'] : '';

    //check for items in checked[]
    if (empty($checked)) {
        $error['checked'] = 'No items checked.';
    }
    
    if (isset($error)) {
        alert('warning', $error);
    } else {
        $sql = "DETELE FROM student WHERE StudentID IN (".implode(",",$id).")";
    }
}





$p = $_GET['p'] ?? null;

$sql = "SELECT $c1, $c2, $c3, $c4 FROM student ";
$sql .= $p ? "WHERE $c4 = '$p'" : null;
$result = $conn->query($sql);
?>
<div>
    Filter : 
    <a href="<?= $_SERVER['PHP_SELF'] ?>">All Programs</a> |
    <a href="<?= $_SERVER['PHP_SELF'] . '?p=FT' ?>">FT</a> |
    <a href="<?= $_SERVER['PHP_SELF'] . '?p=IS' ?>">IS</a>
</div>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
<?php
if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>"
    . "<tr>"
    . "<th></th>"
    . "<th>Student ID</th>"
    . "<th>Student Name</th>"
    . "<th>Gender</th>"
    . "<th>Program</th>"
    . "<th></th>"
    . "</tr>";

    while ($row = $result->fetch_assoc()) {
        $g = getGender($row[$c3]);
        $p = getProgram($row[$c4]);
        echo "<tr>"
        . "<td><input type='checkbox' name='checked[]' value='$row[$c1]' class='form-check-input'>"
        . "<td>$row[$c1]</td>"
        . "<td>$row[$c2]</td>"
        . "<td>$g</td>"
        . "<td>$row[$c4] - $p</td>"
        . "<td><a href='edit-student.php?id=$row[$c1]' class='btn btn-warning'>Edit</a> "
        . "<a href='delete-student.php?id=$row[$c1]' class='btn btn-danger'>Delete</a></tr>";
    }
    echo "<tr><td colspan=5>$result->num_rows record(s) returned. </td>";
    echo "<td><a href='insert-student.php' class='btn btn-primary'>Insert</a></td></tr>";
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();

// put your code here
?>
    <input type="submit" value="Delete Selected" name="delete" class="btn btn-danger">
    <input type="reset" value="Clear Checkbox" class="btn btn-outline-secondary">
</form>
</body>
</html>

