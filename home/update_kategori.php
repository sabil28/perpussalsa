<?php
// Koneksi ke database (gantilah nilai-nilai ini sesuai dengan pengaturan database Anda)
include 'koneksi.php';

// Ambil data dari formulir
$id_kategori = $_POST['id_kategori'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];

// Query SQL untuk memperbarui data anggota
$sql = "UPDATE tb_kategori SET nama_kategori='$nama', deskripsi_kategori='$deskripsi' WHERE id_kategori=$id_kategori";

if ($koneksi->query($sql) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
      alert("Data kategori '.$nama.' berhasil diperbarui.!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=kategori.php'>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
