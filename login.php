<?php
    require_once("bootstrap.php");
$password = filter_input(INPUT_POST,"password");
$islogged = Utilities::is_logged();

if(Config::$login_password != sha1($password) && $islogged == false){
    ?><!doctype html>
<title>Connexion</title>
<meta charset="utf-8">
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/bootstrap-responsive.css">
<div class="container hero-unit">
<form action="#" method="post">
    <h2>Log toi</h2>

    <input type="password" name="password" id="password"><br>
    <button class="btn btn-primary">Connexion</button>
</form>
</div>
<?php
} else {
    $_SESSION["logged"] = true;
    header("location:index.php");
}