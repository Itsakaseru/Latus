<?php
    $host = "fdb21.atspace.me";
    $dbname = "3336533_cocodb"
    $username = "3336533_cocodb"
    $password = "5@y@B154B3rD1r1";

    $db = new mysqli($host, $username, $password, $dbname);

	$query = "SELECT * FROM test;";
	$result = $db->query($query);

    while($row = $result -> fetch_assoc()) {
		echo $row['testcol'];
	}
	mysqli_free_result($result);
	mysqli_close($db);
?>
