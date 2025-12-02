<?php
$koneksi = mysqli_connect("localhost", "root", "", "monitoring_udara");

// cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
