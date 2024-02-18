<?php 
//panggil koneksi ke database
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM tb_anggota WHERE id_anggota = $id";

if (mysqli_query($koneksi, $sql)) {
    echo '<script language="javascript" type="text/javascript">
      alert("Data anggota berhasil dihapus!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=anggota.php'>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>