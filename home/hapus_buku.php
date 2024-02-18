<?php
// Menggabungkan file koneksi ke database
include 'koneksi.php';

// Mendapatkan ID buku yang akan dihapus dari parameter URL
if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];

    // Mengeksekusi query DELETE
    $query = "DELETE FROM tb_buku WHERE id_buku = $id_buku";

    if (mysqli_query($koneksi, $query)) {
        // Data berhasil dihapus
        echo '<script language="javascript" type="text/javascript">
          alert("Data buku berhasil dihapus!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=buku.php'>";
    } else {
        // Jika terjadi kesalahan dalam query
        echo "Error: " . mysqli_error($koneksi);
    }

    // Menutup koneksi database
    mysqli_close($koneksi);
} else {
    echo "ID buku tidak valid.";
}
?>