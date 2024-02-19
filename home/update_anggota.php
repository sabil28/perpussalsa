<?php
// Koneksi ke database (gantilah nilai-nilai ini sesuai dengan pengaturan database Anda)
include 'koneksi.php';

// Ambil data dari formulir
$id_anggota = $_POST['id_anggota'];
$nama_anggota = $_POST['nama'];
$nis_anggota = $_POST['nis'];
$alamat_anggota = $_POST['alamat'];
$nomor_hp_anggota = $_POST['nomorhp'];
$email_anggota = $_POST['email'];
$tanggal_bergabung = $_POST['tanggal'];
$username = $_POST['username'];
$password = md5($_POST['password']);

if (!empty($_POST['password'])) {
    $password = md5($_POST['password']);
    $updatePassword = true;
} else {
    $updatePassword = false;
}
// Query SQL untuk memperbarui data anggota
if ($updatePassword) {
    $sql = "UPDATE tb_anggota SET nama_anggota='$nama_anggota', nis='$nis_anggota', alamat='$alamat_anggota', nomor_hp='$nomor_hp_anggota', email='$email_anggota', tgl_bergabung='$tanggal_bergabung', password='$password', username ='$username' WHERE id_anggota=$id_anggota";
} else {
    $sql = "UPDATE tb_anggota SET nama_anggota='$nama_anggota', nis='$nis_anggota', alamat='$alamat_anggota', nomor_hp='$nomor_hp_anggota', email='$email_anggota', tgl_bergabung='$tanggal_bergabung', username ='$username' WHERE id_anggota=$id_anggota";
}

// Pernyataan SQL untuk mengecek apakah trigger sudah ada sebelumnya
$sqlCheckTrigger = "SHOW TRIGGERS LIKE 'update_admin_after_update'";
$result = $koneksi->query($sqlCheckTrigger);

// Jika trigger belum ada, tambahkan trigger
if ($result->num_rows == 0) {
    $sqlTrigger = "CREATE TRIGGER update_admin_after_update
    AFTER UPDATE ON tb_anggota
    FOR EACH ROW
    BEGIN
        UPDATE tb_admin
        SET 
            username = NEW.username,
            password = NEW.password,
            nama_lengkap = NEW.nama_anggota,
            alamat = NEW.alamat,
            nomor_hp = NEW.nomor_hp,
            hak_akses = 'anggota'
        WHERE id_admin = NEW.id_anggota;
    END;";
    $sql .= "; " . $sqlTrigger;
}

if ($koneksi->multi_query($sql) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
      alert("Data anggota berhasil diperbarui dan trigger berhasil ditambahkan!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=anggota.php'>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>