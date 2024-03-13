<?php
session_start()
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <body>
        <h1>
            View Message
        </h1>
        <ul>
        <?php foreach($_SESSION['msg'] as $msg) {
            echo "<li>$msg</li>";
        } ?>
        </ul>
        <a href="add-message.php">Add</a>
    </body>
</html>

