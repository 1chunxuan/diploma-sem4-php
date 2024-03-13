<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
       <?php
        $pass='admin123';
        $admin1='admin';
  if($_SERVER['REQUEST_METHOD']=='POST'){
      $admin=trim($_POST['admin']);
      $password=trim($_POST['password']);
  }
  
   if(empty($admin)||$admin!=$admin1){
        $error['admin']='Admin username is required or please enter correct username!';
    }
    
    if(empty($password)||$password!=$pass){
        $error['password']='password is required/please enter correct password!';
    }
    
    
    if(isset($error)){
        echo'<div><ul>';
         foreach ($error as $e => $t) {
            echo "<li>$t</li>";
        }
        echo '</ul></div>';
    }else{
        echo'Welcome,Admin';
    }
  
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>Admin login</p><br>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <legend>Admin login</legend>
            <table>
                <tr>
                    <td>
                        <label for="admin">User Name:</label><br>
                    </td>
                    <td>
                        <input type="text" id="admin" name="admin" maxlength='30' ><br>
                    </td>          
                </tr>
                <tr>
                    <td>
                        <label for="password">password:</label><br>
                    </td>
                    <td>
                        <input type="text" id="password" name="password" >
                    </td>
                </tr>
                </table>
                <input type='submit' value='submit'>
                <input type='reset' value='reset'>
        </form>
 
    </body>
</html>
