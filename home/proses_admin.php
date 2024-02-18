<?php
// Koneksi ke database
include 'koneksi.php';

// Mengambil data dari formulir
$username = $_POST['username'];
$password = md5($_POST['password']);
$nama_lengkap = $_POST['nama'];
$alamat = $_POST['alamat'];
$nomor_hp = $_POST['nomor'];
$hak_akses = $_POST['hakakses'];

// Mengupload gambar
$gambar_name = $_FILES['foto']['name'];
$gambar_tmp = $_FILES['foto']['tmp_name'];
$gambar_destination = "admin/" . $gambar_name;

if (move_uploaded_file($gambar_tmp, $gambar_destination)) {
    // Query untuk menyimpan data ke dalam tabel admin
    $query = "INSERT INTO tb_admin (username, password, nama_lengkap, alamat, nomor_hp, hak_akses, foto) VALUES ('$username', '$password', '$nama_lengkap', '$alamat', '$nomor_hp', '$hak_akses', '$gambar_destination')";

    if (mysqli_query($koneksi, $query)) {
        echo '<script language="javascript" type="text/javascript">
          alert("Data admin berhasil disimpan!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=admin.php'>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Gagal mengupload gambar.";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>