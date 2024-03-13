<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $msg = trim($_POST['msg']);
    if (!isset($_SESSION['msg'])) {
        $_SESSION['msg'] = [$msg];
    } else {
        $_SESSION['msg'] = array_merge($_SESSION['msg'], [$msg]);
    }
    $resp = '<div class="alert alert-success">Message has been added to session.</div>';
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add message</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body{ font: 14px sans-serif; text-align: center; }
        </style>
    </head>
    <body>
        <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
        <h2>Add Message</h2>
        <?= $resp ?? '' ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method='POST' class="form-inline">
            <div class='form-group mx-auto'>
                <input type='text' name='msg' class='form-control'>
                <input type='submit' value='Add' class='btn btn-primary'>
            </div>
        </form>
        <br>
        <p>
            <a href='welcome.php' class='btn btn-primary'>Back to Welcome</a>
        </p>
    </body>
</html>