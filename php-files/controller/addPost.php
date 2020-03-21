<?php

    if(isset($_POST["content"])) {

        session_start();

        //check if there are image want to be uploaded
        //--- if yes then set database image to link image location
        //--- if not then set database image to null

        include "../include/randomstr.php";
        include "../include/db_connect.php";

        // Get userID from token
        $token = $_SESSION["latus-token"];

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

        // Get Latest postId
        $query = "SELECT postId FROM timeline ORDER BY postId DESC LIMIT 1";
        $result = $db->query($query);

        if(mysqli_num_rows($result) == 0) {
            // If there is none
            $postId = 1;
        } else {
            $data = $result->fetch_assoc();
            $postId = (int) $data["postId"];
            $postId++;
        }

        // If user wan't to upload image file aswell
        if(isset($_FILES["file"])){

            // Set upload to yes
            $uploadOk = 1;

            // Generate hash use for image name
            $hash = $postId . $userId . time() . rndStr(5);
            $hash = hash('sha256', $hash);

            // Check if image file is a actual image or not
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "errType";
                exit();
            }

            $target_dir = "../assets/img/posts/" . $userId . "/";
            $temp = explode(".", $_FILES["file"]["name"]);
            $newFileName = $hash . '.' . end($temp);
            $img = $target_dir . $newFileName;
        }
        else {
            // No Upload Neccessary
            $uploadOk = 0;
            $img = "null";
        }

        if($uploadOk == 0) {
            insertData($userId, $img);
            exit();
        }
        else if($uploadOk == 1) {
            if(!is_dir($target_dir)) {
                mkdir($target_dir);
            }

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $img)) {
                insertData($userId, $img);
                exit();
            } else {
                echo "errFail";
            }
        }
        
    }
    else {
        echo "nah";
    }

    function insertData($userId, $img) {

        // Open database connection
        include "../include/db_connect.php";

        // Get content from POST Data
        $contents = $_POST["content"];
        
        $query = $db->prepare("INSERT INTO timeline (userId, contents, pic)
                                VALUES (?, ?, ?)");
        $query->bind_param("iss", $userId, $contents, $img);
        
        if($query->execute()) {
            echo "success";
        } else {
            echo $db->error;
        }

        $db->close();
    }

?>