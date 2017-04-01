<html>
<head>
	<title>Job Portal</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>
<body>
	<div class="header clearfix">
		<p class="white"> Hello </p>
	</div>
	<div class="jobpage">
		<h3 class="center">Your jobs are successfuly saved!</h3>

<?php
	$user_id = $_GET["id"];
	$dbh = pg_connect("host='ec2-54-243-185-132.compute-1.amazonaws.com' dbname='d2ftjp5a24rakj' user='qqyirgarmsgczz' password='ae82f9bb4e7403bb24d558a33481c09dcad90e4520a9581cde72547a9a3063ca'");
	//$sql_joblist = "SELECT * FROM JOB_SEARCH_RESULTS WHERE participant_id='".$user_id."'"; //'O8NnynqQqP1AG6B0jaKL'";//
	
	//$sql_participant = "SELECT * FROM PARTICIPANT WHERE participant_id='".$user_id."'"; //'O8NnynqQqP1AG6B0jaKL'";//
	
	$jobIds = implode("', '", $_POST["jobIds"]);
	$jobIds = "'".$jobIds."'";
	
	$sql_update_saved = "UPDATE JOB_SEARCH_RESULTS SET saved_job='true' WHERE job_search_id IN (".$jobIds.")";
	
	echo $sql_update_saved;
    
	$result = pg_query($dbh,$sql_update_saved);
	if(!$result)
		die("error".pg_last_error());
	
	echo $result.' is the result.';
	
	pg_free_result($result);
	pg_close($dbh);
	
?>
	</div>
</body>
</html>