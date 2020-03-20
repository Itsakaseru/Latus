<?php

    //check if user loggedin or not
    // if yes execute
    
    include "../include/db_connect.php";

    $token = $_COOKIE["latus-token"];
    $query = "SELECT userId FROM user WHERE token = '" . $token . "';";
    $result = $db->query($query);

    if(mysqli_num_rows($result) == 1) {
        $data = $result->fetch_assoc();
        $userId = $data["userId"];
    } else {
        echo "errFail";
        exit();
    }

    $postId = $_POST["postId"];
    $comment = $_POST["comment"];

    $query = "INSERT INTO comment (userId, postId, contents)
              VALUES ('" . $userId . "', '" . $postId . "', '" . $comment . "');";

    if($db->query($query) === TRUE) {
        echo "success";
    }
    else {
        echo $db->error;
    }

?>