<?php
    require_once "funcs.php";
    $rooms_id = $_GET["id"];
    $conn = connect_db();

    if (isset($_GET['action']) && $_GET['action'] == 'fetch') {
        $query =  "select id, login, msg, rooms_id
                   from view_posts
                   where rooms_id = $rooms_id";
        $result = $conn->query($query);
    
        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    
        echo json_encode($messages);
        #exit;
    }
?>
