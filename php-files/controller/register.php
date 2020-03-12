<?php
    $captcha = $_POST['captchaBox'];

    // $recaptcha = json_decode(file_get_contents());
    if (!function_exists('curl_init')){
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify?secret=6LeBWeAUAAAAAIwgEHRhtj8hEG21YOm0QEhDI10Z" . "&response=" . $captcha);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    $result = json_decode($output);
    curl_close($ch);
    echo $result->score;

    // $recaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeBWeAUAAAAAIwgEHRhtj8hEG21YOm0QEhDI10Z"."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    // $result = json_decode($recaptcha);

    if($result->score >= 0.5) {
        include "../include/db_connect.php";
        include "../include/randomstr.php";

        $fname; $lname; $email; $password; $birthDate; $gender;

        if(isset($_POST['fname'])) $fname = $_POST['fname'];
        if(isset($_POST['lname'])) $lname = $_POST['lname'];
        if(isset($_POST['email'])) $email = $_POST['email'];
        if(isset($_POST['password'])) $password = $_POST['password'];
        if(isset($_POST['birthDate'])) $birthDate = $_POST['birthDate'];
        if(isset($_POST['gender'])) $gender = $_POST['gender'];

        $salt = rndStr(5);

        $hash = hash("sha256", $password . $salt);

        $cekmail = "SELECT * FROM user WHERE email='$email'";
        $result = $db -> query($cekmail);

        if(mysqli_num_rows($result) > 0){
            echo 'userError';
    	}
        else{
            // $token = hash("sha256", rndStr(5));
            // $query = "INSERT INTO user (firstName, lastName, email, hash, salt, birthDate, gender, token) VALUES ('$fname', '$lname', '$email', '$hash', '$salt', '$birthDate', '$gender', '$token');";
            $query = "INSERT INTO user (firstName, lastName, email, hash, salt, birthDate, gender) VALUES ('$fname', '$lname', '$email', '$hash', '$salt', '$birthDate', '$gender');";

            if($db -> query($query)) {
                echo 'true';
            }
            else {
                echo 'false';
            }
    	}

        mysqli_free_result($result);
        mysqli_close($db);
    }
    else {
        echo "captchaErr";
    }
?>
