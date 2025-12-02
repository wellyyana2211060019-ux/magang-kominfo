<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "monitoring_udara";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari ESP8266
$suhu        = $_POST['temperature'] ?? null;
$kelembaban  = $_POST['humidity'] ?? null;
$gas_status  = $_POST['gas_status'] ?? null;
$debu        = $_POST['dust'] ?? null;

// Cek data lengkap
if ($suhu === null || $kelembaban === null || $gas_status === null || $debu === null) {
    echo "DATA TIDAK LENGKAP";
    exit;
}

// Konversi gas BURUK / BAIK jadi angka CO2 seperti tabel kamu
$co2 = ($gas_status == "BURUK") ? 200 : 50;

// Insert ke tabel (sesuai struktur kamu)
$sql = "INSERT INTO data_sensor (suhu, kelembaban, co2, debu)
        VALUES ('$suhu', '$kelembaban', '$co2', '$debu')";

if ($conn->query($sql) === TRUE) {
    echo "OK";
} else {
    echo "ERROR: " . $conn->error;
}

$conn->close();
?>
