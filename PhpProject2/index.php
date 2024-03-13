<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date =  date("d-F-Y H:i:s A");
        echo "<h1>$date</h1>";
        
        $s1 = 'INVALID-ID';
        $s2 = '1234567890';
        $s3 = '00XXX12345';
        $s4 = '00WAD12345';
        $pattern = "/\d\d[ACJPSW][ABPHT][ABCDP][0-9]{5}/";
        $mat = "Matched<br>";
        $not = "Not matched<br>";
        echo "<pre>$s1 = ";
        echo preg_match($pattern,$s1)?$mat:$not;
        echo "$s2 = ";
        echo preg_match($pattern,$s2)?$mat:$not;
        echo "$s3 = ";
        echo preg_match($pattern,$s3)?$mat:$not;
        echo "$s4 = ";
        echo preg_match($pattern,$s4)?$mat:$not;
        echo "</pre>";
        ?>
        <table>
            <tr bgcolor="#cccccc">
                <th>COURSE</th>
                <th>PASSING RATE</th>
            </tr>
        <?php
        $data = ['AACS3013'=>70,'AACS3073'=> 95,
            'AAMS3683'=> 55,'AACS3034'=> 75,'AHLA3413'=> 65];
        foreach ($data as $key => $value) {
            $span = '<span style="display: inline-block;
background-color: ';
            $span .= $value>=70?'lightblue':'pink';
            $span .= ';width: ';
            $span .= $value*5;
            $span .= 'px">&nbsp;</span>';
            echo "<tr><td>$key</td><td>$span$value%</td></tr>";
        }
        ?>
        </table>
    </body>
</html>
