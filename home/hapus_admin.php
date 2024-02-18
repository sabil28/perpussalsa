<?php 
//panggil koneksi ke database
include 'koneksi.php';

$id_admin = $_GET['idadmin'];

$sql = "DELETE FROM tb_admin WHERE id_admin = $id_admin";

if (mysqli_query($koneksi, $sql)) {
    echo '<script language="javascript" type="text/javascript">
      alert("Data berhasil dihapus!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=admin.php'>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>