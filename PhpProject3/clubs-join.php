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
        <h1>Join TARUC's Interest Clubs</h1>
        <form action='clubs-result.php' method='POST'>
        <table cellpadding='5'>
            <tr>
                <td>
                    Gender:
                </td>
                <td>
                    <input type='radio' id='Male' name='gender' value='M'>
                    <label for='Male'>Male</label>
                    <input type='radio' id='Female' name='gender' value="F">
                    <label for='Female'>Female</label>        
                </td>
            </tr>
            <tr>
                <td>
                    Name:
                </td>
                <td>
                    <input type='text' name='name' maxlength="30">
                </td>
            </tr>
            <tr>
                <td>
                    Mobile Number:
                </td>
                <td>
                    <input type='text' name='mobile' maxlength="12">
                </td>
            </tr>
            <tr>
                <td>
                    Interest Clubs:
                </td>
                <td>
                    <small>(Select 1 to 3 clubs)</small><br />
                    <?php
                    $clubs = [
                        'LD' => 'Ladies Club',
                        'GT' => 'Gentlemen Club',
                        'DT' => 'DOTA and Gaming Club',
                        'MG' => 'Manga and Comic Club',
                        'PT' => 'Pet Society Club',
                        'FV' => 'Farmville Club',
                    ];
                    foreach ($clubs as $v => $t) {
                        echo "<input type='checkbox' id='$v' name='clubs[]' value='$v'>";
                        echo "<label for='$v'>$t</label><br />";
                    }
                    
                    ?>
                </td>
            </tr>
        </table>
            <input type='submit'>
            <input type='reset'>
        </form>
    </body>
</html>
