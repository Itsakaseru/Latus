<?php

    // for profile pictures, the recommened size is 1024x1024 (user bewarned)
    // for profile cover, the recommened size is 1500x1000 (check if can) [need testing]

    // get usersId
    // ------

    // set target dir, file, ONLY ALLOW png, jpg--- 
    // make sure image file is less than 8mb ----
    // 

    if(!empty($_FILES["file"])) {

        $email = "getEmailFromDatabase" . "SjyChyalatusIncoporated";
        $userId = 1;

        $target_dir = "../assets/img/users/";
        $temp = explode(".", $_FILES["file"]["name"]);

        // Hash users email+customsalt to be use as picture name
        $newFileName = hash('sha256', $email) . '.' . end($temp);
        $target_file = $target_dir . $newFileName;

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "errType";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["file"]["size"] > 8000000) {
            echo "errLarge";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
            echo "errTypeImage";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "errFail";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

                include "../include/db_connect.php";

                $query = "UPDATE user SET pic = '" . $target_file . "' WHERE userId = '" . $userId . "';";

                if ($db->query($query) === TRUE) {
                    echo "success";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "errFail";
            }
        }
    }
    else {
        echo "Please select image to upload";
    }

    

?>