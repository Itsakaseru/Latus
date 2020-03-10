<!DOCTYPE html>
<html>

<head>
    <title>Latus</title>
    <link rel="stylesheet" href="assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/register.css?ver=1.0.0">
    <script src="assets/jquery-3.4.1.js"></script>
    <script src="assets/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        $('#registForm').submit(function(){
            return false;
        });

        function registerUser() {
            // hide every messages
            $('#fieldsErr').hide();
            $('#queryErr').hide();
            $('#phpErr').hide();

            var fname = $('#firstName').val();
            var lname = $('#lastName').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var retype = $('#confirmPassword').val();
            var birthDate = $('#birthDate').val();
            var gender = $('#genderField').val();

            // alert(fname + ' ' + lname + ' ' + email + ' ' + password + ' ' + retype + ' ' + birthDate + ' ' + gender);
            if(fname != '' && lname != '' && email != '' && password != '' && birthDate != '' && genderField != 'null') {
                // form verification
                if(password == retype) {
                    // post to controller
                }
                else {
                    $('#retypeErr').show(); // show retypeErr element
                }
            }
            else {
                if(fname == '' || lname == '' || email == '' || password == '' || birthDate == '' || genderField =='null') {
                    $('#fieldsErr').show(); // show fieldsErr element
                }
            }
        }
    </script>
</head>

<body id="register">
    <div class="container h-100 justify-content-center pt-4 pb-4">
        <div class="row h-100">
            <div class="card mx-auto my-auto col-10 col-md-6 col-lg-4 col-xl-4 shadow">
                <div class="card-body">
                    <div class="row justify-content-center mt-4">
                        <h2>Create new account</h2>
                    </div>
                    <div class="row justify-content-center" style="margin-top: 3rem;">
                        <form id="registForm" method="post">
                            <p id="fieldsErr" style="color: #ff0000; display: none;">All fields should not be empty.</p>
                            <p id="retypeErr" style="color: #ff0000; display: none;">Password confirmation error.</p>
                            <p id="queryErr" style="color: #ff0000; display: none;">Query error. Please contact administrator.</p>
                            <p id="phpErr" style="color: #ff0000; display: none;">An error occured. Please try again.</p>
                            <div class="form-group">
                                <input id="firstName" name="firstName" type="text" class="form-control" placeholder="First name" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="lastName" name="lastName" type="text" class="form-control" placeholder="Last name" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="password" name="password" type="password" class="form-control" placeholder="Password" maxlength="">
                            </div>
                            <div class="form-group">
                                <input id="confirmPassword" name="confirmPassword" type="password" class="form-control" placeholder="Confirm password" maxlength="">
                            </div>
                            <div class="form-group">
                                <label>Birthdate</label><br>
                                <input id="birthDate" name="birthDate" placeholder="Choose a Date" type="date">
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
                            <br>
                            <div class="form-group text-center mt-md-4 mt-lg-1 mt-sm-4">
                                <button id="registerBtn" name="register" type="submit" class="btn" onclick="registerUser()">Register</button>
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
</script>
</html>
