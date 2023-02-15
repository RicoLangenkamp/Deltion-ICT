<?php
$out = "";
$password = null;
$username = null;
if (!empty($_POST['name']) && !empty($_POST['pass'])) {
    $password = $_POST['pass'];
    $username = $_POST['name'];
    if ($password == "123" && $username == "Rico") {
        $out =  "Logged in";
    } else {
        $out = "Wrong password or username." . "<br> Try again.";
    }
} 
else {
    if(!empty($_POST['name'])){
        $username = $_POST['name'];
    }
    $out = "Fill Password and username";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Login</h1>
    <form action="" method="post">
        <input type="text" name="name" placeholder="Username" value="<?php echo $username ?>">
        <input type="password" name="pass" placeholder="password">
        <button id="Sendit">Login</button>
        <p><?php echo $out ?></p>
    </form>
</body>

</html>