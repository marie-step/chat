<?php
/*
    funcs.php
    Pomocne funkce pro Chat.

    2024-11-20 - jmarianek - connect_db();
                           - insert_user();
                           - TODO check_user();

*/

require_once "const.php";

/**
 * Pripoji se k DB dle dbcfg.php
 * a vrati spojeni, nebo chybu.
 */
function connect_db()
{
    require_once "dbcfg.php";
    $con = mysqli_connect($server, $login, $passwd, $schema);

    // kontrola pripojeni k DB
    if (!$con) {
        return mysqli_connect_error();
    }

    return $con;
}

/**
 * Vlozi do DB predaneho uzivatele.
 * @param $user_data Obsahuje $_POST[] odesl. formulare.
 * @return Hodnota true - ok, false - chyba.
 */
function insert_user($user_data)
{
    $con = connect_db();
    $sql = "insert into users(login, passwd)\n"
          ."values('".$user_data["login"]."', '"
                     .$user_data["passwd"]."')";
    echo BR.$sql;
    if (mysqli_query($con, $sql)) {
        return true;
    }
    return false;
}



/**
 * Proveri, ze predany uziv. $user_data["login"],
 * $user_data["passwd"] v DB existuje a heslo sedi.
 * @return True existuje a heslo sedi, false jinak.
 */
function check_user($user_data)
{
    // TODO - dokoncit
    return true;
}

function insert_message($con, $msg, $rooms_id, $users_id){
    $sql = "insert into posts(msg, rooms_id, users_id)\n"
          ."values('".$msg."', '"
                     .$rooms_id."', '"
                     .$users_id."')";
    if (mysqli_query($con, $sql)) {
        return true;
    }
    return false;
}

?>