<?php
// Koneksi ke database (gantilah nilai-nilai ini sesuai dengan pengaturan database Anda)
include 'koneksi.php';

// Ambil data dari formulir
$id_anggota = $_POST['id_anggota'];
$nama_anggota = $_POST['nama'];
$nis_anggota = $_POST['nis'];
$alamat_anggota = $_POST['alamat'];
$nomor_hp_anggota = $_POST['nomorhp'];
$email_anggota = $_POST['email'];
$tanggal_bergabung = $_POST['tanggal'];

// Query SQL untuk memperbarui data anggota
$sql = "UPDATE tb_anggota SET nama_anggota='$nama_anggota', nis='$nis_anggota', alamat='$alamat_anggota', nomor_hp='$nomor_hp_anggota', email='$email_anggota', tgl_bergabung='$tanggal_bergabung' WHERE id_anggota=$id_anggota";

if ($koneksi->query($sql) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
      alert("Data anggota berhasil diperbarui.!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=anggota.php'>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
