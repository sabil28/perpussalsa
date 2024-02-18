<?php 
//panggil koneksi ke database
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM tb_kategori WHERE id_kategori = $id";

if (mysqli_query($koneksi, $sql)) {
    echo '<script language="javascript" type="text/javascript">
      alert("Data kategori berhasil dihapus!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=kategori.php'>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>