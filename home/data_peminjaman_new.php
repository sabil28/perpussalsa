<?php
session_start();
require_once("koneksi.php");

// Ambil id_anggota dari session
$id_anggota = $_SESSION['id_anggota'];

// Query untuk mendapatkan data peminjaman anggota
$query = "SELECT * FROM peminjaman WHERE agt_id = '$id_anggota'";
$result = mysqli_query($koneksi, $query);

// Cek apakah ada data peminjaman
if(mysqli_num_rows($result) > 0) {
    // Tampilkan data peminjaman
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID Peminjaman: " . $row["id_peminjaman"]. " - Nama Peminjam: " . $row["nama_pinjam"]. " - Tanggal Peminjaman: " . $row["tgl_peminjaman"]. "<br>";
        // Tambahkan bagian lain dari data peminjaman yang ingin ditampilkan
    }
} else {
    echo "Belum ada data peminjaman untuk anggota ini.";
}
mysqli_close($koneksi);
?>
