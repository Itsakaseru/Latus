<!DOCTYPE html>
<html>
	<head>
		<title>Quiz Pemweb | View</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/dataTables.bootstrap.min.css">
		<script src="../assets/jquery-3.2.1.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/jquery.dataTables.min.js"></script>
		<script src="../assets/dataTables.bootstrap.min.js"></script>
		<script>
			var table = $('#studentList').DataTable( {
				order: false,
				columns: [
					{ orderable: false },
					{ orderable: false },
					{ orderable: false },
					{ orderable: false },
					{ orderable: false }
				]
			});
		</script>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid" style="margin-left: 5px; margin-right: 5px">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">[IF430] Web Programming</a>
				</div>
				<div class="nav navbar-right">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Student</a></li>
						<li><p id="username" style="font-weight: bold; margin-top: 15px; margin-right: 8px; ">User<p></li>
						<li><button id="logoutBtn" class="btn btn-danger" style="margin-top: 8px; margin-right: 8px;" onclick=logout()>Logout</button><li>
					</ul>
				</div>
			</div>
		</nav>
		<div id="mainPage" class="container" ">
			<table id="studentList" class="table table-striped table-bordered" style="width: 100%;">
				<thead>
					<tr>
						<th>Student Name</th>
						<th>Student NIM</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						include "../include/db_connect.php";
						include "../model/student.php";

						$list = array();

						$query = "SELECT * FROM user ORDER BY RAND() LIMIT 12;";
					    $result = $db->query($query);

						$i = 0;
						while($row = $result->fetch_assoc()) {
							array_push($list, new Disc());
							$list[$i]->setID($row['pic']);
							$list[$i]->setFName($row['firstName']);
							$list[$i]->setLName($row['lastName']);
							$i++;
						}

						foreach($list as $x) {
							echo "<tr>";
							echo "<td>" . $x->getFName() . " " . $x->getLName() . "</td>";
							echo "<td>" . $x->getID() . "</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>
