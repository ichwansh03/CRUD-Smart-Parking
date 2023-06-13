<?php
	include 'config.php';

        //'tbl_ict' sesuaikan dengan nama tabel anda
	$query = "SELECT * FROM `tbl_ict`";
	$msql = mysqli_query($conn, $query);
	$jsonArray = array();

	while ($parking = mysqli_fetch_assoc($msql)) {
		//nama-nama field pada tbl_ict
		$rows['id'] = $parking['id'];
		$rows['name'] = $parking['name'];
		$rows['capacity'] = $parking['capacity'];
		$rows['volume'] = $parking['volume'];

		array_push($jsonArray, $rows);
	}
	echo json_encode($jsonArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
