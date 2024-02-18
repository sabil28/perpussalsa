<?php
// Koneksi ke database
include 'koneksi.php';

// Data peminjaman
$agt_id = $_POST['anggota'];
$buku_id = $_POST['buku'];
$tgl_peminjaman = $_POST['tanggalp'];
$nama_pinjam = $_POST['nama'];
$tgl_pengembalian_r = $_POST['tanggalpr'];
$tgl_pengembalian_a = $_POST['tanggalpa'];
$jumlah_pinjam = $_POST['jumlah'];
$catatan = $_POST['catatan'];

// Proses penyimpanan data peminjaman
$sql_peminjaman = "INSERT INTO tb_peminjaman (agt_id, buku_id, tgl_peminjaman, nama_pinjam, tgl_pengembalian_r, tgl_pengembalian_a, status_peminjaman, jumlah_pinjam, catatan) 
VALUES ('$agt_id', '$buku_id', '$tgl_peminjaman', '$nama_pinjam', '$tgl_pengembalian_r', '$tgl_pengembalian_a', '1', '$jumlah_pinjam', '$catatan')";

if ($koneksi->query($sql_peminjaman) === TRUE) {
    // Proses penyimpanan riwayat peminjaman
    $id_peminjaman = $koneksi->insert_id; // Mendapatkan ID peminjaman yang baru saja dimasukkan
    
    $sql_riwayat = "INSERT INTO tb_riwayat_peminjaman (id_pinjam, id_agt, id_bku, tgl_peminjaman, tgl_pengembalian) 
    VALUES ('$id_peminjaman', '$agt_id', '$buku_id', '$tgl_peminjaman', '$tgl_pengembalian_a')";
    
    if ($koneksi->query($sql_riwayat) === TRUE) {
        // Update jumlah buku di tabel buku
        $sql_update_jumlah_buku = "UPDATE tb_buku SET jumlah_buku = jumlah_buku - $jumlah_pinjam WHERE id_buku = $buku_id";
        
        if ($koneksi->query($sql_update_jumlah_buku) === TRUE) {
            echo '<script language="javascript" type="text/javascript">
              alert("Data peminjaman berhasil disimpan.");</script>';
            echo "<meta http-equiv='refresh' content='0; url=peminjaman.php'>";
        } else {
            echo "Gagal mengupdate jumlah buku: " . $koneksi->error;
        }
    } else {
        echo "Gagal menyimpan data riwayat peminjaman: " . $koneksi->error;
    }
} else {
    echo "Gagal menyimpan data peminjaman: " . $koneksi->error;
}

// Tutup koneksi
$koneksi->close();
?>