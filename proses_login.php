<?php
session_start();
require_once("home/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]); // Menggunakan MD5 untuk hash password

    $query = "SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['login_type'] = "login";
        $_SESSION["id_admin"] = $row["id_admin"];
        $_SESSION["nama_admin"] = $row["nama_lengkap"];
        $_SESSION["hak_akses"] = $row["hak_akses"];

        echo '<script language="javascript" type="text/javascript">
            alert("Selamat Datang '.$_SESSION["nama_admin"].', Anda Berhasil Login!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=home/index.php'>"; // Redirect ke halaman dashboard atau halaman lain sesuai kebutuhan
        exit();
    } else {
        echo '<script language="javascript" type="text/javascript">
            alert("Maaf Username dan Password Salah.!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
}
?>