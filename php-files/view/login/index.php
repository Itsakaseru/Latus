<!DOCTYPE html>
<html>

<head>
    <title>Latus</title>
    <link rel="stylesheet" href="assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css?ver=1.0.0">
    <script src="assets/jquery-3.4.1.js"></script>
    <script src="assets/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        $('#loginForm').submit(function() {
            return false;
        });

        function login() {
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
                            $('#userErr').show();
                        }
                        else if(data == "passError") {
                            $('#pwErr').show();
                        }
                        else {
                            localStorage.setItem("token", data);
                            window.location.href = "../feed";
                        }
                    },
                    error: function() {
                        $('#phperr').show();
                    }
                });
            }
        }
    </script>
</head>

<body id="login">
    <div class="container h-100 justify-content-center">
        <div class="row h-100">
            <div class="card mx-auto my-auto col-10 col-md-6 col-lg-4 col-xl-4 shadow" style="height: 30rem;">
                <div class="card-body">
                    <div class="row justify-content-center mt-4">
                        <img class="img-fluid" src="assets/img/web/logo.svg" alt="Latus Logo" width="120px;">
                    </div>
                    <div class="row justify-content-center" style="margin-top: 3rem;">
                        <form id="loginForm" method="post">
                            <div class="form-group">
                                <input id="username" name="username" type="text" class="form-control" placeholder="Username" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="password" name="password" type="password" class="form-control" placeholder="Password" maxlength="">
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button id="loginBtn" name="login" type="submit" onclick="login()" class="btn">Login</button>
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
