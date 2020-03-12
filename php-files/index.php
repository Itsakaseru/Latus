<!DOCTYPE html>
<html>

<head>
    <title>Latus</title>
    <link rel="stylesheet" href="assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/start.css?ver=1.0.0">
    <script src="assets/jquery-3.4.1.js"></script>
    <script src="assets/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
    </script>
</head>

<body id="start">
    <?php
        include "controller/db_connect.php";
        session_start();

        $query = "SELECT * FROM users";
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
            include "../view/profile.php";
        }
        else if($found == 0) {
            include "../view/landing.php";
        }
    ?>
</body>

</html>
