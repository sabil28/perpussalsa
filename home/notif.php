<?php
// Buat koneksi ke database (gantilah dengan informasi koneksi yang sesuai)
include 'koneksi.php';

// Periksa tanggal pengembalian buku yang lewat
$tanggal_sekarang = date('Y-m-d');
$sql = "SELECT * FROM tb_peminjaman, tb_buku WHERE id_buku=buku_id AND  tgl_pengembalian_a < '$tanggal_sekarang'";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $judul = $row['judul_buku'];
        $jumlah = $row['jumlah_pinjam'];
        $kelas = $row['nama_pinjam'];
        $status = $row['status_peminjaman'];

        // Tampilkan notifikasi
        if ($status == 1) {
            echo '<a class="list-group-item">';
            echo '<div class="media">';
                echo '<div class="media-img">';
                    echo '<span class="badge badge-danger badge-big"><i class="fa fa-bell"></i></span>';
                echo '</div>';
                echo '<div class="media-body">';
                    echo '<div class="font-13">';
                    echo "Peminjaman buku $judul dari kelas $kelas telat dalam pengembalian. Jumlah: $jumlah buku.";
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '</a>';
        }elseif ($status == 3) {
            echo '<a class="list-group-item">';
            echo '<div class="media">';
                echo '<div class="media-img">';
                    echo '<span class="badge badge-danger badge-big"><i class="fa fa-bell"></i></span>';
                echo '</div>';
                echo '<div class="media-body">';
                    echo '<div class="font-13">';
                    echo "Peminjaman buku $judul dari kelas $kelas telat dalam pengembalian. Jumlah: $jumlah buku.";
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</a>';
        }
    }
}
?>