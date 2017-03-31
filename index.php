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
	$sql_joblist = "SELECT * FROM JOB_SEARCH_RESULTS WHERE participant_id='".$user_id."'"; //'O8NnynqQqP1AG6B0jaKL'";//
	
	$sql_participant = "SELECT * FROM PARTICIPANT WHERE participant_id='".$user_id."'"; //'O8NnynqQqP1AG6B0jaKL'";//
	
	if(!$dbh)
		die("error".pg_last_error());
	
	$result = pg_query($dbh,$sql_joblist);
	if(!$result)
		die("error".pg_last_error());
	
	$participant_result = pg_query($dbh, $sql_participant);
	echo
		'
		<form action="saved.php" method="post">
		<div class="header clearfix">
		<input type="submit" id="statusBarButton" value="Save Jobs">
		<p class="white"> Hello '.pg_fetch_array($participant_result)[0].'</p></div>
		<div class="jobpage"><h3 class="center">Your Personalized Job Postings</h3>
		
		';	

	$jobId = 0;
	
while($row = pg_fetch_array($result))
	{	
		echo 
			'
			<div class="jobcard">
				<div class="left" ><h3 style="display: inline-block">Job Title: '.$row[6].'</h3></div>
			 
			  <div class="right" >
				<input type="checkbox" id="'.$row[0].'" class="hide" value="'.$row[0].'" name="'.$jobId++.'"/>
				<label for="'.$row[0].'" class="unsavedJob jobLabel" >Add to your Saved Jobs</label>
			  </div>
				<p class="grey" >Company Name: '.$row[3].'</p>
				<p class="grey">Location: '.$row[4].'</p>
				<p class="grey">Posted: '.$row[5].'</p>
				<p class="grey">Salary Estimate: </p>
				<p class="black">'.$row[7].'</p>
				<a class="link" href="'.$row[2].'" target="_blank"><i class="fa fa-external-link" style="font-size:11px;color:grey;" aria-hidden="true"></i> view job posting</a>
			</div>
			
		</form>
			';
	}
	
	pg_free_result($result);
	pg_free_result($participant_result);
	pg_close($dbh);
?>

</div>
</body>
</html>
