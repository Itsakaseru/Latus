<?php
    session_start();
?>
<?php
    include "include/db_connect.php";

    $query = "SELECT * FROM user";
    $result = $db->query($query);
    $found = 0;

    if(mysqli_num_rows($result) == 0) {
        // well, users must not be zero anyway, thus show this message.
        echo "<p>You're the first user... or hacked our database to delete all our data. Good job.</p>";
    }
    else {
        if(isset($_COOKIE["latus-userid"]) && isset($_COOKIE["latus-token"])) {
            while($row = $result->fetch_assoc()) {
                if($row["userId"] == $_COOKIE["latus-userid"] && $row["token"] == $_COOKIE["latus-token"]) {
                    // break and include profile page
                    $found = 1;
                    $_SESSION["latus-userid"] = $_COOKIE["latus-userid"];
                    $_SESSION["latus-token"] = $_COOKIE["latus-token"];
                    break;
                }
            }
        }
        else if(isset($_SESSION["latus-userid"]) && isset($_SESSION["latus-token"])) {
            while($row = $result->fetch_assoc()) {
                if($row["userId"] == $_SESSION["latus-userid"] && $row["token"] == $_SESSION["latus-token"]) {
                    // break and include profile page
                    $found = 1;
                    break;
                }
            }
        }
    }

    if($found == 1) {
        include "discovery/index.php";
    }
    else if($found == 0) {
        include "view/landing.php";
    }
?>
