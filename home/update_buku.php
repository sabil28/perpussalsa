<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id_buku = $_POST["id_buku"];
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

    // Upload gambar jika ada perubahan gambar
    if ($_FILES["gambar"]["name"]) {
        $gambar = $_FILES["gambar"]["name"];
        $gambar_tmp = $_FILES["gambar"]["tmp_name"];
        $upload_folder = "buku/"; // Direktori penyimpanan gambar
        move_uploaded_file($gambar_tmp, $upload_folder . $gambar);
        
        // Update data staff dengan gambar
        $sql = "UPDATE tb_buku SET judul_buku='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun', isbn='$isbn', jumlah_buku='$jumbuku', jumlah_salinan='$jumsalin', kategori_buku='$kategori', deskripsi_buku='$deskripsi', gambar_sampul='$gambar' WHERE id_buku=$id_buku";
    } else {
        // Update data staff tanpa perubahan gambar
        $sql = "UPDATE tb_buku SET judul_buku='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun', isbn='$isbn', jumlah_buku='$jumbuku', jumlah_salinan='$jumsalin', kategori_buku='$kategori', deskripsi_buku='$deskripsi' WHERE id_buku=$id_buku";
    }

    if (mysqli_query($koneksi, $sql)) {
        echo '<script language="javascript" type="text/javascript">
          alert("Data buku berhasil diupdate.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=buku.php'>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>