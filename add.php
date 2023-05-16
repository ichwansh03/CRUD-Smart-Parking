<?php
	include 'config.php';
	$response = array();
	if (isset($_POST['name']) && isset($_POST['capacity']) && isset($_POST['volume'])) {
		$name = $_POST['name'];
		$capacity = $_POST['capacity'];
		$volume = $_POST['volume'];
		$query = "INSERT INTO tbl_ict (name, capacity, volume) 
		VALUES ('".$name."', '".$capacity."', '".$volume."')";
		$result = mysqli_query($conn, $query);
		if ($result) {
            array_push($response, array(
                'status' => 'OK'
            ));
        } else {
            array_push($response, array(
                'status' => 'FAILED'
            ));
        }
	} else {
		array_push($response, array(
			'status' => 'FAILED IN ISSET'
		));
	}
	header('Content-type: application/json');
	echo json_encode($response);
?>
