<?php
	$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

	switch ($action) {
		case 'add' :
		doInsert();
		break;

		case 'edit' :
		doEdit();
		break;
	}


	function doInsert() {

		include_once('../db.php');

		$cn = $_POST['cn'];
		$cd = $conn -> real_escape_string($_POST['cd']);
		$cdd = $_POST['cdd'];

		$sql = "INSERT INTO `courses`(`course_name`, `course_description`, `course_department`) 
		VALUES ('$cn','$cd', '$cdd')";
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

		$cid = $_POST['cid'];
		$cn = $_POST['cn'];
		$cd = $conn -> real_escape_string($_POST['cd']);
		$cdd = $_POST['cdd'];

		$sql = "UPDATE `courses` SET `course_name` = '$cn', `course_description` = '$cd', 
		`course_department` = '$cdd' WHERE `courses_id` = '$cid'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);

	}
?>