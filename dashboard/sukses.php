<?php
// Mengambil data dari query string atau session (sesuai kebutuhan)
$namaLengkap = isset($_GET['nama']) ? $_GET['nama'] : 'Nama Tidak Diketahui';
$totalBayarFormatted = isset($_GET['total']) ? $_GET['total'] : 'Tidak Diketahui';

// Jika ingin menambahkan data lain seperti tanggal atau info lainnya, bisa diletakkan di sini
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container text-center mt-5">
    <h1 class="text-success">🎉 Pesanan Anda Berhasil!</h1>
    <p class="lead">Terima kasih telah memesan tiket bersama TiketPesawatKu.</p>
    
    <div class="alert alert-success">
        <h4 class="alert-heading">Detail Pembelian</h4>
        <p><strong>Nama:</strong> <?php echo htmlspecialchars($namaLengkap); ?></p>
        <p><strong>Total Bayar:</strong> Rp <?php echo $totalBayarFormatted; ?></p>
    </div>

    <a href="index.php" class="btn btn-primary mt-3">Pesan Lagi</a>
</div>

</body>
</html>
