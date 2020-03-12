<!DOCTYPE html>
<html>

<head>
    <title>Latus</title>
    <link rel="stylesheet" href="../assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/login.css?ver=1.0.1.0">
    <script src="../assets/jquery-3.4.1.js"></script>
    <script src="../assets/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script><!-- captcha v2 code
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
    <!-- captcha v3 code -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LeBWeAUAAAAAFIhxy6TeOdYJOCGK0hSNTpW1dKD"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        $('#loginForm').submit(function() {
            return false;
        });

        function loginUser() {
            $('#registerBtn').attr('disabled', true);
            var verify = 0;

            // hide messages
            $('#cardContainer').css('height','30rem');
            $('#alertBox').hide();
            $('#userErr').hide();
            $('#queryErr').hide();
            $('#phpErr').hide();
            $('#captchaFail').hide();

            var username = $('#username').val();
            var pw = $('#password').val();
            var captchaBox = $('#recaptchaResponse').val();

            if(captchaBox != '') {
                if(username != '' && pw != '') {
                    $.ajax({
                        url: "../controller/login.php", // php controller location
                        method: "POST",
                        data: {
                            username: username,
                            password: pw,
                            captchaBox: captchaBox
                        },
                        success: function(data) {
                            if(data == "true") {
                                verify = 1;
                                window.location.href = "..";
                            }
                            else if(data == "queryError") {
                                $('#cardContainer').css('height','35rem');
                                $('#alertBox').show();
                                $('#queryErr').show();
                            }
                            else if(data == "captchaError") {
                                $('#cardContainer').css('height','35rem');
                                $('#alertBox').show();
                                $('#captchaFail').show();
                            }
                            else if(data == "userError" || data == "passError") {
                                $('#cardContainer').css('height','35rem');
                                $('#alertBox').show();
                                $('#userErr').show();
                            }
                            else {
                                $('#queryErr').show();
                            }
                        },
                        error: function() {
                            $('#cardContainer').css('height','35rem');
                            $('#alertBox').show();
                            $('#phpErr').show();
                        }
                    });
                }
                else {
                    $('#cardContainer').css('height','35rem');
                    $('#alertBox').show();
                    $('#captchaFail').show();
                }
            }
            else {
                $('#cardContainer').css('height','35rem');
                $('#alertBox').show();
                $('#fieldsErr').show();
            }

            if(verify == 0) {
                $('#registerBtn').attr('disabled', false);
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
                                <a id="captchaErr" style="display:none;">Could not load reCAPTCHA. Please try again.</a>
                                <a id="userErr" style="display:none;">Wrong email or password.</a>
                                <a id="queryErr" style="display:none;">Query error occured.</a>
                                <a id="fieldsErr" style="display:none;">All fields should not be empty.</a>
                                <a id="phpErr" style="display:none;">PHP error occured.</a>
                            </div>
                            <div class="form-group">
                                <input id="username" class="inputField" name="username" type="text" class="form-control" placeholder="Username" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="password" class="inputField" name="password" type="password" class="form-control" placeholder="Password" maxlength="">
                            </div>
                            <!-- captcha v2 code
                            <div class="form-group">
                                <div id="captchaBox" class="g-recaptcha" data-sitekey="6LchWeAUAAAAAOTVmEc-nL1i7Xrqsf51QpRq6oSS"></div>
                            </div> -->
                            <!-- used to retrieve token from captcha v3 -->
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
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
<script>
// captcha v3 code
grecaptcha.ready(function() {
    grecaptcha.execute('6LeBWeAUAAAAAFIhxy6TeOdYJOCGK0hSNTpW1dKD', { action: 'registerUser' }).then(function (token) {
        $('#recaptchaResponse').val(token); // enter token to hidden form input
    });
});
</script>

</html>
