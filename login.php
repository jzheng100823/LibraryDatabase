<?php
    include 'header.php';
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<h1>Login</h1>
<body>
<div class="login-stuff">
    <form method="POST" action="staff.php">
        <p>&nbsp;</p><input type = "text" name = "mailuid" placeholder="Username/Email">
        <input type = "text" name = "pwd" placeholder="Password">
        <button type="submit" name = "login-submit">Login</button>
    </form>
    <a href = "index.php">Cancel</a>
</div>
<?php
//if (isset($_POST['login-submit'])){
    //$mailuid = $_POST['mailuid'];
    //$pass = $_POST['pwd'];
    //Debugging purposes:
    //echo "mailuid is: " .$mailuid;
    //echo "password is: " .$pass;
//}
?>
</body>
</html>
