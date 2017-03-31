<?php
	//$user_id = $_GET["id"];
	//$dbh = pg_connect("host='ec2-54-243-185-132.compute-1.amazonaws.com' dbname='d2ftjp5a24rakj' user='qqyirgarmsgczz' password='ae82f9bb4e7403bb24d558a33481c09dcad90e4520a9581cde72547a9a3063ca'");
	//$sql_joblist = "SELECT * FROM JOB_SEARCH_RESULTS WHERE participant_id='".$user_id."'"; //'O8NnynqQqP1AG6B0jaKL'";//
	
	//$sql_participant = "SELECT * FROM PARTICIPANT WHERE participant_id='".$user_id."'"; //'O8NnynqQqP1AG6B0jaKL'";//
	
	//$sql_insert_saved = "INSERT INTO JOB_SEARCH_RESULTS(saved_job) VALUES 'true' WHERE job_search_id=".$row[0]."'";
	
	foreach ($_POST as $key => $value) {
    //do something
    echo $key . ' has the value of ' . $value;
}
	
?>