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

<body id="profile">
    <header data-toggle="modal" data-target="#changeCover"></header>
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
                            <a>Itsakaseru &nbsp;</a>
                            <img id="accImg" src="../assets/img/users/itsakaseru.png" alt="itsakaseru" width="30px">
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
                            <img id="profilePicture" class="rounded-circle" src="../assets/img/users/itsakaseru.png" width="160px;" style="border: 5px solid #7E6BC4; border-style: outset;">
                            <div class="middle">
                                <div class="text">Change Picture</div>
                            </div>
                        </div>
                        <div id="profileName" class="row justify-content-center mt-3 pl-3 pr-3" style="text-align: center;">
                            Remueru Itsakaseru
                        </div>
                        <hr style="border: 1px solid #B1B1B1">
                        <div class="profileDetail row justify-content-center">
                            20 years old
                        </div>
                        <div class="profileDetail row justify-content-center">
                            727 total posts
                        </div>
                        <div id="profileControl" class="row justify-content-center mt-4">
                            <a><i class="fas fa-edit"></i> edit profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg ml-3 mr-3">

                <div class="row mb-md-4 mb-4">
                    <div class="card col-lg-12 pt-3 pb-3">
                        <form id="createPost" class="col">
                            <div class="row">
                                <textarea id="content" class="inputField form-control" rows="1" name="content" maxlength="256" placeholder="me want post something..."></textarea>
                            </div>
                            <div class="row mt-3">
                                <div class="col p-0">
                                    <button id="imgBtn" name="postContent" type="button" class="btn"><i class="fas fa-file-image"></i></button>  
                                </div>
                                <div class="col p-0">
                                    <button id="postBtn" class="float-right" name="postContent" type="button" class="btn">post</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    
                </div><!-- End of new post-->

                <div class="row">

                    <div class="containerPost card col-lg-12 pt-3 pb-3 mb-5">
                        <div class="row pl-3 d-flex">
                            <div class="col-5 col-sm-7 col-md-9 align-self-start d-flex">
                                <img class="profilePicture rounded-circle" src="../assets/img/users/itsakaseru.png" width="50px;" style="border: 2px solid #7E6BC4">
                                <span class="postName ml-md-3 my-auto">Remueru Itsakaseru</span>
                            </div>
                            <div class="col-7 col-sm-5 col-md-3 my-auto d-flex">
                                <span class="ml-auto mr-3">Apr, 14 2020</span>
                            </div>
                        </div>
                        <div class="row pl-3 pt-3">
                            <div class="col">
                                KOKO DA YO~
                            </div>
                        </div>
                        <hr>
                        <div class="commentContainer row pl-md-3 mb-3">
                            <div class="col-1 align-self-start d-flex">
                                <img class="profilePicture rounded-circle" src="../assets/img/users/giovanna.png" width="50px;" style="border: 2px solid #7E6BC4">
                            </div>
                            <div class="col-11 d-flex pl-0 pl-md-3">
                                <span class="comment my-auto mr-4 mr-sm-3 ml-3 ml-sm-0"><strong>Hans Adhitio</strong> This is a text that will show anything in the comment section of this person original POST who play osu! some counter strike and arknights</span>
                            </div>
                        </div>

                        <div class="commentContainer row pl-md-3 mb-3">
                            <div class="col-1 align-self-start d-flex">
                                <img class="profilePicture rounded-circle" src="../assets/img/users/giovanna.png" width="50px;" style="border: 2px solid #7E6BC4">
                            </div>
                            <div class="col-11 d-flex pl-0 pl-md-3">
                                <span class="comment my-auto mr-4 mr-sm-3 ml-3 ml-sm-0"><strong>Hans Adhitio</strong> This is a text that will show anything in the comment section of this person original POST who play osu! some counter strike and arknights</span>
                            </div>
                        </div>

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
                    </div><!-- End of containerPost -->

                </div><!-- End of x-list post -->

            </div>
        </div><!-- End of contents-->
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

        // Change Profile Picture AJAX
        $('#uploadPP').on('click', function() {
            var file_data = $("#profilePictureFile").prop("files")[0];   
            var form_data = new FormData();
            form_data.append("file", file_data);
            $.ajax({
                url: "controller/uploadPicture.php",
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
                url: "controller/uploadCover.php",
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