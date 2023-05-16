<?php
include 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $capacity = $_POST['capacity'];
    $volume = $_POST['volume'];
  
    $sql = "UPDATE tbl_ict SET name = '".$name."', capacity = '".$capacity."', volume = '".$volume."' WHERE id = '$id';";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'OK', 'message' => 'Berhasil Update Data Produk'));
    } else {
        echo json_encode(array('status' => 'KO', 'message' => 'Gagal Update Data Produk'));
    }
    
    mysqli_close($conn);
}

?>
