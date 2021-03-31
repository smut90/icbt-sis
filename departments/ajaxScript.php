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

		$dna= $_POST['dna'];
		$ddd= $conn -> real_escape_string($_POST['ddd']);

		$sql = "INSERT INTO `departments`(`department_name`, `department_description`) 
		VALUES ('$dna','$ddd')";
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

		$did = $_POST['did'];
		$ddn = $_POST['ddn'];
		$ddd = $conn -> real_escape_string($_POST['ddd']);

		$sql = "UPDATE `departments` SET `department_name` = '$ddn', `department_description` = '$ddd'
		WHERE `department_id` = '$did'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);

	}
?>