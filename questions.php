<!DOCTYPE html>
<html>
<head>
	<title>Job Portal</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<?php
	$user_id = $_GET["id"];
	$dbh = pg_connect("host='ec2-54-243-185-132.compute-1.amazonaws.com' dbname='d2ftjp5a24rakj' user='qqyirgarmsgczz' password='ae82f9bb4e7403bb24d558a33481c09dcad90e4520a9581cde72547a9a3063ca'");

	$sql1 = "SELECT * FROM PARTICIPANT WHERE participant_id='".$user_id."'"; //'O8NnynqQqP1AG6B0jaKL'";//

	if(!$dbh)
		die("error".pg_last_error());

	$participant_result = pg_query($dbh, $sql1);
	if(!$participant_result)
		die("error".pg_last_error());
	echo '<div class="header clearfix">';
	echo '<input type="button" id="statusBarButton" value="Send Info">';
	echo '<p class="white"> Hello '.pg_fetch_array($participant_result)[0].'</p></div>';
	echo '<div class="jobpage"><h3 class="center">Your Personalized Job Postings</h3>';	

	$hours = $_POST["hours"];

	$sql = "UPDATE PARTICIPANT SET week1_hours =".$hours." WHERE participant_id='".$userid."'";
	$result = pg_query($dbh,$sql);
	if(!$result)
		die("error".pg_last_error());
?>
<h3> Thanks! See you next time!</h3> 
</body>
</html>
