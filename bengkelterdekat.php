<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bengkelsicepat";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Koneksi gagal: " . $conn->connect_error]));
}

// Ambil data lokasi user dari request
$latitude = isset($_GET['latitude']) ? $_GET['latitude'] : null;
$longitude = isset($_GET['longitude']) ? $_GET['longitude'] : null;

if (!$latitude || !$longitude) {
    echo json_encode(["error" => "Latitude dan Longitude wajib diisi."]);
    exit;
}

// Query mencari bengkel terdekat (pakai rumus haversine)
$sql = "
    SELECT * FROM bengkel, (
        6371 * acos(
            cos(radians(?)) * cos(radians(latitude)) *
            cos(radians(longitude) - radians(?)) +
            sin(radians(?)) * sin(radians(latitude))
        )
    ) AS jarak
    FROM bengkel
    ORDER BY jarak ASC
    LIMIT 5
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ddd", $latitude, $longitude, $latitude);
$stmt->execute();
$result = $stmt->get_result();

$bengkels = [];
while ($row = $result->fetch_assoc()) {
    $bengkels[] = $row;
}

echo json_encode($bengkels, JSON_PRETTY_PRINT);
?>
