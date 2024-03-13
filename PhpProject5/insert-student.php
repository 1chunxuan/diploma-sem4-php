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
//insert-student.php
$page_title = 'Insert Student';
include 'helper.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $gender = $_POST['gender'];
    $program = $_POST['program'];
    
    
    //check if ID is in the right format
    $pattern = "/\d\d[A-Z]{3}[0-9]{5}/";
    if (!preg_match($pattern, $id)) {
        $error['id_pattern'] = 'ID Pattern not matched';
    }
    //check if ID is repeated
    $sql = "SELECT * from student WHERE StudentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows) {
        $error['id not unique'] = 'ID is repeated';
    }

    if (empty($name) || strlen($name) > 30) {
        $error['name'] = 'Please insert a name within 30 characters.';
    }

    if (empty($gender)) {
        $error['gender'] = 'Please select a gender.';
    }

    if (empty($program)) {
        $error['program'] = 'Please select a program.';
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
        $sql = "INSERT INTO student (StudentID,StudentName,Gender,Program) 
                 VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $id, $name, $gender, $program);
        if ($stmt->execute()) {
            echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-success">Success!</h4>';
            echo "Student <strong>$name</strong> has been inserted.</div>";
        } else {
            echo '<div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Warning!</h4>
  <ul>';
            echo"<li>Database Insert error!</li>";
            echo '</ul></div>';
        }
    }
}
?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <table class="table table-hover">
        <tr>
            <th>Student ID :</th>
            <td><input class='form-control' type="text" name="id" maxlength="10"></td>
        </tr>
        <tr>
            <th>Student Name :</th>
            <td><input class='form-control' type="text" name="name" maxlength="10"></td>
        </tr>
        <tr>
            <th>Gender :</th>
            <td>
                <?php
                $g = getGenderList();
                foreach ($g as $v => $t) {
                    echo "<input class='form-check-input' type='radio' name='gender' value='$v' id='$v'>";
                    echo "<label class='form-check-label' for='$v'>$t</label>";
                }
                ?>
            </td>
        </tr>
        <tr>
            <th>Program :</th>
            <td>
                <select class='form-select' name="program" id='programs'>
                    <?php
                    $p = getProgramList();
                    foreach ($p as $v => $t) {
                        echo "<option value='$v'>$t</option>";
                    }
                    ?>                   
                </select>
            </td>
        </tr>
    </table>
    <input type='submit' class='btn btn-primary'>
    <a href='list-student.php' class='btn btn-outline-secondary'>Cancel</a>
</form>

    </body>
</html>
