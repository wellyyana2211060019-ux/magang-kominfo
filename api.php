<?php
header('Content-Type: application/json; charset=utf-8');

// DB config
$host = "127.0.0.1";
$db   = "monitoring_udara";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB connection failed: '.$e->getMessage()]);
    exit;
}

// ==========================
//   RECEIVE FROM ESP8266
// ==========================
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["temperature"]) &&
        isset($_POST["humidity"]) &&
        isset($_POST["gas_status"]) &&
        isset($_POST["dust"])) {

        $sql = "INSERT INTO data_sensor 
                (temperature, humidity, gas_status, dust)
                VALUES (:temperature, :humidity, :gas_status, :dust)";

        $stmt = $pdo->prepare($sql);
        $ok = $stmt->execute([
            ':temperature' => $_POST["temperature"],
            ':humidity'    => $_POST["humidity"],
            ':gas_status'  => $_POST["gas_status"],
            ':dust'        => $_POST["dust"]
        ]);

        echo json_encode(["status" => $ok ? "OK" : "ERROR"]);
        exit;
    }
}

// ==========================
//   API GET (Dashboard)
// ==========================

// latest
$stmt = $pdo->query("SELECT * FROM data_sensor ORDER BY waktu DESC LIMIT 1");
$latest = $stmt->fetch();

// history
$stmt2 = $pdo->query("SELECT * FROM data_sensor ORDER BY waktu DESC LIMIT 24");
$history = $stmt2->fetchAll();

echo json_encode([
    'latest' => $latest ?: new stdClass(),
    'history' => $history
], JSON_UNESCAPED_UNICODE);
