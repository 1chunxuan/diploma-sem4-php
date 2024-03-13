<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body{ font: 14px sans-serif; text-align: center; }
        </style>
    </head>
    <body>
        <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
        <h2>Messages</h2>
        <ul class="list-group m-4">
            <?php
            if (isset($_SESSION['msg']) && is_array($_SESSION['msg'])) {
                foreach ($_SESSION['msg'] as $msg) {
                    echo "<li class='list-group-item'>$msg</li>";
                }
            } else {
                echo "<li class='list-group-item'>No message in the session.</li>";
            }
            ?>
        </ul>
        <p>
            <a href='add-message.php' class='btn btn-primary'>Add Message</a>
            <a href='delete-message.php' class='btn btn-danger ml-3'>Delete All Messages</a>
        </p>
        <p>
            <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
            <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        </p>
    </body>
</html>