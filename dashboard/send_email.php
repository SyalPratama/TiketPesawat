<?php
// Termasuk PHPMailer dan autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Jika pakai composer, atau bisa download PHPMailer dan load file-nya

// Ambil data yang sudah diproses sebelumnya
$namaLengkap = $nama_lengkap; 
$email = $email;
$noHp = $no_hp;
$tanggalBerangkat = $tanggal_berangkat;
$dariKota = $dari_kota;
$keKota = $ke_kota;
$jumlahPenumpang = $jumlah_penumpang;
$hargaTiket = $harga_tiket;

// Hitung Total Bayar
$totalBayar = $hargaTiket * $jumlahPenumpang;
$totalBayarFormatted = number_format($totalBayar, 0, ',', '.');

// Kirim email konfirmasi
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com'; // Ganti dengan email kamu
    $mail->Password = ''; // Ganti dengan password atau app password Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('your-email@gmail.com', 'TiketPesawatKu');
    $mail->addAddress($email, $namaLengkap); // Kirim ke email user

    // Konten email
    $mail->isHTML(true);
    $mail->Subject = 'Konfirmasi Pembelian Tiket Pesawat';
    $mail->Body = "
    <html>
    <head>
        <title>Konfirmasi Pembelian Tiket Pesawat</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body style='font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px;'>
        <div class='container' style='background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>
            <h2 class='text-center mb-4' style='color: #007bff;'>Konfirmasi Pembelian Tiket Pesawat</h2>
            <p class='lead'>Terima kasih telah memesan tiket di <strong>TiketPesawatKu</strong>. Berikut adalah detail pemesanan Anda:</p>
            
            <div class='row'>
                <div class='col-md-6'>
                    <p><strong>Nama Lengkap:</strong> $namaLengkap</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>No. HP:</strong> $noHp</p>
                </div>
                <div class='col-md-6'>
                    <p><strong>Tanggal Berangkat:</strong> $tanggalBerangkat</p>
                    <p><strong>Dari Kota:</strong> $dariKota</p>
                    <p><strong>Ke Kota:</strong> $keKota</p>
                </div>
            </div>
            
            <hr>
            
            <h5 class='text-center mb-4' style='color: #007bff;'>Rincian Pembayaran</h5>
            <table class='table table-bordered'>
                <thead class='table-light'>
                    <tr>
                        <th scope='col'>Jumlah Penumpang</th>
                        <th scope='col'>Harga per Penumpang</th>
                        <th scope='col'>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$jumlahPenumpang</td>
                        <td>Rp $hargaTiket</td>
                        <td>Rp $totalBayarFormatted</td>
                    </tr>
                </tbody>
            </table>
            
            <p class='mt-4'>Semoga perjalanan Anda menyenankan! Untuk pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
            <p class='mt-4 text-bold' style='color: red;'>Note: Lakukan pembayaran saat di bandara untuk mengantisipasi kesalahan sistem.</p>

            
            <hr>
            
            <p class='text-center' style='font-size: 0.9rem; color: #6c757d;'>© 2025 TiketPesawatKu. Semua hak dilindungi.</p>
        </div>
    </body>
    </html>
";


    // Kirim email
    $mail->send();

    // Redirect ke halaman sukses
    header("Location: sukses.php?nama=$namaLengkap&total=$totalBayarFormatted");
    exit;
} catch (Exception $e) {
    echo "Terjadi kesalahan saat mengirim email: {$mail->ErrorInfo}";
}
?>
