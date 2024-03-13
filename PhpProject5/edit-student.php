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
//edit-student.php
$page_title = 'Edit Student';
include 'helper.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD']=='POST') {
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $gender = array_key_exists('gender', $_POST)?$_POST['gender']:'';
    $program = $_POST['program'];
    
    if(empty($name) || strlen($name) > 30) {
        $error['name'] = 'Please insert a name within 30 characters.';
    }
    if(empty($gender)) {
        $error['gender'] = 'Please select a gender.';
    }
    if(empty($program)) {
        $error['program'] = 'Please select a program.';
    }
    
    if(isset($error)) {
        echo '<div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Warning!</h4>
  <ul class="mb-0">';
        foreach ($error as $e => $t) {
            echo "<li>$t</li>";
        }
        echo '</ul></div>';
    } else {
 $sql = "UPDATE student SET StudentName = ?, Gender = ?, Program = ? WHERE StudentID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $name, $gender, $program, $id);
        if ($stmt->execute()) {
            echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-success">Success!</h4>';
            echo "Student <strong>$name</strong> has been updated.</div>";
        } else {
            echo '<div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Warning!</h4>
  <ul>';
            echo"<li>Database update error!</li>";
            echo '</ul></div>';
        }
    }
    
} else { // GET Method
    $id = trim($_GET['id']);
    $sql = "SELECT * from student WHERE StudentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows) {
        $row = $result->fetch_assoc();
        $name = $row['StudentName'];
        $gender = $row['Gender'];
        $program = $row['Program'];
    }
}

?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <table class="table table-hover">
        <tr>
            <th>Student ID :</th>
            <td><?= $id ?><input class='form-control' type="hidden" name="id" value='<?= $id ?>'></td>
        </tr>
        <tr>
            <th>Student Name :</th>
            <td><input class='form-control' type="text" name="name" maxlength="30"
                       value='<?= $name??'' ?>'></td>
        </tr>
        <tr>
            <th>Gender :</th>
            <td>
                <?php
                $g = getGenderList();
                foreach ($g as $v => $t) {
                    echo "<input class='form-check-input' type='radio' name='gender' value='$v' id='$v'";
                    echo $v==$gender?"checked":"";
                    echo "><label class='form-check-label' for='$v'>$t</label>";
                }
                ?>
            </td>
        </tr>
        <tr>
            <th>Program :</th>
            <td>
                <select class='form-select' name="program" id='programs'>
                    <option value=''>-- Select One --</option>
                    <?php
                    $p = getProgramList();
                    foreach ($p as $v => $t) {
                        echo "<option value='$v'";
                        echo $v==$program?"selected":"";
                        echo ">$t</option>";
                    }
                        ?>                   
                </select>
            </td>
        </tr>
    </table>
    <input type='submit' class='btn btn-primary'>
    <a href='list-student.php' class='btn btn-outline-secondary'>Cancel</a>
</form>

