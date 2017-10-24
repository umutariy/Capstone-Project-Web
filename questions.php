<?php
/** written by Brian Martey
*/
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
include_once("adb.php");
/**
*questions  class
*/
class questions extends adb{
	function questions(){
	}
	/**
	*get questions
	*returns a boolean true if successful, else, false
	*/
	function getquestions(){
		$strQuery="select qid,qcontent from questions";
		$result = $this->query($strQuery);
		if ($result){
			return $result;
		}else{
			return $result;
		}
	}

	/**
	*get questions based on topic area
	*@param int qno  
	*/
	function getquestion($qno){
			$strQuery="select qid, qcontent from questions where topic_area = '$qno'";
			$result = $this->query($strQuery);
	}

	/**
	*get questions to answer
	*@param int qno
	*/
	function getquestionstoanswer($qno){
			$strQuery="select qid, qcontent, answer from questions where qid = '$qno'";
			$result = $this->query($strQuery);
	}

	/**
	*get question list
	*@param string answer
	*@param string qcontent
	*@param string topic  
	*@param date date
	*/
	function getquestionlist($qcontent, $answer, $topic, $date){
			$strQuery="select qid from questions where qcontent like '%$qcontent%' and answer like '%$answer%' and topic_area = '$topic' and date = '$date'";
			$result = $this->query($strQuery);
	}

	/**
	*add question
	*@param string topic
	*@param string answer
	*@param string qcontent  
	*@param date date
	*returns a boolean true if successful, else, false
	*/
	function addquestion($qcontent, $answer, $topic, $date){
			$strQuery="insert into questions set qcontent='$qcontent',answer ='$answer', topic_area = '$topic', date = '$date'";
			$result = $this->query($strQuery);
	}
			
}
?>