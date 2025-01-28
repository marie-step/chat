<?php
/*
    reg.php
    Registrace

    2024-11-13 - jmarianek - vychozi verze
*/

require_once "layout/header.php";
require_once "const.php";
require_once "funcs.php";

// pokud form method=POST je odeslan (submitovan)
// tak je napleno pole $_POST[nazev_pole]
// kde nazev pole je atr. name

// napr. $_POST["login"]

// TODO - provest SQL prilaz INSERT...
// tj. mysqli_connect(), mysqli_query("insert...");
?>

<h1>Chat - registrace</h1>
<?php
if (isset($_POST["login"])) {
    echo "Formular odeslan, login=".$_POST["login"].BR;
    if (insert_user($_POST)) {
        echo "Uživatel úspěšně založen.".BR;
    } else {
        echo "Uživatele se nepovedlo založit.".BR;
    }
    exit; // dal nic, tj. form se nezobrazi
}
?>
<!--
id	int    NEMUSIM SE STARAT
name	varchar(20)  ANO
surname	varchar(50)  ANO
passwd	varchar(20)  ANO
login	varchar(20)  ANO
role	enum('admin','moderator','user')  VZDY user
blocked	enum('Y','N') NEMUSIM SE STARAT - def. N
avatar	varchar(50)  ANO
-->
<form method="POST">
Login:<input name="login" required> <br><br>
password:<input name="passwd" required type="password"> <br><br>
name:<input name="name" required><br><br>
surname:<input name="surname" required><br><br>
<input type="submit" value="Odeslat"/>
</form>
<?php

/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['passwd']);
    echo $name;
}
*/

require_once "layout/footer.php";
?>