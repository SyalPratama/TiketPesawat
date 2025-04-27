<?php 
include '../db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Tiket Pesawat | TiketPesawatKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: white;
            padding: 100px 0;
            position: relative;
            text-align: center;
        }
        .booking-form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            margin-top: -100px;
            position: relative;
            z-index: 10;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
        }
        .feature-box i {
            font-size: 40px;
            margin-bottom: 15px;
            color: #0072ff;
        }
    </style>
</head>
<body>
<?php session_start(); ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">TiketPesawatKu</a>
        <div class="d-flex ms-auto">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="../logout.php" class="btn btn-sm btn-outline-primary">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>


<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1 class="display-4 fw-bold">Pesan Tiket Pesawat dengan Mudah</h1>
        <p class="lead">Dapatkan penawaran terbaik untuk perjalanan Anda.</p>
    </div>
</section>

<!-- Booking Form -->
<section class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="booking-form shadow">
                <h4 class="mb-4 text-center">Cari dan Pesan Tiket Pesawat</h4>
                <form action="proses_pesan.php" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>No. HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal Berangkat</label>
                            <input type="date" name="tanggal_berangkat" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Dari Kota</label>
                            <select name="dari_kota" id="dari_kota" class="form-select" required>
                                <option value="">Pilih Kota Asal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Ke Kota</label>
                            <select name="ke_kota" id="ke_kota" class="form-select" required>
                                <option value="">Pilih Kota Tujuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Jumlah Penumpang</label>
                            <input type="number" name="jumlah_penumpang" min="1" class="form-control" required>
                        </div>
                        <input type="hidden" name="harga_tiket" id="harga_tiket_input">
                        <div class="col-md-12">
                            <div id="harga_tiket" class="alert alert-info text-center fw-bold" style="display: none;">
                                Harga Tiket: <span id="harga_value"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="total_bayar" class="alert alert-success text-center fw-bold" style="display: none;">
                                Total Bayar: <span id="total_value"></span>
                            </div>
                        </div>
                        <div class="col-md-12 d-grid">
                            <button type="submit" class="btn btn-primary btn-lg mt-3">Cari Tiket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Feature Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 feature-box">
                <i class="bi bi-airplane"></i>
                <h5>Pilihan Rute Lengkap</h5>
                <p>Temukan ribuan rute penerbangan di seluruh dunia.</p>
            </div>
            <div class="col-md-4 feature-box">
                <i class="bi bi-wallet2"></i>
                <h5>Harga Kompetitif</h5>
                <p>Dapatkan harga terbaik tanpa biaya tersembunyi.</p>
            </div>
            <div class="col-md-4 feature-box">
                <i class="bi bi-shield-check"></i>
                <h5>Transaksi Aman</h5>
                <p>Transaksi dijamin aman dan data Anda terjaga.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-white text-center py-4 mt-5 border-top">
    <div class="container">
        &copy; 2025 TiketPesawatKu. All Rights Reserved.
    </div>
</footer>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Script untuk ambil data rute dari API -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('http://localhost/tiket-pesawat/dashboard/api_rute.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                let dariKota = new Set();
                let keKota = new Set();
                let semuaRute = data.data;

                data.data.forEach(rute => {
                    dariKota.add(rute.dari_kota);
                    keKota.add(rute.ke_kota);
                });

                const dariSelect = document.getElementById('dari_kota');
                const keSelect = document.getElementById('ke_kota');
                const jumlahPenumpangInput = document.querySelector('input[name="jumlah_penumpang"]');
                const hargaTiket = document.getElementById('harga_tiket');
                const hargaValue = document.getElementById('harga_value');
                const totalBayar = document.getElementById('total_bayar');
                const totalValue = document.getElementById('total_value');
                const hargaTiketInput = document.getElementById('harga_tiket_input'); // Input tersembunyi

                dariKota.forEach(kota => {
                    dariSelect.innerHTML += `<option value="${kota}">${kota}</option>`;
                });

                keKota.forEach(kota => {
                    keSelect.innerHTML += `<option value="${kota}">${kota}</option>`;
                });

                // Tambahkan event listener untuk perubahan pada input
                dariSelect.addEventListener('change', cekHarga);
                keSelect.addEventListener('change', cekHarga);
                jumlahPenumpangInput.addEventListener('input', cekTotalBayar);

                function cekHarga() {
                    const dari = dariSelect.value;
                    const ke = keSelect.value;

                    if (dari && ke) {
                        const rute = semuaRute.find(r => r.dari_kota === dari && r.ke_kota === ke);
                        if (rute) {
                            hargaTiket.style.display = 'block';
                            hargaValue.textContent = formatRupiah(rute.harga);
                            hargaTiketInput.value = rute.harga; // Set harga tiket ke input tersembunyi
                            cekTotalBayar(); // Menghitung total bayar setelah memilih rute
                        } else {
                            hargaTiket.style.display = 'block';
                            hargaValue.textContent = "Rute tidak ditemukan!";
                            totalBayar.style.display = 'none';
                        }
                    } else {
                        hargaTiket.style.display = 'none';
                        totalBayar.style.display = 'none';
                    }
                }

                function cekTotalBayar() {
                    const harga = parseInt(hargaTiketInput.value); // Mengambil harga tiket dari input tersembunyi
                    const jumlahPenumpang = parseInt(jumlahPenumpangInput.value);
                    
                    if (harga && jumlahPenumpang > 0) {
                        const total = harga * jumlahPenumpang;
                        totalBayar.style.display = 'block';
                        totalValue.textContent = formatRupiah(total);
                    } else {
                        totalBayar.style.display = 'none';
                    }
                }

                function formatRupiah(angka) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka).replace(",00", "");
                }

            } else {
                alert('Gagal memuat data rute.');
            }
        })
        .catch(error => {
            console.error('Error fetching rute:', error);
            alert('Terjadi kesalahan saat mengambil data rute.');
        });
});
</script>

</body>
</html>
