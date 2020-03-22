<?php

    session_start();
    
    include "../include/db_connect.php";
    include "../include/randomstr.php";

    $username; $password;
    if(isset($_POST['username'])) $username = $_POST['username'];
    if(isset($_POST['password'])) $password = $_POST['password'];
    if(isset($_POST['rememberme'])) $rememberme = $_POST['rememberme'];

    $query = $db->prepare("SELECT * FROM user WHERE email = ?");
    $query->bind_param("s", $username);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows != 1) {
        echo "userError";
    }
    else {
        $user = $result->fetch_assoc();
        $salt = $user['salt'];
        $hash = $user['hash'];

        mysqli_free_result($result);

        if(hash("sha256", $password . $salt) == $hash) {

            $captcha = $_POST['captchaBox'];

            $recaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeBWeAUAAAAAIwgEHRhtj8hEG21YOm0QEhDI10Z"."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
            $result = json_decode($recaptcha);

            if($result->score >= 0.5) {
                // set token, unknown whether will be used
                $token = hash("sha256", rndStr(5));

                $query = $db->prepare("UPDATE user SET token='$token' WHERE email = ?");
                $query->bind_param("s", $username);

                // fetch from other pages using latus-token cookie
                if($query->execute()) {

                    if($rememberme == 'true') {
                        // expire in 30 days
                        $time = time() + (86400 * 30);
                        setcookie("latus-userid", $user['userId'], $time, "/");
                        setcookie("latus-token", $token, $time, "/");
                    }
                    else if ($rememberme == 'false') {
                        // expire when browser close
                        $_SESSION["latus-userid"] = $user['userId'];
                        $_SESSION["latus-token"] = $token;
                    }
                    
                    echo "true";
                }
                else echo "queryError";
            }
            else {
                echo "captchaError";
            }
        }
        else echo "passError";
    }

    mysqli_close($db);
    
 ?>
