<?php
// Sambungkan ke database
include 'home/koneksi.php';

// Ambil data dari form
$username = $_POST['username'];
$password = md5($_POST['password']); // Gunakan md5 untuk mengenkripsi password

// Cek apakah username ada dalam database
$query = "SELECT * FROM tb_admin WHERE username = '$username'";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    // Update password
    $updateQuery = "UPDATE tb_admin SET password = '$password' WHERE username = '$username'";
    if ($koneksi->query($updateQuery) === TRUE) {
        echo '<script language="javascript" type="text/javascript">
            alert("Password berhasil direset. Silakan login kembali.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    } else {
        echo "Error: " . $updateQuery . "<br>" . $koneksi->error;
    }
} else {
    echo "Username tidak ditemukan.";
}

$koneksi->close();
?>