<?php
// Menghubungkan ke database
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $idp = $_POST['idpinjam'];
    $id_buku = $_POST['idbuku'];
    $jumlah_pinjam = $_POST['jumlah_pinjam'];
    $action = $_POST['action']; // 'kembalikan' atau 'tambah'

    if ($action === 'kembalikan') {
        // Proses pengurangan jumlah peminjaman
        $query = "UPDATE tb_peminjaman SET jumlah_pinjam = jumlah_pinjam - $jumlah_pinjam WHERE id_peminjaman = $idp";
        $koneksi->query($query); 

        // Proses pengembalian buku
        $sql = "UPDATE tb_buku SET jumlah_buku = jumlah_buku + $jumlah_pinjam WHERE id_buku = $id_buku";
    } elseif ($action === 'tambah') {
        // Proses penambahan jumlah Peminjaman
        $query = "UPDATE tb_peminjaman SET jumlah_pinjam = jumlah_pinjam + $jumlah_pinjam WHERE id_peminjaman = $idp";
        $koneksi->query($query);

        // Proses pengurangan buku
        $sql = "UPDATE tb_buku SET jumlah_buku = jumlah_buku - $jumlah_pinjam WHERE id_buku = $id_buku";
    }

    if ($koneksi->query($sql) === TRUE) {
        echo '<script language="javascript" type="text/javascript">
          alert("Data berhasil!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=peminjaman.php'>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>