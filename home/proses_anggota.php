<?php
// Koneksi ke database (gantilah nilai-nilai ini sesuai dengan pengaturan database Anda)
include 'koneksi.php';

// Ambil data dari formulir
$nama_anggota = $_POST['nama'];
$nis_anggota = $_POST['nis'];
$alamat_anggota = $_POST['alamat'];
$nomor_hp_anggota = $_POST['nomorhp'];
$email_anggota = $_POST['email'];
$tanggal_bergabung = $_POST['tanggal'];

// Query SQL untuk menyimpan data anggota
$sql = "INSERT INTO tb_anggota (nama_anggota, nis, alamat, nomor_hp, email, tgl_bergabung) VALUES ('$nama_anggota', '$nis_anggota', '$alamat_anggota', '$nomor_hp_anggota', '$email_anggota', '$tanggal_bergabung')";

if ($koneksi->query($sql) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
      alert("Data anggota berhasil disimpan!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=anggota.php'>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
