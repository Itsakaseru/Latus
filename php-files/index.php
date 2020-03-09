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
        // login directly when local token is present
        $(document).ready(function() {
            if(localStorage.getItem("token") != '') {
                $('#start').html("
                    <?php
                        include "view/landing.php";
                    ?>
                ");
            }
            else {
                $('#start').html("
                    <?php
                        include "view/feed.php";
                    ?>
                ");
            }
        });
    </script>
</head>

<body id="start">

</body>

</html>
