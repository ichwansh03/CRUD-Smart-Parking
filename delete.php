<?php
	include 'config.php';
	$response = array();
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
		$id = $_GET['id'];
		$query_select = "SELECT * FROM tbl_ict WHERE id = '".$id."'";
		$result_select = mysqli_query($conn, $query_select);
		if (mysqli_num_rows($result_select) > 0) {
			$query_delete = "DELETE FROM tbl_ict WHERE id = '".$id."'";
			$result_delete = mysqli_query($conn, $query_delete);
			if ($result_delete) {
				array_push($response, array(
					'status' => 'OK'
				));
			} else {
				array_push($response, array(
					'status' => 'FAILED TO DELETE'
				));
			}
		} else {
			array_push($response, array(
				'status' => 'PRODUCT NOT FOUND'
			));
		}
	} else {
		array_push($response, array(
			'status' => 'FAILED'
		));
	}
	header('Content-type: application/json');
	echo json_encode($response);
?>
