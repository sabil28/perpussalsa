 <?php
// Mulai session 

// Koneksi ke database (sesuaikan dengan pengaturan database Anda)
session_start();
require_once("home/koneksi.php");


// Jika formulir login dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil username dan password dari formulir
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Query SQL untuk memeriksa kredensial pengguna di tabel admin
    $query = "SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password'";
    $result_admin = mysqli_query($koneksi, $query);
    // Jika kredensial benar pada tabel admin
    if ($result_admin && mysqli_num_rows($result_admin) == 1) {
        // Ambil informasi admin dari hasil query
        $row_admin = mysqli_fetch_assoc($result_admin);

        // Simpan id_admin ke dalam session
        $_SESSION['login_type'] = "login";
        $_SESSION["nama_admin"] = $row_admin["nama_lengkap"];
        $_SESSION["hak_akses"] = $row_admin["hak_akses"];
        $_SESSION['id_admin'] = $row_admin['id_admin'];
    }

    // Query SQL untuk memeriksa kredensial pengguna di tabel anggota
    $query_anggota = "SELECT * FROM tb_anggota WHERE username = '$username' AND password = '$password'";
    $result_anggota = mysqli_query($koneksi, $query_anggota);

    // Jika kredensial benar pada tabel anggota
    if ($result_anggota && mysqli_num_rows($result_anggota) == 1) {
        // Ambil informasi anggota dari hasil query
        $row_anggota = mysqli_fetch_assoc($result_anggota);

        // Simpan id_anggota ke dalam session
        $_SESSION['id_anggota'] = $row_anggota['id_anggota'];
    }

    // Jika kredensial benar di salah satu tabel
    if (isset($_SESSION['id_admin']) || isset($_SESSION['id_anggota'])) {
        // Redirect ke halaman setelah login
       echo '<script language="javascript" type="text/javascript">
            alert("Selamat Datang '.$_SESSION["nama_admin"].', Anda Berhasil Login!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=home/index.php'>"; // Redirect ke halaman dashboard atau halaman lain sesuai kebutuhan
        exit();
    } else {
        // Jika kredensial salah, tampilkan pesan error atau lakukan tindakan yang sesuai
      echo '<script language="javascript" type="text/javascript">
            alert("Maaf Username dan Password Salah.!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
}
?>