<!DOCTYPE html>
<html>

<head>
    <title>Latus</title>
    <link rel="stylesheet" href="../assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/profile.css?ver=1.0.0">
    <script src="../assets/jquery-3.4.1.js"></script>
    <script src="../assets/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a81849e810.js"></script>
    <script src="../assets/autosize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!--
    PHP find users default theme color
        -- set as variable
    echo variable to css style below

    users can choose pre-determined color to avoid conflict with font-color
-->

<?php

    session_start();
   
    include "../include/db_connect.php"; 
    include "../model/users.php";

    $id; $token;

    if(isset($_SESSION['latus-userid'])) $id=$_SESSION['latus-userid'];
    if(isset($_SESSION['latus-token'])) $token=$_SESSION['latus-token'];

    $query1 = "SELECT * FROM user WHERE token='$token'";
    $result = $db -> query($query1);

    $row = $result -> fetch_assoc(); 

    $user = new User($row["userId"], $row["firstName"], $row["lastName"], $row["email"], $row["birthDate"], $row["gender"], $row["pic"], $row["cover"], $row["theme"]);

    // Get user posts count
    $query2 = "SELECT COUNT(*) AS 'postCount' from timeline WHERE userId = '" . $user->getUserId() . "';";
    $countPost = $db -> query($query2);

    $postCount = $countPost -> fetch_assoc();
    $postCount = $postCount["postCount"];

    mysqli_free_result($result);
    mysqli_close($db);

    //Calculate age
    $today = date("Y-m-d");
    $dob = $user->getBirthDate();
    $age = date_diff(date_create($dob), date_create($today));

    function getTimeAgo($timestamp) { 

        date_default_timezone_set("Asia/Jakarta");
        $timeAgo = strtotime($timestamp);
        $diff = time() - $timeAgo; 
        
        if( $diff < 1 ) {  
            return 'Just Now';  
        } 
        
        $time_rules = array (  
                    12 * 30 * 24 * 60 * 60 => 'year', 
                    30 * 24 * 60 * 60      => 'month', 
                    24 * 60 * 60           => 'day', 
                    60 * 60                => 'hour', 
                    60                     => 'minute', 
                    1                      => 'second'
        ); 
    
        foreach( $time_rules as $secs => $str ) { 
            
            $div = $diff / $secs; 
    
            if( $div >= 1 ) { 
                
                $t = round( $div ); 
                
                return $t . ' ' . $str .  
                    ( $t > 1 ? 's' : '' ) . ' ago'; 
            } 
        } 
    }

?>
<style>
    .solid {
        background-color: #<?php echo $user->getTheme(); ?> !important;
        -webkit-transition: background-color 0.25s ease 0s;
        transition: background-color 0.25s ease 0s;
    }
</style>

