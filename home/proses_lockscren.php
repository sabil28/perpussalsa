<?php
session_start();
// Sambungkan ke database Anda
include 'koneksi.php';

// Check if the password is provided in the POST request
if (!isset($_POST['password'])) {
    // Password not provided, redirect back to lockscreen.php
    header("Location: lockscreen.php");
    exit(); // Stop further execution of the script
}

// Ambil kata sandi yang dimasukkan dari form
$password = $_POST['password'];

// Query database untuk memeriksa kata sandi
$query = "SELECT * FROM lockscreen WHERE password = '$password'";
$result = $koneksi->query($query);

// Periksa apakah kata sandi cocok
if ($result->num_rows > 0) {
    $_SESSION['login_type'] = true; // Pengguna sudah login
    // Kata sandi benar, arahkan pengguna ke halaman "index.php"
    header("Location: index.php");
} else {
    // Kata sandi salah, arahkan pengguna kembali ke halaman lock screen
    header("Location: lockscreen.php");
}

// Tutup koneksi database
$koneksi->close();
?>