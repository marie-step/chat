<?php
    /*
        chat.php

        2024-12-11 - jmarianek - v1;
        
        TODO - osetrit neprihlaseneho uziv.

    */


    require_once "layout/header.php";
    require_once "funcs.php";

    $rooms_id = $_GET["id"];
?>

<h1>Chat - vítejte v místnosti</h1>
TODO - overit, ze uzivatel ma pravo na tuto mistnost<br/>
TODO - submit form.<br/>


<script>
    function fetchMessages() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', "chat_msg.php?action=fetch&id=<?php echo $rooms_id; ?>", true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                const messages = JSON.parse(xhr.responseText);
                const messageContainer = document.getElementById('messages');
                messageContainer.innerHTML = '';

                messages.forEach(msg => {
                    const div = document.createElement('div');
                    div.textContent = `${msg.login}: ${msg.msg}`;
                    messageContainer.appendChild(div);
                });
            }
        };
        xhr.send();
    }

    window.onload = fetchMessages();
</script>

<div id="messages" style="border: 1px solid #ccc; height: 300px; overflow-y: scroll; padding: 10px;"></div>


<?php /*
    echo "id=$rooms_id".BR;

    // TODO vypsat prispevky
    /*
    view_posts
    id int 
    login varchar(20) 
    msg varchar(1000) 
    rooms_id int
    *//*
    $sql = "
    select id, login, msg, rooms_id
    from view_posts
    where rooms_id = $rooms_id";

    // pripojeni k DB
    $con = connect_db();

    $sqlstat = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($sqlstat)) {
        echo "<div class='post'>";
        echo "<b>".$row["login"]."</b>".BR.$row["msg"];
        echo "</div>\n";
    }*/
?>

<form method="post">
<textarea placeholder="Sem piste..." name= "message">
</textarea>
<input type="submit" value="Odeslat"/>
</form>

<?php
    $con = connect_db();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $sql= "select id from users where login= '".$_SESSION["login"]."'";
        $sqlstat = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($sqlstat)) {
            $users_id = $row['id'];
        }
        insert_message($con, $_POST["message"], $rooms_id, $users_id);
        header("Location: chat.php?id=$rooms_id");

    }

    require_once "layout/footer.php";
?>
