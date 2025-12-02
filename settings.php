<?php
include "koneksi.php";

// Kalau form disubmit
if (isset($_POST['save'])) {
    $pm = $_POST['pm_threshold'];

    mysqli_query($koneksi, "UPDATE settings SET pm_threshold='$pm' WHERE id=1");

    echo "<script>alert('Pengaturan berhasil disimpan!');</script>";
}

// Ambil nilai dari database
$result = mysqli_query($koneksi, "SELECT * FROM settings WHERE id=1");
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengaturan Sistem</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav style="background:#1F2A30; padding:12px; margin-bottom:20px;">
    <a href="index.php" style="color:white; margin-right:20px; text-decoration:none;">Dashboard</a>
    <a href="history.php" style="color:white; margin-right:20px; text-decoration:none;">History</a>
    <a href="settings.php" style="color:white; text-decoration:none;">Settings</a>
</nav>

<h2>Pengaturan Sistem</h2>

<form method="POST">
    <label>Batas Maksimal PM2.5 (µg/m³)</label>
    <input type="number" name="pm_threshold" value="<?= $data['pm_threshold'] ?>" required>

    <button type="submit" name="save">Simpan</button>
</form>

</body>
</html>
