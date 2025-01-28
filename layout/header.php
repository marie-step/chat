



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chat</title>
<link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    
<!-- navigacni menu -->
<div class="navmenu">
<span><a href="users.php">Uživatelé</a></span>
<span><a href="rooms.php">Místnosti</a></span>

<?php
// zahajime session - pro vsechny stranky pouzivajici
// header.php
session_start();
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
    // uzivatel je prihlasen
    echo "<span>".$_SESSION["login"]."</span>";
    echo "<span ><a href='logout.php'>Odhlasit se</a></span>";
    // TODO - odkaz pro odhlaseni, pouzije session_destroy(); 
} else {
    echo '<span><a href="login.php">Přihlásit</a></span>';
}

?>
</div>
