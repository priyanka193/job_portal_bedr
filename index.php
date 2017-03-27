<!DOCTYPE html>
<html>
<head>
	<title>Job Portal</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$(".unsavedButton").click(function(){
			$(this).val('Saved');
			$(this).removeClass("unsavedButton").addClass("savedButton");
		});
	});
	
	$(document).ready(function(){
		$("#statusBarButton").click(function(){
			$(this).val('Sent!');
		});
	});
	</script>
</head>
<body>


<?php
	$user_id = $_GET["id"];
	$dbh = pg_connect("host='ec2-54-243-185-132.compute-1.amazonaws.com' dbname='d2ftjp5a24rakj' user='qqyirgarmsgczz' password='ae82f9bb4e7403bb24d558a33481c09dcad90e4520a9581cde72547a9a3063ca'");
	$sql = "SELECT * FROM JOB_SEARCH_RESULTS WHERE participant_id='".$user_id."'"; //'O8NnynqQqP1AG6B0jaKL'";//
	
	$sql1 = "SELECT * FROM PARTICIPANT WHERE participant_id='".$user_id."'"; //'O8NnynqQqP1AG6B0jaKL'";//
	
	if(!$dbh)
		die("error".pg_last_error());
	
	$result = pg_query($dbh,$sql);
	if(!$result)
		die("error".pg_last_error());
	
	$participant_result = pg_query($dbh, $sql1);
	echo '<div class="header clearfix">';
	echo '<input type="button" id="statusBarButton" value="Send Info">';
	echo '<p class="white"> Hello '.pg_fetch_array($participant_result)[0].'</p></div>';
	echo '<div class="jobpage"><h3 class="center">Your Personalized Job Postings</h3>';

	$saved_sql = "INSERT INTO JOB_SEARCH_RESULTS(saved_job) VALUES 'true' WHERE participant_id='".$user_id."'";

while($row = pg_fetch_array($result))
	{
		echo '<div class="jobcard">
				<div class="left" ><h3 style="display: inline-block">Job Title: '.$row[6].'</h3></div>';
//		echo '		<form action="">
		echo '<div class="right" ><input id="jobButton" type="button" class="unsavedButton" value="Save Job" /></div>';
  //  			</form>';
   //			$saved_sql = "INSERT INTO JOB_SEARCH_RESULTS(saved_job) VALUES 'true' WHERE participant_id='".$user_id."' AND job_search_id=".$row[2]."'";
   // 			if
		echo	'<p class="grey" >Company Name: '.$row[3].'</p>
				<p class="grey">Location: '.$row[4].'</p>
				<p class="grey">Posted: '.$row[5].'</p>
				<p class="grey">Salary Estimate: </p>
				<p class="black">'.$row[7].'</p>

				
				<a class="link" href="'.$row[2].'" target="_blank"><i class="fa fa-external-link" style="font-size:11px;color:grey;" aria-hidden="true"></i> view job posting</a>
				</div>';
	}
	



	pg_free_result($result);
	pg_close($dbh);
?>

</div>
</body>
</html>
