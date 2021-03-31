<?php
	$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

	switch ($action) {
		case 'add' :
		doInsert();
		break;

		case 'edit' :
		doEdit();
		break;

		case 'assign' :
		doAssign();
		break;
	}


	function doInsert() {

		include_once('../db.php');

		$sid=$_POST['sid'];
		$sfname=$_POST['sfname'];
		$slname=$_POST['slname'];
		$ssex=$_POST['ssex'];
		$sdob=$_POST['sdob'];
		$sag=$_POST['sag'];
		$snat=$_POST['snat'];
		$sadd=$_POST['sadd'];
		$scont=$_POST['scont'];
		$sem=$_POST['sem'];
		$sgn=$_POST['sgn'];
		$sgnu=$_POST['sgnu'];
		$sciv=$_POST['sciv'];

		$sql = "INSERT INTO `students`(`enrolement_id`, `student_first_name`, `student_last_name`, `student_sex`, `student_dob`, `student_age`, `student_nationality`, `student_address`, `student_contact_number`, `student_email`, `student_guardian`, `student_guradian_number`, `student_civil`) 
		VALUES ('$sid','$sfname','$slname','$ssex', '$sdob', '$sag', '$snat', '$sadd', '$scont', '$sem', '$sgn', '$sgnu', '$sciv')";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
	}

	function doEdit() {

		include_once('../db.php');

		$sid=$_POST['sid'];
		$sfname=$_POST['sfname'];
		$slname=$_POST['slname'];
		$scont=$_POST['scont'];
		$sem=$_POST['sem'];
		$sgn=$_POST['sgn'];
		$sgnu=$_POST['sgnu'];

		$sql = "UPDATE `students` SET `student_first_name` = '$sfname', `student_last_name` = '$slname',
		`student_contact_number` = '$scont', `student_email` = '$sem', `student_guardian` = '$sgn', 
		`student_guradian_number` = '$sgnu' WHERE `student_id` = '$sid'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);

	}

	function doAssign() {

		include_once('../db.php');

		$sid=$_POST['sid'];
		$cid=$_POST['cid'];

		$sql = "INSERT INTO `student_courses` (`student_id`, `course_id`) VALUES ('$sid', '$cid')";
		if (mysqli_query($conn, $sql)) {
			$sql = "SELECT * FROM `modules` WHERE `course_id` = '$cid'";
			$result = mysqli_query($conn, $sql);
			while ($list = mysqli_fetch_assoc($result)) {
				$mid = $list['module_id'];
				$sql = "INSERT INTO `student_modules` (`student_id`,`module_id`) VALUES ('$sid', '$mid')";
				mysqli_query($conn, $sql);
			}
			echo json_encode(array("statusCode"=>200));
		} else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
	}
?>