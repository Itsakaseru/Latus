<!DOCTYPE html>
<html>

<head>
    <title>Latus - Register</title>
    <link rel="stylesheet" href="../assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/register.css?ver=1.0.0">
    <script src="../assets/jquery-3.4.1.js"></script>
    <script src="../assets/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LeBWeAUAAAAAFIhxy6TeOdYJOCGK0hSNTpW1dKD"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico"/>
</head>

<body id="register">
    <div class="container h-100 justify-content-center pt-4 pb-4">
        <div class="row h-100">
            <div id="cardContainer" class="card mx-auto my-auto col-10 col-md-6 col-lg-4 col-xl-4 shadow" style="height: 53rem;">
                <div class="card-body">
                    <div class="row justify-content-center mt-4">
                        <h2>Create new account</h2>
                    </div>
                    <div class="row justify-content-center" style="margin-top: 3rem;">
                        <div id="alertBox" class="alert alert-danger" style="display:none">
                            <a id="fieldsErr" style="display: none;">All fields should not be empty.</a>
                            <a id="userError" style="display: none;">Email is already taken!</a>
                            <a id="captchaFail" style="display: none;">Could not load reCAPTCHA. Please try again.</a>
                            <a id="retypeErr" style="display: none;">Password doesn't match.</a>
                            <a id="emailErr" style="display: none;">Email is not valid.</a>
                            <a id="queryErr" style="display: none;">Query error. Please contact administrator.</a>
                            <a id="phpErr" style="display: none;">An error occured. Please try again.</a>
                        </div>
                        <div id="successBox" class="alert alert-success" style="display:none">
                            <a id="successMsg" style="display: none;">Registration complete. Redirecting to login page.</a>
                        </div>
                        <form id="registForm" onsubmit="return(false)">
                            <div class="form-group">
                                <input id="firstName" class="inputField" name="firstName" type="text" class="form-control" placeholder="First name" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="lastName" class="inputField" name="lastName" type="text" class="form-control" placeholder="Last name" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="email" class="inputField" name="email" type="email" class="form-control" placeholder="Email" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="password" class="inputField" name="password" type="password" class="form-control" placeholder="Password" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="confirmPassword" class="inputField" name="confirmPassword" type="password" class="form-control" placeholder="Confirm password" maxlength="">
                            </div>
                            <div class="form-group">
                                <label>Birthdate</label><br>
                                <input id="birthDate" class="dateField" name="birthDate" placeholder="Choose a Date" type="date">
                            </div>
                            <div class="form-group">
                                <label>Gender</label><br>
                                <select id="genderField" class="genderField" name="gender">
                                    <option class="text" value="null" style="color:#ACACAC;" disabled selected>Choose Gender</option>
                                    <option class="text" value="m">Male</option>
                                    <option class="text" value="f">Female</option>
                                    <option class="text" value="p">Prefer not to say</option>
                                </select>
                            </div>
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                            <br>
                            <div class="form-group text-center mt-md-4 mt-lg-1 mt-sm-4">
                                <input id="registerBtn" name="register" type="submit" class="btn" onclick="registerUser()" value="Register">
                            </div>
                        </form>
                    </div>
                    <footer class="mt-4">LATUS &copy;2020</footer>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('#genderField').css('color', '#ACACAC');
        $('#genderField').change(function () {
            var current = $('#genderField').val();
            if (current != 'null') {
                $('#genderField').css('color', 'black');
            } else {
                $('#genderField').css('color', '#ACACAC');
            }
        });
        $('#dateField').css('color', '#ACACAC');
        $('#dateField').change(function() {
            var currentDate = $(this).val();
            if (currentDate != 'null') {
                $(this).css('color', 'black');
            } else {
                $(this).css('color', '#ACACAC');
            }
        })
    });

    // captcha v3 code
    grecaptcha.ready(function() {
        grecaptcha.execute('6LeBWeAUAAAAAFIhxy6TeOdYJOCGK0hSNTpW1dKD', { action: 'registerUser' }).then(function (token) {
            $('#recaptchaResponse').val(token); // enter token to hidden form input
        });
    });

    function registerUser() {
        // hide every messages
        $('#successBox').hide();
        $('#alertBox').hide();
        $('#fieldsErr').hide();
        $('#captchaFail').hide();
        $('#retypeErr').hide();
        $('#queryErr').hide();
        $('#phpErr').hide();

        var fname = $('#firstName').val();
        var lname = $('#lastName').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var retype = $('#confirmPassword').val();
        var birthDate = $('#birthDate').val();
        var gender = $('#genderField').val();
        var captchaBox = $('#recaptchaResponse').val();

        var checkDOB;

        if(!Date.parse(birthDate)) {
            checkDOB = 'false';
        }

        if(fname != '' && lname != '' && email != '' && password != '' && checkDOB != 'false' && gender != 'null') {
            if(captchaBox != '') {
                if(password == retype) {
                    $.ajax({
                        url: "../controller/register.php",
                        method: "POST",
                        data: {
                            fname: fname,
                            lname: lname,
                            email: email,
                            password: password,
                            birthDate: birthDate,
                            gender: gender,
                            captchaBox: captchaBox
                        },
                        success: function(data) {
                            if(data == "true") {
                                $('#cardContainer').css('height','58rem');
                                $('#successBox').show();
                                $('#successMsg').show();
                                setTimeout(function(){
                                    window.location.href = "../login";
                                }, 3000);
                            }
                            else if(data == "captchaErr") {
                                $('#cardContainer').css('height','58rem');
                                $('#alertBox').show();
                                $('#captchaFail').show();
                            }
                            else if(data == "empty") {
                                $('#cardContainer').css('height','57rem');
                                $('#alertBox').show();
                                $('#fieldsErr').show();
                            }
                            else if(data == "errEmail") {
                                $('#cardContainer').css('height','57rem');
                                $('#alertBox').show();
                                $('#emailErr').show();
                            }
                            else if(data == "userError") {
                                $('#cardContainer').css('height','57rem');
                                $('#alertBox').show();
                                $('#userError').show();
                            }
                            else {
                                $('#cardContainer').css('height','57rem');
                                $('#alertBox').show();
                                $('#queryErr').show();
                                console.log(data);
                            }
                        },
                        error: function() {
                            $('#cardContainer').css('height','57rem');
                            $('#alertBox').show();
                            $('#phpErr').show();
                        }
                    });
                }
                else {
                    $('#cardContainer').css('height','57rem');
                    $('#alertBox').show();
                    $('#retypeErr').show(); // show retypeErr element
                }
            }
            else {
                $('#cardContainer').css('height','57rem');
                $('#alertBox').show();
                $('#captchaFail').show();
            }
        }
        else {
            $('#cardContainer').css('height','57rem');
            $('#alertBox').show();
            $('#fieldsErr').show(); // show fieldsErr element
        }
    }

</script>
</html>
