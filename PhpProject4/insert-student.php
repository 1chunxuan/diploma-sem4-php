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

if($_SERVER['REQUEST_METHOD']=='POST') {
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $gender = $_POST['gender'];
    $program = $_POST['program'];
    
    //error checking
    $error = [];
    //check if ID is in the right format
    $pattern = "/\d\d[A-Z]{3}[0-9]{5}/";
    if(!preg_match($pattern,$id)) {
        $error['id_pattern']='ID Pattern not matched';
    }
    //check if ID is repeated
    $sql = "SELECT * from student WHERE StudentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows) {
        $error['id not unique'] = 'ID is repeated';
    }
    if(empty($name)||strlen($name)>30)
    {
        
    }
    var_dump($error);
    
}

?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
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
