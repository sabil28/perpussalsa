<?php 
include 'koneksi.php';

$idp = $_POST['idpin'];
$idb = $_POST['idbuku'];
$jumlah = $_POST['jumlah'];
$status = $_POST['status'];

if ($status == '1') {
	//proses update status
	$query = "UPDATE tb_peminjaman SET status_peminjaman = '$status' WHERE id_peminjaman = $idp";
	$koneksi->query($query);
}elseif ($status == '2') {
	//proses update status
	$query = "UPDATE tb_peminjaman SET status_peminjaman = '$status' WHERE id_peminjaman = $idp";
	$koneksi->query($query);

	//proses update jumlah kembalikan buku
	$query = "UPDATE tb_buku SET jumlah_buku = jumlah_buku + $jumlah WHERE id_buku = $idb";
	$koneksi->query($query);
}elseif ($status == '3') {
	//proses update status
	$query = "UPDATE tb_peminjaman SET status_peminjaman = '$status' WHERE id_peminjaman = $idp";
	$koneksi->query($query);
}

echo '<script language="javascript" type="text/javascript">
   	alert("Data berhasil!");</script>';
echo "<meta http-equiv='refresh' content='0; url=peminjaman.php'>";
?>