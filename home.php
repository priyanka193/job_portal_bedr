<!DOCTYPE html>
<html>
<head>
	<title>Job Portal</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$(".jobLabel").click(function(){
			if($(this).hasClass("unsavedJob")){
				$(this).removeClass("unsavedJob").addClass("savedJob");
				$(this).text("Added to your Saved Jobs!");
			}
			else{
				$(this).removeClass("savedJob").addClass("unsavedJob");
				$(this).text("Add to your Saved Jobs");
			}
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
	$sql_saved_jobs = "SELECT * FROM JOB_SEARCH_RESULTS WHERE participant_id='".$user_id."' and saved_job='true'"; //'O8NnynqQqP1AG6B0jaKL'";//
	$sql_unsaved_jobs = "SELECT * FROM JOB_SEARCH_RESULTS WHERE participant_id='".$user_id."' and saved_job='false'"; //'O8NnynqQqP1AG6B0jaKL'";//
	$sql_participant = "SELECT * FROM PARTICIPANT WHERE participant_id='".$user_id."'"; //'O8NnynqQqP1AG6B0jaKL'";//
	
	if(!$dbh)
		die("error".pg_last_error());
	
	$result_saved_jobs = pg_query($dbh, $sql_saved_jobs);
	if(!$result_saved_jobs)
		die("error".pg_last_error());
	
	$result_unsaved_jobs = pg_query($dbh, $sql_unsaved_jobs);
	if(!$result_unsaved_jobs)
		die("error".pg_last_error());
	
	$result_participant = pg_query($dbh, $sql_participant);
	if(!$result_participant)
		die("error".pg_last_error());
	
	echo
		'
		<!--<form action="saved.php" method="post">-->
		<div class="header clearfix">
		<!--<input type="submit" id="statusBarButton" value="Save Jobs">-->
		<p class="white"> Hello '.pg_fetch_array($result_participant)[0].'</p></div>
		<div class="jobpage">
			<h3 class="center">Your Saved Job Postings</h3>
		';	
	
	while($row = pg_fetch_array($result_saved_jobs))
	{	
		echo 
			'
			<div class="jobcard">
				<div class="left" ><h3 style="display: inline-block">Job Title: '.$row[6].'</h3></div>
			 
			  <div class="right" >
				<!--<input type="checkbox" id="'.$row[0].'" class="hide" value="'.$row[0].'" name="jobIds[]"/>-->
				<!--<label for="'.$row[0].'" class="unsavedJob jobLabel" >Add to your Saved Jobs</label>-->
			  </div>
				<p class="grey" >Company Name: '.$row[3].'</p>
				<p class="grey">Location: '.$row[4].'</p>
				<p class="grey">Posted: '.$row[5].'</p>
				<p class="grey">Salary Estimate: </p>
				<p class="black">'.$row[7].'</p>
				<a class="link" href="'.$row[2].'" target="_blank"><i class="fa fa-external-link" style="font-size:11px;color:grey;" aria-hidden="true"></i> view job posting</a>
			</div>
			
		<!--</form>-->
			';
	}
	
	echo
		'
			<h3 class="center">Other Job Postings for you:</h3>
		';
		
	while($row = pg_fetch_array($result_unsaved_jobs))
	{	
		echo 
			'
			<div class="jobcard">
				<div class="left" ><h3 style="display: inline-block">Job Title: '.$row[6].'</h3></div>
			 
			  <div class="right" >
				<!--<input type="checkbox" id="'.$row[0].'" class="hide" value="'.$row[0].'" name="jobIds[]"/>-->
				<!--<label for="'.$row[0].'" class="unsavedJob jobLabel" >Add to your Saved Jobs</label>-->
			  </div>
				<p class="grey" >Company Name: '.$row[3].'</p>
				<p class="grey">Location: '.$row[4].'</p>
				<p class="grey">Posted: '.$row[5].'</p>
				<p class="grey">Salary Estimate: </p>
				<p class="black">'.$row[7].'</p>
				<a class="link" href="'.$row[2].'" target="_blank"><i class="fa fa-external-link" style="font-size:11px;color:grey;" aria-hidden="true"></i> view job posting</a>
			</div>
			
		<!--</form>-->
			';
	}
	pg_free_result($result_unsaved_jobs);
	pg_free_result($result_saved_jobs);
	pg_free_result($result_participant);
	pg_close($dbh);
?>

	</div>
  </body>
</html>
