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
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $gender = $_POST['gender'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $clubs = $_POST['clubs'];
            
            $prefix = $gender=='M'?'Mr':'Ms';
            function getClub($c) {
                switch($c) {
                    case 'LD': 
                        return 'Ladies Club';
                    case 'GT':
                        return 'Gentlemen Club';
                    case 'DT':
                        return 'DOTA and Gaming Club';
                    case 'MG':
                        return 'Manga and Comic Club';
                    case 'PS':
                        return 'Pet Society Club';
                    case 'FV':
                        return 'Farmville Club';
                }
            }
            
            echo "<h1>Thanks for Joining</h1>";
            echo "<h2>$prefix. $name</h2>";
            echo "You have joined the following clubs:";
            echo "<ul>";
            foreach ($clubs as $c) {
                $club = getClub($c);
                echo "<li>$club ($c)</li>";
            }
            echo "</ul>";
        }
        ?>
    </body>
</html>

