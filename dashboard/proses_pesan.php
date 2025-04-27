<?php
include '../db.php';

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap     = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email            = mysqli_real_escape_string($conn, $_POST['email']);
    $no_hp            = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $tanggal_berangkat= mysqli_real_escape_string($conn, $_POST['tanggal_berangkat']);
    $dari_kota        = mysqli_real_escape_string($conn, $_POST['dari_kota']);
    $ke_kota          = mysqli_real_escape_string($conn, $_POST['ke_kota']);
    $jumlah_penumpang = (int)$_POST['jumlah_penumpang'];
    $harga_tiket      = (int)$_POST['harga_tiket']; // Pastikan harga tiket sudah ada

    // Insert ke database
    $query = "INSERT INTO pesanan (nama_lengkap, email, no_hp, tanggal_berangkat, dari_kota, ke_kota, jumlah_penumpang, harga_tiket)
              VALUES ('$nama_lengkap', '$email', '$no_hp', '$tanggal_berangkat', '$dari_kota', '$ke_kota', '$jumlah_penumpang', '$harga_tiket')";

    if (mysqli_query($conn, $query)) {
        // Ambil ID pesanan terbaru yang dimasukkan
        $pesanan_id = mysqli_insert_id($conn);

        // Hitung Total Bayar
        $totalBayar = $harga_tiket * $jumlah_penumpang;
        $totalBayarFormatted = number_format($totalBayar, 0, ',', '.');

        // Kirim email konfirmasi
        include 'send_email.php'; // Panggil file pengiriman email dengan data yang sudah dimasukkan
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Akses tidak valid!";
}
?>
