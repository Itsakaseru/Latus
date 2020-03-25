<?php

    if(!empty($_POST["fname"]) && !empty($_POST["bdate"]) && !empty($_POST["gender"]) && !empty($_POST["color"])) {
        
        session_start();

        include "../include/db_connect.php";

        // Get userID from token
        $token = $_SESSION["latus-token"];

        $query = $db->prepare("SELECT userId FROM user WHERE token = ?");
        $query->bind_param("s", $token);
        $query->execute();

        $result = $query->get_result();

        if($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            $userId = $data["userId"];
        } else {
            echo "errFail";
            exit();
        }

        $firstName = $_POST["fname"];
        $lastName = $_POST["lname"];
        $bdate = $_POST["bdate"];
        $gender = $_POST["gender"];
        $color = $_POST["color"];

        $query = $db->prepare("UPDATE user 
                               SET firstName = ?, lastName = ?, birthDate = ?, gender = ?, theme = ?
                               WHERE userId = ?");
        $query->bind_param("sssssi", $firstName, $lastName, $bdate, $gender, $color, $userId);
        
        if ($query->execute()) {
            echo "success";
        } else {
            echo $db->error;
        }

    }
    else {
        echo "All fields should not be empty, except last name!";
    }

?>