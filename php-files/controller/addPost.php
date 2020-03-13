<?php

    if(isset($_POST["content"])) {

        //check if there are image want to be uploaded
        //--- if yes then set database image to link image location
        //--- if not then set database image to null

        $userId = $_POST["userId"];
        $contents = $_POST["content"];
        $img = "null";

        include "../include/db_connect.php";

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