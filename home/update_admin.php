<?php
// Koneksi ke database
include 'koneksi.php';

// Mengambil data dari formulir
$id_admin = $_POST['id'];
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

// Mengecek apakah password ingin diupdate
if (!empty($_POST['password'])) {
    $password = md5($_POST['password']);
    $updatePassword = true;
} else {
    $updatePassword = false;
}

if (!empty($gambar_name)) {
    if (move_uploaded_file($gambar_tmp, $gambar_destination)) {
        // Query untuk mengupdate data admin dengan gambar baru
        if ($updatePassword) {
            $query = "UPDATE tb_admin SET username='$username', password='$password', nama_lengkap='$nama_lengkap', alamat='$alamat', nomor_hp='$nomor_hp', hak_akses='$hak_akses', foto='$gambar_destination' WHERE id_admin=$id_admin";
        } else {
            $query = "UPDATE tb_admin SET username='$username', nama_lengkap='$nama_lengkap', alamat='$alamat', nomor_hp='$nomor_hp', hak_akses='$hak_akses', foto='$gambar_destination' WHERE id_admin=$id_admin";
        }
    } else {
        echo "Gagal mengupload gambar.";
    }
} else {
    // Query untuk mengupdate data admin tanpa mengubah gambar
    if ($updatePassword) {
        $query = "UPDATE tb_admin SET username='$username', password='$password', nama_lengkap='$nama_lengkap', alamat='$alamat', nomor_hp='$nomor_hp', hak_akses='$hak_akses' WHERE id_admin=$id_admin";
    } else {
        $query = "UPDATE tb_admin SET username='$username', nama_lengkap='$nama_lengkap', alamat='$alamat', nomor_hp='$nomor_hp', hak_akses='$hak_akses' WHERE id_admin=$id_admin";
    }
}

if (mysqli_query($koneksi, $query)) {
    echo '<script language="javascript" type="text/javascript">
      alert("Data admin berhasil diupdate!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=admin.php'>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>