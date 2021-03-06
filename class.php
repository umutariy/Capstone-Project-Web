<?php
/** written by Brian Martey
*/
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
include_once("adb.php");
/**
*classes  class
*/
class classes extends adb{
	function classes(){
	}
	/**
	*get class
	*returns a boolean true if successful, else, false
	*/

	function getclasses(){
		$strQuery="select cno,cname from class";
		$result = $this->query($strQuery);
		if ($result){
			return $result;
		}else{
			return $result;
		}
	}

	/**
	*get class count
	*returns a boolean true if successful, else, false
	*/

	function getclassno(){
		$strQuery="select count(cno) from class";
		$result = $this->query($strQuery);
		if ($result){
			return $result;
		}else{
			return $result;
		}
	}

	/**
	*get class
	*@param string info  
	*/

	function getclass($info){
			$strQuery="select cno,cname from class where cno = '%$info%' or cname like '%$info%'";
			$result = $this->query($strQuery);
	}

	/**
	*add class
	*@param int cno
	*@param string cname  
	*/

	function addclass($cno,$cname){
		$strQuery="insert into class set cno='$cno',cname='$cname'";
		$result = $this->query($strQuery);
	}

	/**
	*get teachers class
	*@param int uid 
	*/
	function getteachersclass($uid){
		$strQuery="select grade from users where UID ='$uid' and LEVEL =3";
		$result = $this->query($strQuery);
	}

	/**
	*get class number
	*@param int grade
	*@param int schoolid  
	*/
	function getclassesno($grade,$schoolid){
		$strQuery="select count(grade) from users where LEVEL= 2 and grade ='$grade' and SCHOOLID ='$schoolid'";
		$result = $this->query($strQuery);
	}

	/**
	*get class name
	*@param int cno
	*/
	function getclassname($cno){
		$strQuery="select cname from class where cno ='$cno'";
		$result = $this->query($strQuery);
	}
			
}
?>