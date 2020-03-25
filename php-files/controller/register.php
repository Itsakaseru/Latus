<?php
 
    include "../include/db_connect.php";
    include "../include/randomstr.php";

    $fname; $lname; $email; $password; $birthDate; $gender;

    if(isset($_POST['fname'])) $fname = $_POST['fname'];
    if(isset($_POST['lname'])) $lname = $_POST['lname'];
    if(isset($_POST['email'])) $email = $_POST['email'];
    if(isset($_POST['password'])) $password = $_POST['password'];
    if(isset($_POST['birthDate'])) $birthDate = $_POST['birthDate'];
    if(isset($_POST['gender'])) $gender = $_POST['gender'];

    if($fname == '' || $email == '' || $password == '' || $birthDate == '' || $gender == 'null') {
        echo "empty";
        exit();
    } 
    else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "errEmail";
            exit();
        }
    }

    $salt = rndStr(5);

    $hash = hash("sha256", $password . $salt);

    $query = $db->prepare("SELECT * FROM user WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows > 0){
        echo 'userError';
    }
    else{
        mysqli_free_result($result);
        
        $captcha = $_POST['captchaBox'];

        $recaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeBWeAUAAAAAIwgEHRhtj8hEG21YOm0QEhDI10Z"."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        $result = json_decode($recaptcha);

        if($result->score >= 0.5) {
            $query = $db->prepare("INSERT INTO user (firstName, lastName, email, hash, salt, birthDate, gender)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
            $query->bind_param("sssssss", $fname, $lname, $email, $hash, $salt, $birthDate, $gender);

            if($query->execute()) {
                echo 'true';
            }
            else {
                echo 'false';
            }
        }
        else {
            echo "captchaErr";
            exit();
        }
    }
    mysqli_close($db);
    
?>
