<?php include "koneksi.php"; ?>

<!doctype html>

<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>History - Air Quality Monitoring</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- NAVBAR -->

  <header class="topbar">
    <div class="container">
      <div class="brand">
        <span class="logo">📊</span>
        <h1>History Data</h1>
      </div>

```
  <nav class="navlinks">
    <a href="index.php">Dashboard</a>
    <a href="history.php">History</a>
    <a href="settings.php">Settings</a>
  </nav>
</div>
```

  </header>

  <main class="container">

```
<h2>Riwayat Pembacaan Sensor</h2>

<div class="table-wrap">
  <table id="history-table">
    <thead>
      <tr>
        <th>Timestamps</th>
        <th>Temperature (°C)</th>
        <th>Humidity (%)</th>
        <th>Gas (ppm)</th>
        <th>PM2.5</th>
      </tr>
    </thead>
    <tbody>
      <!-- Diisi dari database jika mau -->
    </tbody>
  </table>
</div>
```

  </main>

</body>
</html>
