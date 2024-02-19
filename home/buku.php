<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["login_type"])) {
    echo '<script language="javascript" type="text/javascript">
        alert("Anda Tidak Berhak Memasuki Halaman Ini.!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=../index.php'>"; // Redirect ke halaman login jika tidak ada sesi
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Peminjaman Buku Perpustakaan | Data Buku</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="index.php">
                    <span class="brand">Peminjaman
                        <span class="brand-tip">Buku</span>
                    </span>
                    <span class="brand-mini">AC</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    <li>
                        <form class="navbar-search" action="javascript:;">
                            <div class="rel">
                                <span class="search-icon"><i class="ti-search"></i></span>
                                <input class="form-control" placeholder="Search here...">
                            </div>
                        </form>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li class="dropdown dropdown-notification">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o rel"><span
                                    class="notify-signal"></span></i></a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                            <li class="dropdown-menu-header">
                                <div>
                                    <span><strong>5 New</strong> Notifications</span>
                                    <a class="pull-right" href="javascript:;">view all</a>
                                </div>
                            </li>
                            <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                                <div>
                                    <?php include 'notif.php'; ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img src="./assets/img/admin-avatar.png" />
                            <span></span><?php echo $_SESSION['nama_admin']; ?><i
                                class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="keluar.php"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php include 'menu.php'; ?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h6 class="page-title">Data Buku</h6>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Buku</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Data Buku</div>
                        <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#bukuModal"><i
                                class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Buku</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Kategori Buku</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar Sampul</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;

                                $data = "SELECT * FROM tb_buku, tb_kategori WHERE id_kategori=kategori_buku";
                                $result = mysqli_query($koneksi,$data);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['judul_buku']; ?></td>
                                    <td><?php echo $row['pengarang']; ?></td>
                                    <td><?php echo $row['penerbit']; ?></td>
                                    <td><?php echo $row['tahun_terbit']; ?></td>
                                    <td><?php echo $row['nama_kategori']; ?></td>
                                    <td style="text-align: justify;"><?php echo $row['deskripsi_buku']; ?></td>
                                    <td style="text-align: center;">
                                        <img src="buku/<?php echo $row['gambar_sampul']; ?>" alt="Gambar Sampul"
                                            title="<?php echo $row['judul_buku']; ?>" width="50px" height="50px">
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="" data-toggle="modal"
                                            data-toggle="modal"
                                            data-target="#bukueditModal<?php echo $row['id_buku']; ?>"><i
                                                class="fa fa-cog"></i></a><br><br>
                                        <a class="btn btn-sm btn-primary" href="" data-toggle="modal"
                                            data-target="#bukudetailModal<?php echo $row['id_buku']; ?>"><i
                                                class="fa fa-eye"></i></a><br><br>
                                        <a class="btn btn-sm btn-danger"
                                            href="hapus_buku.php?id_buku=<?php echo $row['id_buku']; ?>"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah -->
            <div class="modal fade" id="bukuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="proses_buku.php" enctype="multipart/form-data">
                                <!-- Bagian kiri -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="judulBuku">Judul Buku</label>
                                        <input type="text" class="form-control" id="judulBuku" name="judul">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pengarang">Pengarang</label>
                                        <input type="text" class="form-control" id="pengarang" name="pengarang">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="penerbit">Penerbit</label>
                                        <input type="text" class="form-control" id="penerbit" name="penerbit">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tahunTerbit">Tahun Terbit</label>
                                        <select class="form-control" id="tahun" name="tahun">
                                            <option selected disabled>Pilih Tahun Terbit</option>
                                            <?php
                                              $tahunSekarang = date("Y"); // Mengambil tahun saat ini
                                              for ($tahun = $tahunSekarang; $tahun >= 1900; $tahun--) {
                                                echo "<option value='$tahun'>$tahun</option>";
                                              }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="isbn">ISBN</label>
                                        <input type="text" class="form-control" id="isbn" name="isbn">
                                    </div>
                                </div>

                                <!-- Bagian kanan -->
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="jumlahBuku">Jumlah Buku</label>
                                        <input type="text" class="form-control" id="jumlahBuku" name="jumbuku">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="jumlahSalinan">Jumlah Salinan</label>
                                        <input type="text" class="form-control" id="jumlahSalinan" name="jumsalin">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="kategoriBuku">Kategori Buku</label>
                                        <select class="form-control" id="kategori" name="kategori">
                                            <option selected disabled>Pilih Kategori</option>
                                            <?php 
                                            $k = mysqli_query($koneksi,"SELECT * FROM tb_kategori");
                                            while ($rowk = mysqli_fetch_assoc($k)){
                                            ?>
                                            <option value="<?php echo $rowk['id_kategori']; ?>">
                                                <?php echo $rowk['nama_kategori']; ?>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="deskripsiBuku">Deskripsi Buku</label>
                                        <textarea class="form-control" id="deskripsiBuku" name="deskripsi"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="gambarBuku">Upload Gambar Buku</label>
                                        <input type="file" class="form-control" id="gambarBuku" name="gambar">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <?php 
            $datab = "SELECT * FROM tb_buku";
            $resultb = mysqli_query($koneksi,$datab);
            while ($rowb = mysqli_fetch_assoc($resultb)){
                $tahun_terbit = $rowb['tahun_terbit'];
            ?>
            <div class="modal fade" id="bukueditModal<?php echo $rowb['id_buku']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Buku</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="update_buku.php" enctype="multipart/form-data">
                                <input type="hidden" name="id_buku" value="<?php echo $rowb['id_buku']; ?>">
                                <!-- Bagian kiri -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="judulBuku">Judul Buku</label>
                                        <input type="text" class="form-control" id="judulBuku" name="judul"
                                            value="<?php echo $rowb['judul_buku']; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pengarang">Pengarang</label>
                                        <input type="text" class="form-control" id="pengarang" name="pengarang"
                                            value="<?php echo $rowb['pengarang']; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="penerbit">Penerbit</label>
                                        <input type="text" class="form-control" id="penerbit" name="penerbit"
                                            value="<?php echo $rowb['penerbit']; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tahunTerbit">Tahun Terbit</label>
                                        <select class="form-control" id="tahun" name="tahun">
                                            <option selected disabled>Pilih Tahun Terbit</option>
                                            <?php
                                            $tahunSekarang = date("Y");
                                            for ($tahun = $tahunSekarang; $tahun >= 1900; $tahun--) {
                                                $selected = ($tahun == $tahun_terbit) ? "selected" : "";
                                                echo "<option value='$tahun' $selected>$tahun</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="isbn">ISBN</label>
                                        <input type="text" class="form-control" id="isbn" name="isbn"
                                            value="<?php echo $rowb['isbn']; ?>">
                                    </div>
                                </div>

                                <!-- Bagian kanan -->
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="jumlahBuku">Jumlah Buku</label>
                                        <input type="text" class="form-control" id="jumlahBuku" name="jumbuku"
                                            value="<?php echo $rowb['jumlah_buku']; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="jumlahSalinan">Jumlah Salinan</label>
                                        <input type="text" class="form-control" id="jumlahSalinan" name="jumsalin"
                                            value="<?php echo $rowb['jumlah_salinan']; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="kategoriBuku">Kategori Buku</label>
                                        <select class="form-control" id="kategori" name="kategori">
                                            <option selected disabled>Pilih Kategori</option>
                                            <?php 
                                            $k = mysqli_query($koneksi,"SELECT * FROM tb_kategori");
                                            while ($rowk = mysqli_fetch_assoc($k)){
                                            ?>
                                            <option
                                                <?php if($rowk['id_kategori'] == $rowb['kategori_buku']){echo "selected='selected'";} ?>
                                                value="<?php echo $rowk['id_kategori']; ?>">
                                                <?php echo $rowk['nama_kategori']; ?>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="deskripsiBuku">Deskripsi Buku</label>
                                        <textarea class="form-control" id="deskripsiBuku" name="deskripsi"
                                            rows="3"><?php echo $rowb['deskripsi_buku']; ?></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="gambarBuku">Upload Gambar Buku</label>
                                        <input type="file" class="form-control" id="gambarBuku" name="gambar">
                                        <br>
                                        <img src="buku/<?php echo $rowb['gambar_sampul']; ?>" width="60px"
                                            height="60px">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" name="update" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Modal Detail -->
            <?php 
            $datab = "SELECT * FROM tb_buku, tb_kategori WHERE id_kategori=kategori_buku";
            $resultb = mysqli_query($koneksi,$datab);
            while ($rowb = mysqli_fetch_assoc($resultb)){
            ?>
            <div class="modal fade" id="bukudetailModal<?php echo $rowb['id_buku']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Buku</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered table-hover" id="example-table"
                                cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th>Judul Buku</th>
                                        <th>:</th>
                                        <td><?php echo $rowb['judul_buku']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pengarang</th>
                                        <th>:</th>
                                        <td><?php echo $rowb['pengarang']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Penerbit</th>
                                        <th>:</th>
                                        <td><?php echo $rowb['penerbit']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Terbit</th>
                                        <th>:</th>
                                        <td><?php echo $rowb['tahun_terbit']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>ISBN</th>
                                        <th>:</th>
                                        <td><?php echo $rowb['isbn']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Buku</th>
                                        <th>:</th>
                                        <td><?php echo $rowb['jumlah_buku']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Salinan</th>
                                        <th>:</th>
                                        <td><?php echo $rowb['jumlah_salinan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kategori Buku</th>
                                        <th>:</th>
                                        <td><?php echo $rowb['nama_kategori']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi Buku</th>
                                        <th>:</th>
                                        <td style="text-align: justify;"><?php echo $rowb['deskripsi_buku']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gambar Buku</th>
                                        <th>:</th>
                                        <td>
                                            <img src="buku/<?php echo $rowb['gambar_sampul']; ?>" width="60px"
                                                height="60px">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">2024 © <b>SALSABILA</b> - All rights reserved.</div>
                <a class="px-4"
                    href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589"
                    target="_blank">BUY PREMIUM</a>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <div class="theme-config">
        <div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i
                class="ti-close theme-config-close"></i></div>
        <div class="theme-config-box">
            <div class="text-center font-18 m-b-20">SETTINGS</div>
            <div class="font-strong">LAYOUT OPTIONS</div>
            <div class="check-list m-b-20 m-t-10">
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedNavbar" type="checkbox" checked>
                    <span class="input-span"></span>Fixed navbar</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedlayout" type="checkbox">
                    <span class="input-span"></span>Fixed layout</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input class="js-sidebar-toggler" type="checkbox">
                    <span class="input-span"></span>Collapse sidebar</label>
            </div>
            <div class="font-strong">LAYOUT STYLE</div>
            <div class="m-t-10">
                <label class="ui-radio ui-radio-gray m-r-10">
                    <input type="radio" name="layout-style" value="" checked="">
                    <span class="input-span"></span>Fluid</label>
                <label class="ui-radio ui-radio-gray">
                    <input type="radio" name="layout-style" value="1">
                    <span class="input-span"></span>Boxed</label>
            </div>
            <div class="m-t-10 m-b-10 font-strong">THEME COLORS</div>
            <div class="d-flex m-b-20">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Default">
                    <label>
                        <input type="radio" name="setting-theme" value="default" checked="">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-white"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue">
                    <label>
                        <input type="radio" name="setting-theme" value="blue">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green">
                    <label>
                        <input type="radio" name="setting-theme" value="green">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple">
                    <label>
                        <input type="radio" name="setting-theme" value="purple">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange">
                    <label>
                        <input type="radio" name="setting-theme" value="orange">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink">
                    <label>
                        <input type="radio" name="setting-theme" value="pink">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="White">
                    <label>
                        <input type="radio" name="setting-theme" value="white">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue light">
                    <label>
                        <input type="radio" name="setting-theme" value="blue-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green light">
                    <label>
                        <input type="radio" name="setting-theme" value="green-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple light">
                    <label>
                        <input type="radio" name="setting-theme" value="purple-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange light">
                    <label>
                        <input type="radio" name="setting-theme" value="orange-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink light">
                    <label>
                        <input type="radio" name="setting-theme" value="pink-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="./assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
    $(function() {
        $('#example-table').DataTable({
            pageLength: 10,
            //"ajax": './assets/demo/data/table_data.json',
            /*"columns": [
                { "data": "name" },
                { "data": "office" },
                { "data": "extn" },
                { "data": "start_date" },
                { "data": "salary" }
            ]*/
        });
    })
    </script>

    <script>
    var inactivityTimeout; // Timeout untuk aktivitas

    // Fungsi untuk mereset timeout
    function resetInactivityTimeout() {
        clearTimeout(inactivityTimeout);
        inactivityTimeout = setTimeout(function() {
            window.location.href = "lockscreen.php";
        }, 200000); // Mengarahkan ke lockscreen.php setelah 10 detik tidak ada aktivitas
    }

    // Menambahkan event listener untuk mendeteksi aktivitas
    document.addEventListener("mousemove", resetInactivityTimeout);
    document.addEventListener("keydown", resetInactivityTimeout);
    </script>
</body>

</html>