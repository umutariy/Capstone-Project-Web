<?php
/** written by Brian Martey
*/
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
include_once("adb.php");
/**
*answers  class
*/
class answers extends adb{
	function answers(){
	}
	/**
	*get answers
	*returns a boolean true if successful, else, false
	*/
	//used by student to fill in answers
	function submitanswer($assid, $solution, $correct, $questionid, $studentid, $mark){
			$strQuery="insert into answers set assid='$assid',solution ='$solution', correct_answer = '$correct', questionid = '$questionid', stid = '$studentid', mark = '$mark'";
			$result = $this->query($strQuery);
	}

	/**
	*update answers
	*returns a boolean true if successful, else, false
	*/
	function updateanswer($assid, $solution, $correct, $questionid, $studentid, $mark){
			$strQuery="update answers set solution ='$solution', correct_answer = '$correct', mark = '$mark' where questionid = '$questionid' and stid = '$studentid' and assid='$assid'";
			$result = $this->query($strQuery);
	}

	//used to finalize assignment marks and grade
	function completestatus($assid, $studentid, $marks, $percentage, $lettergrade, $datesubmitted, $date, $tid){
			$strQuery="insert into completed_assignments set aid='$assid', stid = '$studentid', marks ='$marks', percentage='$percentage', lettergrade ='$lettergrade', date_submitted='$datesubmitted', sdate='$date',tid='$tid'";
			$result = $this->query($strQuery);
	}

	//used to set assignments up for parent review
	function reviewstatus($assid, $studentid, $datesubmitted, $tid, $pid){
			$strQuery="insert into review_assignments set aid='$assid', stid = '$studentid', pid ='$pid', date_submitted='$datesubmitted', tid='$tid', status = 'not'";
			$result = $this->query($strQuery);
	}

	//used to update assignments within the review table
	function updatereviewstatus($assid, $studentid, $datesubmitted, $tid, $pid){
			$strQuery="update review_assignments set pid = '$pid', date_submitted='$datesubmitted', status = 'not' where aid='$assid' and stid = '$studentid' and tid='$tid'";
			$result = $this->query($strQuery);
	}

	//used to get the solution from a particular assignment that a student has answered
	function getanswers($assid, $studentid, $questionid){
			$strQuery="select solution from answers where assid='$assid' and questionid = '$questionid' and stid = '$studentid'";
			$result = $this->query($strQuery);
	}

	//used to get all answer related information from a student and assignment specified
	function getanswersinfo($assid, $studentid){
			$strQuery="select solution,correct_answer,questionid,mark from answers where assid='$assid' and stid = '$studentid'";
			$result = $this->query($strQuery);
	}

	//used to update marks of answered assignments
	function updatemark($assid,$questionid, $studentid, $mark){
			$strQuery="update answers set mark = '$mark' where questionid = '$questionid' and stid = '$studentid' and assid='$assid'";
			$result = $this->query($strQuery);
	}
			
}
?>