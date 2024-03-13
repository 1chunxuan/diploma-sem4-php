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
        if(isset($_POST)){
            echo $_POST['q1'];
            echo $_POST['a1'];
            echo $_POST['q2'];
            echo $_POST['a2'];
            
            var_export($_POST);

        }
        
        ?>

    </body>
</html>
