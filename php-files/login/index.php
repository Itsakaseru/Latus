<!DOCTYPE html>
<html>

<head>
    <title>Latus</title>
    <link rel="stylesheet" href="../assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/login.css?ver=1.0.1.0">
    <script src="../assets/jquery-3.4.1.js"></script>
    <script src="../assets/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        $('#loginForm').submit(function() {
            return false;
        });

        function loginUser() {
            var username = $('#username').val();
            var pw = $('#password').val();
            if(username != '' && pw != '') {
                $.ajax({
                    url: "../controller/login.php", // php controller location
                    method: "POST",
                    data: {
                        username: username,
                        password: pw
                    },
                    success: function(data) {
                        if(data == "userError") {
                            console.log(data);
                            $('#cardContainer').css('height','35rem');
                            $('#alertBox').show();
                            $('#userErr').show();
                        }
                        else if(data == "passError") {
                            $('#cardContainer').css('height','35rem');
                            $('#alertBox').show();
                            $('#pwErr').show();
                        }
                        else if(data == "queryError") {
                            $('#cardContainer').css('height','35rem');
                            $('#alertBox').show();
                            $('#queryErr').show();
                        }
                        else if(data == "true") {
                            localStorage.setItem("token", data);
                            window.location.href = "..";
                        }
                        else {
                            console.log(data);
                        }
                    },
                    error: function() {
                        $('#cardContainer').css('height','35rem');
                        $('#alertBox').show();
                        $('#phpErr').show();
                    }
                });
            }
        }
    </script>
</head>

<body id="login">
    <div class="container h-100 justify-content-center">
        <div class="row h-100">
            <div id="cardContainer" class="card mx-auto my-auto col-10 col-md-6 col-lg-4 col-xl-4 shadow" style="height: 30rem;">
                <div class="card-body">
                    <div class="row justify-content-center mt-4">
                        <img class="img-fluid" src="../assets/img/web/logo.svg" alt="Latus Logo" width="120px;">
                    </div>
                    <div class="row justify-content-center" style="margin-top: 3rem;">
                        <form id="loginForm">
                            <div id="alertBox" class="alert alert-danger" style="display:none">
                                <a id="userErr" style="display:none;">Wrong email or password.</a>
                                <a id="pwErr" style="display:none;">Wrong email or password.</a>
                                <a id="queryErr" style="display:none;">Query error occured.</a>
                                <a id="phpErr" style="display:none;">PHP error occured.</a>
                            </div>
                            <div class="form-group">
                                <input id="username" class="inputField" name="username" type="text" class="form-control" placeholder="Username" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="password" class="inputField" name="password" type="password" class="form-control" placeholder="Password" maxlength="">
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button id="loginBtn" name="login" type="button" onclick="loginUser()" class="btn">Login</button>
                            </div>
                        </form>
                    </div>
                    <footer class="mt-3">LATUS &copy;2020</footer>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
