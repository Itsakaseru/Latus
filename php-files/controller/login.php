<?php
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
                setcookie("latus-userid", $user['userId'], $time);
                setcookie("latus-token", $token, $time);
                echo "true";
            }
            else echo "queryError";
        }
        else echo "passError";
    }

    mysqli_free_result($result);
    mysqli_close($db);
 ?>
