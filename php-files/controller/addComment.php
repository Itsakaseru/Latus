<?php

    //check if user loggedin or not
    // if yes execute
    
    include "../include/db_connect.php";

    // Get User Token
    $token = $_COOKIE["latus-token"];

    // Get User ID from token
    $query = $db->prepare("SELECT userId FROM user WHERE token = ?");
    $query->bind_param("s", $token);
    $query->execute();

    $result = $query->get_result();

    if(mysqli_num_rows($result) == 1) {
        $data = $result->fetch_assoc();
        $userId = $data["userId"];
    } else {
        echo "errFail";
        exit();
    }

    $postId = $_POST["postId"];
    $comment = $_POST["comment"];

    $query = $db->prepare("INSERT INTO comment (userId, postId, contents)
                           VALUES (?, ?, ?)");
    $query->bind_param("iis", $userId, $postId, $comment);

    if($query->execute()) {
        echo "success";
    }
    else {
        echo $db->error;
    }

?>