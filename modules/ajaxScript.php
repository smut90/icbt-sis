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

		$mc = $_POST['mc'];
		$mn = $_POST['mn'];
		$md = $conn -> real_escape_string($_POST['md']);
		$mcid = $_POST['mcid'];
		$ms = $_POST['ms'];

		$sql = "INSERT INTO `modules`(`module_code`, `modeule_name`, `module_description`, `course_id`, `module_semester`) 
		VALUES ('$mc','$mn', '$md', '$mcid', '$ms')";
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

		$mid = $_POST['mid'];
		$mc = $_POST['mc'];
		$mn = $_POST['mn'];
		$mf = $conn -> real_escape_string($_POST['mf']);
		$mcid = $_POST['mcid'];
		$ms = $_POST['ms'];
		

		$sql = "UPDATE `modules` SET `module_code` = '$mc', `modeule_name` = '$mn', 
		`module_description` = '$mf', `course_id` = '$mcid', `module_semester` = '$ms' WHERE `module_id` = '$mid'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);

	}
?>