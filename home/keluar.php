<?php
session_start();
session_destroy(); // Menghapus semua data sesi

header("Location: ../index.php"); // Redirect kembali ke halaman login setelah logout
exit();
?>