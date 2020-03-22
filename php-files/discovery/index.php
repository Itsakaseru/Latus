<?php

    include "include/db_connect.php"; 
    include "model/users.php";

    $id; $token;

    if(isset($_SESSION['latus-userid'])) $id=$_SESSION['latus-userid'];
    if(isset($_SESSION['latus-token'])) $token=$_SESSION['latus-token'];

    // Get currentUserData
    $query = $db->prepare("SELECT * FROM user WHERE token = ?");
    $query->bind_param("s", $token);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows != 1) {
        header('Location: ../login/');
        exit();
    }

    $row = $result -> fetch_assoc(); 

    $user = new User($row["userId"], $row["firstName"], $row["lastName"], $row["email"], $row["birthDate"], $row["gender"], $row["pic"], $row["cover"], $row["theme"]);

    mysqli_free_result($result);
    mysqli_close($db);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Latus - Discovery</title>
    <link rel="stylesheet" href="assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/discovery.css?ver=1.0.0">
    <script src="assets/jquery-3.4.1.js"></script>
    <script src="assets/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a81849e810.js"></script>
    <script src="assets/autosize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .solid {
        background-color: #<?php echo $user->getTheme(); ?> !important;
        -webkit-transition: background-color 0.25s ease 0s;
        transition: background-color 0.25s ease 0s;
    }
</style>

<body id="profile">
    <header></header>
    <nav class="navbar navbar-dark navbar-expand-md fixed-top solid">
        <a href="" class="navbar-brand">
            <img src="assets/img/web/logo-small.svg" alt="Latus Logo" width="30px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse justify-content-stretch" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Discovery</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="btn-group">
                        <button id="accBtn" type="button" class="btn d-flex align-items-center justify-content-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <a><?php echo $user->getFName() . " " . $user->getLName(); ?> &nbsp;</a>
                            <img id="accImg" src="<?php echo substr($user->getPicture(), 3); ?>?<?php echo time(); ?>" width="30px">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button id="logout" class="dropdown-item" type="button">Logout</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container text-center mb-5">
        <h1>Discovers new "friends"!</h1>
    </div>
    <div class="container pt-5">
        <div class="row d-flex justify-content-around">

            <?php

                include 'include/db_connect.php';

                // Get all users
                $query = "SELECT * from user WHERE NOT userId = '" . $user->getUserId() . "';";
                $result = $db->query($query);

                // Array to hold data
                $userList = array();

                while($data = mysqli_fetch_assoc($result)) {
                    array_push($userList, new User($data["userId"], $data["firstName"], $data["lastName"], $data["email"], $data["birthDate"], $data["gender"], $data["pic"], $data["cover"], $data["theme"]));
                }

                foreach(array_reverse($userList) as $x) { ?>
                    <div class="col-lg-3">
                        <div id="profileInfo" class="col mr-lg-4 pb-md-5 p-md-0 mb-md-3 mb-5">
                            <div class="card userList" onclick="window.location='profile/user.php?id=<?php echo $x->getUserId() ?>';">
                                <div class="card-body">
                                    <div id="profileImage" class="row justify-content-center" data-toggle="modal" data-target="#changePicture">
                                        <img id="profilePicture" class="rounded-circle" src="<?php echo substr($x->getPicture(), 3); ?>?<?php echo time(); ?>" width="160px;" style="border: 5px solid #<?php echo $x->getTheme(); ?>; border-style: outset;">
                                    </div>
                                    <div id="profileName" class="row justify-content-center mt-3 pl-3 pr-3" style="text-align: center;">
                                        <?php echo $x->getFName() . " " . $x->getLName(); ?>
                                    </div>
                                    <hr style="border: 1px solid #B1B1B1">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
        </div>
        
    </div>

</body>
<script>
    $(document).ready(function() {
        $('#logout').on('click', function() {
            $.ajax({
                url: 'controller/logout.php',
                method: "POST",
                success: function(data){
                    location.reload();
                },
                error: function() {
                    alert("Something went wrong");
                }
            });
        })
    });
</script>

</html>