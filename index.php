<?php
// index.php — Dashboard utama
?>

<!doctype html>

<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Air Quality Monitoring</title>

  <link rel="stylesheet" href="style.css">
  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

  <!-- NAVBAR -->

  <header class="topbar">
    <div class="container">
      <div class="brand">
        <span class="logo">🌤</span>
        <h1>Air Quality Monitoring</h1>
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
<!-- DATA CARDS -->
<section class="cards">
  <div class="card">
    <div class="label">Temperature</div>
    <div id="card-temp" class="value">-- °C</div>
  </div>
  <div class="card">
    <div class="label">Kelembaban</div>
    <div id="card-hum" class="value">-- %</div>
  </div>
  <div class="card">
    <div class="label">Gas (CO)</div>
    <div id="card-gas" class="value">-- ppm</div>
  </div>
  <div class="card">
    <div class="label">PM2.5</div>
    <div id="card-pm" class="value">-- µg/m³</div>
  </div>
</section>

<!-- STATUS -->
<section class="status-box">
  <div id="aq-status">AIR QUALITY STATUS: --</div>
</section>

<!-- TREND CHART -->
<section class="chart-area">
  <h3>Air Quality Trends</h3>
  <canvas id="trendChart" height="120"></canvas>
</section>

<!-- HISTORY TABLE -->
<section class="history">
  <h3>History Log</h3>
  <div class="table-wrap">
    <table id="history-table">
      <thead>
        <tr>
          <th>Timestamps</th>
          <th>Temp (°C)</th>
          <th>Humidity (%)</th>
          <th>Gas (ppm)</th>
          <th>PM2.5</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data diisi via JS -->
      </tbody>
    </table>
  </div>
</section>

<!-- ABOUT -->
<section class="about">
  <h3>About System</h3>
  <p>Sistem memonitor kualitas udara secara real-time, menampilkan data suhu, kelembapan, gas, dan PM2.5.</p>
</section>
```

  </main>

  <script src="script.js"></script>

</body>
</html>
