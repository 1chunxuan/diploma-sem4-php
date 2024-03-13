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
$page_title = 'Delete Student';
include 'helper1.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);

    $sql = "DELETE FROM student WHERE StudentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id);
    if ($stmt->execute()) {
        echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-success">Success!</h4>';
        echo "Student <strong>$name</strong> has been deleted."
        . "<a href='list-student.php' class='btn btn-primary'>Back to List</a></div>";
    } else {
        echo '<div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Warning!</h4>
  <ul>';
        echo"<li>Database update error!</li>";
        echo '</ul></div>';
    }
} else {
    $id = $_GET['id'] ?? '';

    $sql = "SELECT * FROM student WHERE StudentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['StudentName'];
        $gender = $row['Gender'];
        $program = $row['Program'];
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <p>Are you sure you want to delete the following student?</p>
        <table class="table table-hover">
            <tr>
                <th>Student ID :</th>
                <td><?= $id ?>
                    <input type="hidden" name="id" 
                           value="<?= $id ?>"></td>
            </tr>
            <tr>
                <th>Name :</th>
                <td><?= $name ?>
                    <input type="hidden" name="name" 
                           value="<?= $name ?>"></td>
            </tr>
            <tr>
                <th>Gender :</th>
                <td><?= getGender($gender) ?></td>
            </tr>
            <tr>
                <th>Program :</th>
                <td><?= $program . ' - ' . getProgram($program) ?>
                </td>
            </tr>
        </table>
        <input type="submit" class="btn btn-primary" value="Yes">
        <a href="list-student.php" class="btn btn-outline-secondary">Cancel</a>
    </form>
<?php    
}


