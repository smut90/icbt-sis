<?php

    $action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

    switch ($action) {
        case 'add' :
        doAdd();
        break;
    }


    function doAdd() {
        include_once('../db.php');

        $mid = $_POST['mid'];
        $mg = $_POST['mg'];

        $sql = "UPDATE `student_modules` SET `module_overall_grade` = '$mg' WHERE `student_module_id` = '$mid'";
        if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
    }

?>