<?php
	// credentials, do not change
	$host = "fdb21.atspace.me";
    $dbname = "3336533_cocodb";
    $username = "3336533_cocodb";
    $password = "5@y@B154B3rD1r1";
	
	// change post variables as needed
	$username = '';
	$fname = '';
	$lname = '';
	$email = '';
	$pw = '';
	$salt = '';
	$img = '';
	$gender = '';
	$bdate = '';
	if(isset($_POST['username'])) $username = $_POST['username'];
	if(isset($_POST['fname'])) $fname = $_POST['fname'];
	if(isset($_POST['lname'])) $lname = $_POST['lname'];
	if(isset($_POST['email'])) $email = $_POST['email'];
	if(isset($_POST['pw'])) $pw = $_POST['pw'];
	if(isset($_POST['img'])) $img = $_POST['img'];
	if(isset($_POST['gender'])) $gender = $_POST['gender'];
	if(isset($_POST['bdate'])) $bdate = $_POST['bdate'];
	
	// post check
	if($username != '' && $pw != '') {
		$db = new mysqli($host, $username, $password, $dbname);
		
		// query all users
		$query = "SELECT * from user;";
		$result = $db->query($query);
		$double = 0;
		
		// check for existing username
		while($row = $result->fetch_assoc()) {
			if($row['UserName'] == $username) {
				$double = 1;
				break;
			}
		}
		mysqli_free_result($result);
		
		// if not double then insert to database
		if($double == 0) {
			// randomize salt
			$chars = 'abcdefghijklmnopqrstuvwxyz';
			for($i = 0; $i < 5; $i++) {
				$salt .= $chars[rand(0, 25)]; // concat salt with random char index
			}
			
			$query = "INSERT INTO user (UserName, FirstName, LastName, Email, Password, Salt, Image, Gender, BirthDate) VALUES ('$username', '$fname', '$lname', '$email', '" . hash("sha256", ($pw . $salt)); . "', '$salt', '$img', '$gender', '$bdate');";
			
			// if query returned false
			if(!$db->query($query)) {
				echo $db->error;
			}
		}
		
		mysqli_close($db);
	}
	else {
		// username and password check
	}
?>