<?php
//panggil koneksi ke database
include 'koneksi.php';
$tanggal_sekarang = date("Y-m-d"); // Tanggal sekarang

$query = "SELECT * FROM tb_peminjaman, tb_buku WHERE id_buku=buku_id AND tgl_pengembalian_a < '$tanggal_sekarang'";
$result = mysqli_query($koneksi, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $judul = $row['judul_buku'];
    $jumlah = $row['jumlah_pinjam'];
    $kelas = $row['nama_pinjam'];
    $status = $row['status_peminjaman'];

    if ($status == 1) {
        $pesan = "Peminjaman buku $judul dengan jumlah $jumlah buku dari kelas $kelas telat dalam pengembalian.";
        echo '<div class="alert alert-danger" role="alert">
            <i class="fa fa-bell"></i> ' . $pesan . '
         </div>';
    }elseif ($status == 3) {
        $pesan = "Peminjaman buku $judul dengan jumlah $jumlah buku dari kelas $kelas telat dalam pengembalian.";
        echo '<div class="alert alert-danger" role="alert">
            <i class="fa fa-bell"></i> ' . $pesan . '
         </div>';
    }
}
?>