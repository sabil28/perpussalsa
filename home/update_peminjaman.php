<?php
// Koneksi ke database
include 'koneksi.php';

// Mendapatkan data dari form
$id_peminjaman = $_POST['idp'];
$id_agt = $_POST['anggota'];
$id_buku = $_POST['buku'];
$tgl_peminjaman = $_POST['tanggalp'];
$nama_pinjam = $_POST['nama'];
$tgl_pengembalian_r = $_POST['tanggalpr'];
$tgl_pengembalian_a = $_POST['tanggalpa'];
$jumlah_pinjam = $_POST['jumlah'];
$catatan = $_POST['catatan'];

// Update tabel peminjaman
$query_peminjaman = "UPDATE tb_peminjaman SET
                    agt_id = '$id_agt',
                    buku_id = '$id_buku',
                    tgl_peminjaman = '$tgl_peminjaman',
                    nama_pinjam = '$nama_pinjam',
                    tgl_pengembalian_r = '$tgl_pengembalian_r',
                    tgl_pengembalian_a = '$tgl_pengembalian_a',
                    jumlah_pinjam = '$jumlah_pinjam',
                    catatan = '$catatan'
                    WHERE id_peminjaman = '$id_peminjaman'";

$result_peminjaman = mysqli_query($koneksi, $query_peminjaman);

if (!$result_peminjaman) {
    die("Gagal melakukan update pada tabel peminjaman: " . mysqli_error($koneksi));
}

// Update tabel riwayat
$query_riwayat = "UPDATE tb_riwayat_peminjaman SET
                id_agt = '$id_agt',
                id_bku = '$id_buku',
                tgl_peminjaman = '$tgl_peminjaman',
                tgl_pengembalian = '$tgl_pengembalian_a'
                WHERE id_pinjam = '$id_peminjaman'";

$result_riwayat = mysqli_query($koneksi, $query_riwayat);

if (!$result_riwayat) {
    die("Gagal melakukan update pada tabel riwayat: " . mysqli_error($koneksi));
}

// Tutup koneksi ke database
mysqli_close($koneksi);

// Redirect ke halaman lain setelah berhasil melakukan update
echo '<script language="javascript" type="text/javascript">
    alert("Data peminjaman berhasil diupdate.");</script>';
echo "<meta http-equiv='refresh' content='0; url=peminjaman.php'>";
?>