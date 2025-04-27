<?php
include '../db.php';

// Set Header supaya browser tahu ini JSON
header('Content-Type: application/json');

// Query ambil semua rute
$query = "SELECT * FROM rute";
$result = mysqli_query($conn, $query);

// Simpan hasil ke array
$rute_list = [];

while ($row = mysqli_fetch_assoc($result)) {
    $rute_list[] = [
        'id'         => $row['id'],
        'dari_kota'  => $row['dari_kota'],
        'ke_kota'    => $row['ke_kota'],
        'harga'      => $row['harga'],
    ];
}

// Tampilkan dalam format JSON
echo json_encode([
    'status' => 'success',
    'data' => $rute_list
]);
?>
