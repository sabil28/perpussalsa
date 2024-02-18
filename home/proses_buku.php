<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["simpan"])) {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $isbn = $_POST['isbn'];
    $jumbuku = $_POST['jumbuku'];
    $jumsalin = $_POST['jumsalin'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    //koneksi
    include 'koneksi.php';
    
    // Upload gambar
    $gambar = $_FILES["gambar"]["name"];
    $gambar_tmp = $_FILES["gambar"]["tmp_name"];
    $upload_folder = "buku/"; // Direktori penyimpanan gambar
    move_uploaded_file($gambar_tmp, $upload_folder . $gambar);

    // Query SQL untuk menyimpan data ke tabel item
    $sql = "INSERT INTO tb_buku (judul_buku, pengarang, penerbit, tahun_terbit, isbn, jumlah_buku, jumlah_salinan, kategori_buku, deskripsi_buku, gambar_sampul) VALUES ('$judul', '$pengarang', '$penerbit', '$tahun', '$isbn', '$jumbuku', '$jumsalin', '$kategori', '$deskripsi', '$gambar')";

    if ($koneksi->query($sql) === TRUE) {
        echo '<script language="javascript" type="text/javascript">
          alert("Data buku berhasil disimpan.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=buku.php'>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>