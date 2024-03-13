<?php
//add-message.php
session_start();

if($_SERVER['REQUEST_METHOD']=='POST') {
    $msg = trim($_POST['msg']);
    if(is_array($_SESSION['msg'])) {
        $_SESSION['msg'] = array_merge($_SESSION['msg'],[$msg]);
    } else {
        $_SESSION['msg'] = [$msg];
    }
    $_SESSION['resp'] = 'Message is added to session.';
}
?>


<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <body>
        <h1>Add Message</h1>
        <?= $_SESSION['resp']??'' ?>
        <?php unset($_SESSION['resp']) ?>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <input type="text" name="msg" required>
            <input type="submit" value="Add">
        </form> 
        <a href="view-message.php">View</a>
    </body>
</html>

