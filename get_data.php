<?php
include "koneksi.php";

$q = mysqli_query($koneksi, "SELECT * FROM data_sensor ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_assoc($q);

echo json_encode($data);
?>
