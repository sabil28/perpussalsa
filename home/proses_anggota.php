<?php
// Koneksi ke database (gantilah nilai-nilai ini sesuai dengan pengaturan database Anda)
include 'koneksi.php';

// Ambil data dari formulir
$nama_anggota = $_POST['nama'];
$nis_anggota = $_POST['nis'];
$alamat_anggota = $_POST['alamat'];
$nomor_hp_anggota = $_POST['nomorhp'];
$email_anggota = $_POST['email'];
$tanggal_bergabung = $_POST['tanggal'];
$username = $_POST['username'];
$password = md5($_POST['password']);

// Query SQL untuk menyimpan data anggota
$sql = "INSERT INTO tb_anggota (nama_anggota, nis, alamat, nomor_hp, email, tgl_bergabung, username, password) 
        VALUES ('$nama_anggota', '$nis_anggota', '$alamat_anggota', '$nomor_hp_anggota', '$email_anggota', '$tanggal_bergabung', '$username', '$password')";

if ($koneksi->query($sql) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
      alert("Data anggota berhasil disimpan!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=anggota.php'>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>

<?php
// Koneksi ke database
include 'koneksi.php';

// Jalankan query untuk membuat trigger
$sql_trigger = "DELIMITER //

CREATE TRIGGER tambah_admin_anggota
AFTER INSERT ON tb_anggota
FOR EACH ROW
BEGIN
    INSERT INTO tb_admin (id_anggota, username, password, nama_lengkap, alamat, nomor_hp, hak_akses)
    VALUES (NEW.id_anggota, NEW.username, NEW.password, NEW.nama_anggota, NEW.alamat, NEW.nomor_hp, 'anggota');
END;
//

DELIMITER ;";

// Jalankan query untuk membuat trigger
if ($koneksi->multi_query($sql_trigger) === TRUE) {
    echo "Trigger berhasil ditambahkan.";
} else {
    echo "Error: " . $sql_trigger . "<br>" . $koneksi->error;
}

$koneksi->close();
?>