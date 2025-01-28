<?php
/*
    login.php
    Prihlaseni

    2024-10-23 - jmarianek - vychozi verze
    2024-11-06 - jmarianek - prace se session
    2024-11-13 - jmarianek - registrace;
*/


require_once "layout/header.php";
require_once "const.php";
require_once "funcs.php";
?>


<h1>Chat - přihlášení</h1>
<form method = "post">
<label for="login">Login:</label>
<input required name ="login" type="text"/>
<br/>
<label for="passwd">Heslo:</label>
<input required name="passwd" type="password"/>
<br/>
<input type="submit" value="Přihlásit"/>
</form>

<?php
// TODO - zkontrolovat uspesne prihlaseni
// kdyz prihlasen, tak spustime session



if (isset($_POST["login"]) && check_user($_POST))
{
    $_SESSION["logged_in"] = true;
    $_SESSION["login"] = $_POST["login"]; 
    // TODO dotahnout users.role z DB:
    $_SESSION["admin"] = false; 
    echo "<script>location.href='index.php'</script>";
} else {
    echo "Neuspesne prihlaseni".BR;
}
?>

<div>
Nemáte ještě účet?
<a href="reg.php">Zaregistrujte se</a>
</div>

<?php
require_once "layout/footer.php";
?>