<body id="profile">
    <header data-toggle="modal" data-target="#changeCover" style="background-image: url('<?php echo $user->getCover(); ?>');"></header>
    <nav class="navbar navbar-dark navbar-expand-md fixed-top">
        <a href="/" class="navbar-brand">
            <img src="../assets/img/web/logo-small.svg" alt="Latus Logo" width="30px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse justify-content-stretch" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Discovery</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="btn-group">
                        <button id="accBtn" type="button" class="btn d-flex align-items-center justify-content-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <a><?php echo $user->getFName() . " " . $user->getLName(); ?> &nbsp;</a>
                            <img id="accImg" src="<?php echo $user->getPicture(); ?>" alt="itsakaseru" width="30px">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">Profile</button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" type="button">Logout</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container pt-5">

        <div class="row">
            <div id="profileInfo" class="col-lg-3 mr-lg-4 pb-md-5 p-md-0 mb-md-3 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div id="profileImage" class="row justify-content-center" data-toggle="modal" data-target="#changePicture">
                            <img id="profilePicture" class="rounded-circle" src="<?php echo $user->getPicture(); ?>" width="160px;" style="border: 5px solid #<?php echo $user->getTheme(); ?>; border-style: outset;">
                            <div class="middle">
                                <div class="text">Change Picture</div>
                            </div>
                        </div>
                        <div id="profileName" class="row justify-content-center mt-3 pl-3 pr-3" style="text-align: center;">
                            <?php echo $user->getFName() . " " . $user->getLName(); ?>
                        </div>
                        <hr style="border: 1px solid #B1B1B1">
                        <div class="profileDetail row justify-content-center">
                            <?php echo $age->format('%y') ?> years old 
                        </div>
                        <div class="profileDetail row justify-content-center">
                            <?php echo $postCount ?> total posts
                        </div>
                        <div id="profileControl" class="row justify-content-center mt-4">
                            <a data-toggle="modal" data-target="#editProfile"><i class="fas fa-edit"></i> edit profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg ml-3 mr-3">

                <div class="row mb-md-4 mb-4">
                    <div class="card col-lg-12 pt-3 pb-3">
                        <form id="createPost" class="col" enctype="multipart/form-data">
                            <div class="row">
                                <textarea id="content" type="text" class="inputField form-control" rows="1" name="content" maxlength="256" placeholder="me want post something..."></textarea>
                            </div>
                            <div class="row mt-3">
                                <div class="col p-0">
                                    <input id="imgFile" class="inputfile" name="imgContent" type="file" class="btn">
                                </input>  
                                </div>
                                <div class="col p-0">
                                    <button id="postBtn" class="float-right" name="postContent" type="button" class="btn">post</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    
                </div><!-- End of new post-->

                <div class="row">

                    <?php

                        include '../include/db_connect.php';
                        include '../model/posts.php';
                        include '../model/comments.php';

                        // Get user Posts
                        $query = "SELECT * from timeline WHERE userId = '" . $user->getUserId() . "';";
                        $result = $db->query($query);

                        // array to hold data
                        $posts = array();

                        while($data = mysqli_fetch_assoc($result)) {
                            array_push($posts, new Post($data["userId"], $data["postId"], $data["contents"], $data["pic"], $data["timeStamp"]));
                        }

                        foreach(array_reverse($posts) as $x) { ?>

                            <?php 

                                // Array to hold data
                                $comments = array();
                                
                                // get Comments for user for each posts
                                $query = "SELECT timeline.postId, comment.commenterId, user.userId, user.firstName, user.lastName, user.pic, comment.contents, comment.timeStamp
                                          FROM user
                                          INNER JOIN timeline
                                          INNER JOIN comment ON user.userId = comment.userId AND timeline.postId = comment.postId
                                          WHERE timeline.postId = '" . $x->getPostId() ."';";
                                $result = $db->query($query);

                                while($data = mysqli_fetch_assoc($result)) {
                                    array_push($comments, new Comment($data["postId"], $data["commenterId"], $data["userId"], $data["firstName"], $data["lastName"], $data["pic"], $data["contents"], $data["timeStamp"]));
                                }

                            ?>

                            <div class="containerPost card col-lg-12 pt-3 pb-3 mb-5">
                                <div class="row pl-3 d-flex">
                                    <div class="col-5 col-sm-7 col-md-9 align-self-start d-flex">
                                        <img class="profilePicture rounded-circle" src="<?php echo $user->getPicture(); ?>" width="50px;" style="border: 2px solid <?php echo $theme?>">
                                        <span class="postName ml-md-3 my-auto"><strong><?php echo $user->getFName() . " " . $user->getLName(); ?></strong></span>
                                    </div>
                                    <div class="col-7 col-sm-5 col-md-3 my-auto d-flex">
                                        <span class="ml-auto mr-3"><?php echo getTimeAgo($x->getTime());?></span>
                                    </div>
                                </div>
                                <div class="row pl-3 pt-3 mb-4">
                                    <div class="col">
                                        <?php echo $x->getContents(); ?>
                                    </div>
                                </div>
                                <?php
                                    if($x->getPic() != "null"){ ?>

                                        <div class="row">
                                            <div class="col-12 pl-3 pt-3">
                                                <img class="img-fluid" src="../assets/img/web/cover-default.png" style="display: show;">
                                            </div>
                                        </div>
                                    <?php } ?>
                                        <hr>
                                    <?php foreach($comments as $y) { ?>
                                        <div class="commentContainer row pl-md-3 mb-3">
                                            <div class="col-1 align-self-start d-flex">
                                                <img class="profilePicture rounded-circle" src="<?php echo $y->getPic(); ?>" width="50px;" style="border: 2px solid #<?php echo $user->getTheme();?>">
                                            </div>
                                            <div class="col-11 d-flex pl-0 pl-md-3">
                                                <span class="comment my-auto mr-4 mr-sm-3 ml-3 ml-sm-0"><strong><?php echo $y->getFName() . " " . $y->getLName();?></strong> <?php echo $y->getContent();?></span>
                                            </div>
                                        </div>
                                    <?php } ?>

                                <div class="replayContainer">
                                    <form class="col-12">
                                        <div class="row">
                                            <div class="col-8 col-sm-9 col-md-10">
                                                <textarea class="inputField form-control" rows="1" name="content" maxlength="256" placeholder="reply something..."></textarea>
                                            </div>
                                            <div class="col-4 col-sm-3 col-md-2">
                                                <button class="commentBtn float-right" name="postContent" type="button" class="btn">comment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        <?php } ?>

                </div><!-- End of x-list post -->

            </div>
        </div><!-- End of contents-->
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfile" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="updateProfile" method="post">
                        <div class="form-group">
                            <label for="formGroupExampleInput">First Name</label>
                            <input id="firstName" type="text" class="form-control" placeholder="First Name" value="<?php echo $user->getFName(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Last Name</label>
                            <input id="lastName" type="text" class="form-control" placeholder="Last Name" value="<?php echo $user->getLName(); ?>">
                        </div>
                        <div class="form-group">
                            <label>Birthdate</label><br>
                            <input id="birthDate" name="birthDate" placeholder="Choose a Date" type="date" value="<?php echo $user->getBirthDate(); ?>">
                        </div>
                        <div class="form-group">
                            <label>Gender</label><br>
                            <select id="genderField" name="gender">
                                <option class="text" value="null" style="color:#ACACAC;" disabled>Choose Gender</option>
                                <option class="text" value="male">Male</option>
                                <option class="text" value="female">Female</option>
                                <option class="text" value="pnts">Prefer not to say</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Color Scheme</label><br>
                            <select id="colorField" name="colorScheme">
                                <option class="text" value="null" style="color:#ACACAC;" disabled>Choose Color</option>
                                <option class="text" value="7E6BC4">Purple</option>
                                <option class="text" value="F34C4C">Red</option>
                                <option class="text" value="8BCF64">Green</option>
                                <option class="text" value="6AB1EF">Blue</option>
                                <option class="text" value="FC9F61">Orange</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="updateProfileBtn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Picture Modal -->
    <div class="modal fade" id="changePicture" tabindex="-1" role="dialog" aria-labelledby="changePicture" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <input id="profilePictureFile" type="file" name="fileToUpload">
                        <input id="uploadPP" type="button" value="upload profile">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Cover Modal -->
    <div class="modal fade" id="changeCover" tabindex="-1" role="dialog" aria-labelledby="changeCover" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <input id="coverPictureFile" type="file" name="fileToUpload">
                        <input id="uploadCP" type="button" value="upload cover">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    $(document).ready(function() {
        // to enable solid background for navbar
        $(window).scroll(function() {
          if($(this).scrollTop() > 300) { 
              $('.navbar').addClass('solid');
          } else {
              $('.navbar').removeClass('solid');
          }
        });

        // enable auto sizing
        autosize($('textarea'));

        // Update Profile
        $('#updateProfileBtn').click(function() {
            var fname = $('#firstName').val();
            var lname = $('#lastName').val();
            var bdate = $('#birthDate').val();
            var gender = $('#genderField').val();
            var color = $('#colorField').val();

            $.ajax({
                url: "../controller/updateProfile.php",
                method: "POST",
                data: {
                    fname: fname,
                    lname: lname,
                    bdate: bdate,
                    gender: gender,
                    color: color
                },
                success: function(data){
                    console.log(data);
                    //refresh page if success
                },
                error: function() {
                    alert("Something went wrong");
                }
            });
        });

        // Create Post
        $('#postBtn').click(function() {
            var file_data = $('#imgFile').prop('files')[0]; 
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            form_data.append('content', $("#content").val());
            $.ajax({
                url: '../controller/addPost.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                    console.log(data);
                },
                error: function() {
                    alert("Something went wrong");
                }
            });
        });

        // Change Profile Picture AJAX
        $('#uploadPP').on('click', function() {
            var file_data = $("#profilePictureFile").prop("files")[0];   
            var form_data = new FormData();
            form_data.append("file", file_data);
            $.ajax({
                url: "../controller/uploadPicture.php",
                dataType: 'script',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(data){
                    if(data == 'success') {
                        // refresh page
                    } else {
                        alert(data);
                    }
                },
                error: function() {
                    alert("Something went wrong");
                }
            });
        });

        $('#uploadCP').on('click', function() {
            var file_data = $("#coverPictureFile").prop("files")[0];   
            var form_data = new FormData();
            form_data.append("file", file_data);
            $.ajax({
                url: "../controller/uploadCover.php",
                dataType: 'script',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                    if(data == 'success') {
                        // refresh page
                    }
                },
                error: function() {
                    alert("Something went wrong");
                }
            });
        });
    });
</script>

</html>