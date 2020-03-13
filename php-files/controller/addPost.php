<?php

    if(isset($_POST["content"])) {

        //check if there are image want to be uploaded
        //--- if yes then set database image to link image location
        //--- if not then set database image to null

        include "../include/db_connect.php";

        // Get userID from token
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

        $contents = $_POST["content"];
        $img = "null";

        $query = "INSERT INTO timeline (userId, contents, pic)
                  VALUES ('" . $userId . "', '" . $contents . "', '" . $img . "');";
        
        if($db->query($query) === TRUE) {
            echo "success";
        } else {
            echo $db->error;
        }
    }
    else {
        echo "nah";
    }

?>