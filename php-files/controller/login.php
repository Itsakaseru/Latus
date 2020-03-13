<?php
    $captcha = $_POST['captchaBox'];

    // $recaptcha = json_decode(file_get_contents());
    /*
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
    */

    $recaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeBWeAUAAAAAIwgEHRhtj8hEG21YOm0QEhDI10Z"."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    $result = json_decode($recaptcha);

    if($result->score >= 0.5) {
        include "../include/db_connect.php";
        include "../include/randomstr.php";

        $username; $password;
        if(isset($_POST['username'])) $username = $_POST['username'];
        if(isset($_POST['password'])) $password = $_POST['password'];

        $query = "SELECT * FROM user WHERE email='$username'";
        $result = $db->query($query);

        if(mysqli_num_rows($result) != 1) {
            echo "userError";
        }
        else {
            $user = $result->fetch_assoc();
            $salt = $user['salt'];
            $hash = $user['hash'];

            if(hash("sha256", $password . $salt) == $hash) {
                // set token, unknown whether will be used
                $token = hash("sha256", rndStr(5));
                $query = "UPDATE user SET token='$token' WHERE email='$username'";

                // fetch from other pages using latus-token cookie
                if($db->query($query)) {
                    // expire in 30 days
                    $time = time() + (86400 * 30);
                    setcookie("latus-userid", $user['userId'], $time, "/");
                    setcookie("latus-token", $token, $time, "/");
                    echo "true";
                }
                else echo "queryError";
            }
            else echo "passError";
        }

        mysqli_free_result($result);
        mysqli_close($db);
    }
    else {
        echo "captchaError";
    }
 ?>
