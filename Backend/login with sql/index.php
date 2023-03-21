<?php


$dsn = 'mysql:host=localhost;port=3306;dbname=school';
$out = "";
$pass = null;
$user = null;

if (isset($_POST['name']) && isset($_POST['pass'])) {
    $pass = $_POST['pass'];
    $user = $_POST['name'];
    $con = mysqli_connect("localhost", $user, $pass, "school");
    //$con = new PDO($dsn, $user, $pass);
    //$stmt = $con->prepare("select * from cursist");
    //$stmt->execute();
    //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($link === true){
        $out = "you're in";
    }
    else{
        $out = "password or username incorrect";
    }
} 
else {
    if(!empty($_POST['name'])){
        $user = $_POST['name'];
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
        <input type="text" name="name" placeholder="Username" value="<?php echo $user ?>">
        <input type="password" name="pass" placeholder="password">
        <button id="Sendit">Login</button>
        <p><?php echo $out ?></p>
    </form>
</body>

</html>