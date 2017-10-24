<?php
/** written by Brian Martey
*/
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
include_once("adb.php");
/**
*Users  class
*/
class users extends adb{
	function users(){
	}
	/**
	*user log in
	*@param string username  
	*@param password login password
	*returns a boolean true if successful, else, false
	*/
	function login($username, $password){
		$strQuery="select * from users where USERNAME = '$username' && PASSWORD = MD5('$password')";
		
		$result = $this->query($strQuery);
		if ($result){
			return $this->fetch();
		}else{
			return $result;
		}
	}

	/**
	*admin log in
	*@param string username  
	*@param password login password
	*returns a boolean true if successful, else, false
	*/
	function adminlogin($username, $password){
		$strQuery="select * from users where LEVEL = '1' && USERNAME = '$username' && PASSWORD = MD5('$password')";
		
		$result = $this->query($strQuery);
		if ($result){
			return $this->fetch();
		}else{
			return $result;
		}
	}

	/**
	*admin add user
	*@param string fname  
	*@param string lname 
	*@param int school
	*@param int level  
	*@param int class
	*/
	function adminadduser($fname, $lname, $school, $level, $class){
		$username = $fname.".".$lname;
		$strQuery="insert into users set FNAME = '$fname', LNAME = '$lname', SCHOOLID = '$school', LEVEL = '$level', USERNAME = '$username',PASSWORD = MD5(1), grade = '$class' ";
		
		$result = $this->query($strQuery);
	}

	/**
	*add user
	*@param string fname  
	*@param string lname
	*@param string username
	*@param string password 
	*@param int school
	*@param int level  
	*@param int class
	*@param int phone
	*@param int email
	*/
	function adduser($fname, $lname, $username, $password, $school, $level, $class, $phone, $email){
		$strQuery="insert into users set FNAME = '$fname', LNAME = '$lname', SCHOOLID = '$school', LEVEL = '$level', USERNAME = '$username',PASSWORD = MD5('$password'), grade = '$class', phone = '$phone', email = '$email' ";
		$result = $this->query($strQuery);
	}

	/**
	*admin get user
	*@param int level 
	*/
	function admingetusers($level){
		$strQuery="select * from users where LEVEL = '$level'";
		
		$result = $this->query($strQuery);
		if ($result){
			return $this->fetch();
		}else{
			return $result;
		}
	}

	/**
	*get children ids for a user
	*@param int id
	*/
	function getchildrenno($id){
		$strQuery="select children from users where UID = '$id'";
		$result = $this->query($strQuery);
	}

	/**
	*get parent ids for a user
	*@param int id
	*/
	function getparentsno($id){
		$strQuery="select parents from users where UID = '$id'";
		$result = $this->query($strQuery);
	}

	/**
	*get student number
	*/
	function getstudentsno(){
		$strQuery="select count(FNAME) from users where LEVEL = '2'";
		$result = $this->query($strQuery);
	}

	/**
	*get teacher number 
	*/
	function getteachersno(){
		$strQuery="select count(FNAME) from users where LEVEL = '3'";
		$result = $this->query($strQuery);
	}
	
	/**
	*get assignment number by a teacher
	*@param int id
	*/
	function getteacherassignments($id){
		$strQuery="select count(description) from assignments where teacherid ='$id'";
		$result = $this->query($strQuery);
	}

	/**
	*get student ids for a class
	*@param int schid
	*@param int grade
	*/
	function getstudentsid($grade,$schid){
		$strQuery="select UID from users where grade ='$grade' and SCHOOLID ='$schid' and LEVEL = 2";
		$result = $this->query($strQuery);
	}

	/**
	*get student information for a class
	*@param int schid
	*@param int grade
	*/
	function getstudentsinfo($grade,$schid){
		$strQuery="select UID, FNAME, LNAME from users where grade ='$grade' and SCHOOLID ='$schid' and LEVEL = 2";
		$result = $this->query($strQuery);
	}

	/**
	*get student names only for a class
	*@param int schid
	*@param int grade
	*/
	function getstudentsnames($grade,$schid){
		$strQuery="select FNAME, LNAME from users where grade ='$grade' and SCHOOLID ='$schid' and LEVEL = 2";
		$result = $this->query($strQuery);
	}

	/**
	*add student to class
	*@param int schid
	*@param int grade
	*@param int tid
	*@param int stid
	*/
	function addstudentstoclass($grade,$schid,$tid,$stid){
		$strQuery="insert into schoolclasses set cno ='$grade', schid ='$schid', tid = '$tid', stid = '$stid'";
		$result = $this->query($strQuery);
	}	

	/**
	*get children info by user
	*@param int id
	*/
	function getchildreninfo($id){
		$strQuery="select u.UID as uid, u.FNAME as fname, u.LNAME as lname, c.cname as name from users as u inner join class as c on c.cno = u.grade where UID = '$id'";
		$result = $this->query($strQuery);
	}

	/**
	*add children info by user
	*@param int childid
	*@param int id
	*/
	function addchildren($childid,$id){
		$strQuery="update users set children ='$childid' where UID = '$id'";
		$result = $this->query($strQuery);
	}

	/**
	*add parents info by user
	*@param int pardid
	*@param int id
	*/
	function addparents($pardid,$id){
		$strQuery="update users set parents ='$pardid' where UID = '$id'";
		$result = $this->query($strQuery);
	}

	/**
	*get student number in class
	*@param int grade
	*@param int schid
	*/
	function getstudentsnoinclass($grade,$schid){
		$strQuery="select count(FNAME) from users where grade ='$grade' and SCHOOLID ='$schid' and LEVEL =2";
		$result = $this->query($strQuery);
	}

	/**
	*get students in class
	*@param int grade
	*@param int schid
	*@param int tid
	*/
	function getstudentsinclass($grade,$schid,$tid){
		$strQuery="select stid from schoolclasses where cno ='$grade' and schid ='$schid' and tid = '$tid'";
		$result = $this->query($strQuery);
	}

	/**
	*get students emails in class
	*@param int grade
	*@param int schid
	*/
	function getstudentsemailsinclass($grade,$schid){
		$strQuery="select email from users where grade ='$grade' and SCHOOLID ='$schid' and LEVEL = '2'";
		$result = $this->query($strQuery);
	}

	/**
	*get students email
	*@param int id
	*/
	function getemails($id){
		$strQuery="select email from users where UID = '$id'";
		$result = $this->query($strQuery);
	}

	/**
	*update students in class
	*@param int grade
	*@param int schid
	*@param int tid
	*@param int stid
	*/
	function updatestudentsinclass($grade,$schid,$tid,$stid){
		$strQuery="update schoolclasses set cno ='$grade', schid ='$schid', tid = '$tid', stid = '$stid'";
		$result = $this->query($strQuery);
	}

	/**
	*get users information
	*@param int id
	*/
	function getusers($id){
		$strQuery="select * from users where UID = '$id'";		
		$result = $this->query($strQuery);
	}
}
?>