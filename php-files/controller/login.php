<?php
    include "../include/db_connect.php";
    include "../include/randomstr.php";

    $username; $password;
    if(isset($_POST['username'])) $username = $_POST['username'];
    if(isset($_POST['password'])) $username = $_POST['password'];

    $query = "SELECT * FROM user WHERE email='$username'";
    $result = $db->query($query);

    if(mysqli_num_rows($result) != 1) {
        echo "userError";
    }
    else {
        $user = $result->fetch_assoc();
        $salt = $user['salt'];
        $hash = $user['password'];

        if(hash("sha256", $password . $salt) == $hash) {
            // set token, unknown whether will be used
            $token = hash("sha256", rndStr(5));
            $query = "UPDATE user SET token='$token' WHERE email='$username'";

            if($db->query($query)) echo $token;
            else echo "queryError";
        }
        else echo "passError";
    }

    mysqli_free_result($result);
    mysqli_close($db);
 ?>
