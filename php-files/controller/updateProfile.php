<?php

    if(!empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["bdate"]) && !empty($_POST["gender"]) && !empty($_POST["color"])) {
        
        session_start();

        include "../include/db_connect.php";

        // Get userID from token
        $token = $_SESSION["latus-token"];

        $query = "SELECT userId FROM user WHERE token = '" . $token . "';";
        $result = $db->query($query);

        if(mysqli_num_rows($result) == 1) {
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

        $query = "UPDATE user 
                  SET firstName = '" . $firstName . "', lastName = '" . $lastName . "', birthDate = '" . $bdate . "', gender = '" . $gender . "', theme = '" . $color . "'
                  WHERE userId = '" . $userId . "';";
        
        if ($db->query($query) === TRUE) {
            echo "success";
        } else {
            echo $db->error;
        }

    }
    else {
        echo "errEmpty";
    }

?>