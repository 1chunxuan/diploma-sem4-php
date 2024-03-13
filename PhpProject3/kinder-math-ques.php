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
        <form action="kinder-math-result.php" method="post">
        <?php
        for($i=1;$i<=5;$i++){
            $x = rand(1,9);
            $y = rand(1,9);
            $ans = $x+$y;
            echo "<label for='q{$i}'>Q{$i}. {$x} + {$y}=";
            echo "<input type='hidden' name='q{$i}' value='$ans'></input>";
            echo "<input type='text' name='a{$i}'></input><br />";
        }
        ?>    
            <input type="submit"></input>
            <input type="submit" formaction="kinder-math-ques.php" 
                   value="Re-Generate"></input> 
        </form>
        
    </body>
</html>



        
