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
    <title>Peminjaman Buku Perpustakaan | Data Peminjaman</title>
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
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o rel"><span class="notify-signal"></span></i></a>
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
                            <span></span><?php echo $_SESSION['nama_admin']; ?><i class="fa fa-angle-down m-l-5"></i></a>
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
                <h6 class="page-title">Data Peminjaman</h6>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Data Peminjaman</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Data Peminjaman</div>
                        <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#pinjamModal"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Anggota</th>
                                    <th>Nama Buku</th>
                                    <th>Tgl. Peminjaman</th>
                                    <th>Tgl. Pengembalian Rencana</th>
                                    <th>Tgl. Pengembalian Aktual</th>
                                    <th>Status Peminjaman</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;

                                $data = "SELECT * FROM tb_peminjaman,tb_anggota, tb_buku WHERE id_anggota=agt_id AND id_buku=buku_id ORDER BY id_peminjaman DESC";
                                $result = mysqli_query($koneksi,$data);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $status = $row['status_peminjaman'];
                                    if ($status == 1) {
                                        $icon ="fa fa-spinner";
                                        $btn = "btn-warning";
                                    }elseif ($status == 2) {
                                        $icon = "fa fa-history";
                                        $btn = "btn-success";
                                    }elseif ($status == 3) {
                                        $icon = "fa fa-times";
                                        $btn = "btn-danger";
                                    }
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama_anggota']; ?></td>
                                    <td><?php echo $row['judul_buku']; ?></td>
                                    <td><?php echo $row['tgl_peminjaman']; ?></td>
                                    <td><?php echo $row['tgl_pengembalian_r']; ?></td>
                                    <td><?php echo $row['tgl_pengembalian_a']; ?></td>
                                    <td style="text-align: center;">
                                        <?php if ($status == 1) { ?>
                                            <span class="badge badge-primary">Dipinjam</span>
                                        <?php }elseif ($status == 2) { ?>
                                            <span class="badge badge-success">Dikembalikan</span>
                                        <?php }elseif ($status == 3) { ?>
                                            <span class="badge badge-danger">Telat</span>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn btn-sm btn-warning" href="" data-toggle="modal" data-toggle="modal" data-target="#editModal<?php echo $row['id_peminjaman']; ?>"><i class="fa fa-cog"></i></a><br><br>

                                        <a class="btn btn-sm btn-primary" href="cetak_kwintasi.php?id=<?php echo $row['id_peminjaman']; ?>" target="_blank"><i class="fa fa-print"></i></a><br><br>

                                        <a class="btn btn-sm <?php echo $btn; ?>" href="" data-toggle="modal" data-target="#statusModal<?php echo $row['id_peminjaman']; ?>"><i class="<?php echo $icon; ?>"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah-->
            <div class="modal fade" id="pinjamModal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Peminjaman Buku</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="container">
                        <form method="POST" action="proses_peminjaman.php">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Formulir Peminjaman</h5>
                                <div class="form-group">
                                  <label for="namaAnggota">Nama Anggota:</label>
                                  <select class="form-control" name="anggota">
                                      <option selected disabled>Pilih Anggota</option>
                                      <?php 
                                      $a = mysqli_query($koneksi,"SELECT * FROM tb_anggota");
                                      while ($rowa = mysqli_fetch_assoc($a)){
                                      ?>
                                      <option value="<?php echo $rowa['id_anggota']; ?>"><?php echo $rowa['nama_anggota']; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="namaBuku">Nama Buku:</label>
                                  <select class="form-control" name="buku">
                                      <option selected disabled>Pilih Judul Buku</option>
                                      <?php 
                                      $b = mysqli_query($koneksi,"SELECT * FROM tb_buku");
                                      while ($rowb = mysqli_fetch_assoc($b)){
                                      ?>
                                      <option value="<?php echo $rowb['id_buku']; ?>"><?php echo $rowb['judul_buku']; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="tanggalPeminjaman">Tanggal Peminjaman:</label>
                                  <input type="date" class="form-control" id="tanggalPeminjaman" name="tanggalp">
                                </div>
                                <div class="form-group">
                                  <label for="namaPeminjaman">Kelas Peminjam:</label>
                                  <input type="text" class="form-control" id="namaPeminjam" name="nama">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Tanggal Pengembalian</h5>
                                <div class="form-group">
                                  <label for="tanggalPengembalianRencana">Tanggal Pengembalian Rencana:</label>
                                  <input type="date" class="form-control" id="tanggalPengembalianRencana" name="tanggalpr">
                                </div>
                                <div class="form-group">
                                  <label for="tanggalPengembalianAktual">Tanggal Pengembalian Aktual:</label>
                                  <input type="date" class="form-control" id="tanggalPengembalianAktual" name="tanggalpa">
                                </div>
                                <div class="form-group">
                                  <label for="jumlahPinjam">Jumlah Peminjaman:</label>
                                  <input type="number" class="form-control" id="jumlahPinjman" name="jumlah">
                                </div>
                                <div class="form-group">
                                  <label for="catatan">Catatan:</label>
                                  <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Edit-->
            <?php 
            $p = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman");
            while ($rowp = mysqli_fetch_assoc($p)){
                $idp = $rowp['id_peminjaman'];
                $jmlp = $rowp['jumlah_pinjam'];
            ?>
            <div class="modal fade" id="editModal<?php echo $rowp['id_peminjaman'] ?>">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Peminjaman Buku</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="container">
                        <form method="POST" action="update_peminjaman.php">
                        <input type="hidden" name="idp" value="<?php echo $rowp['id_peminjaman'] ?>">    
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Formulir Peminjaman</h5>
                                <div class="form-group">
                                  <label for="namaAnggota">Nama Anggota:</label>
                                  <select class="form-control" name="anggota">
                                      <option selected disabled>Pilih Anggota</option>
                                      <?php 
                                      $a = mysqli_query($koneksi,"SELECT * FROM tb_anggota");
                                      while ($rowa = mysqli_fetch_assoc($a)){
                                      ?>
                                      <option <?php if($rowa['id_anggota'] == $rowp['agt_id']){echo "selected='selected'";} ?> value="<?php echo $rowa['id_anggota']; ?>"><?php echo $rowa['nama_anggota']; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="namaBuku">Nama Buku:</label>
                                  <select class="form-control" name="buku">
                                      <option selected disabled>Pilih Judul Buku</option>
                                      <?php 
                                      $b = mysqli_query($koneksi,"SELECT * FROM tb_buku");
                                      while ($rowb = mysqli_fetch_assoc($b)){
                                      ?>
                                      <option <?php if($rowb['id_buku'] == $rowp['buku_id']){echo "selected='selected'";} ?> value="<?php echo $rowb['id_buku']; ?>"><?php echo $rowb['judul_buku']; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="tanggalPeminjaman">Tanggal Peminjaman:</label>
                                  <input type="date" class="form-control" id="tanggalPeminjaman" name="tanggalp" value="<?php echo $rowp['tgl_peminjaman']; ?>">
                                </div>
                                <div class="form-group">
                                  <label for="namaPeminjaman">Kelas Peminjam:</label>
                                  <input type="text" class="form-control" id="namaPeminjam" name="nama" value="<?php echo $rowp['nama_pinjam']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Tanggal Pengembalian</h5>
                                <div class="form-group">
                                  <label for="tanggalPengembalianRencana">Tanggal Pengembalian Rencana:</label>
                                  <input type="date" class="form-control" id="tanggalPengembalianRencana" name="tanggalpr" value="<?php echo $rowp['tgl_pengembalian_r']; ?>">
                                </div>
                                <div class="form-group">
                                  <label for="tanggalPengembalianAktual">Tanggal Pengembalian Aktual:</label>
                                  <input type="date" class="form-control" id="tanggalPengembalianAktual" name="tanggalpa" value="<?php echo $rowp['tgl_pengembalian_a']; ?>">
                                </div>
                                <div class="form-group">
                                  <label for="jumlahPinjam">Jumlah Peminjaman:</label>
                                  <input type="number" class="form-control" id="jumlahPinjman" name="jumlah" value="<?php echo $rowp['jumlah_pinjam']; ?>" readonly>
                                  <?php if ($rowp['status_peminjaman'] == 1) { ?>
                                    <a class="btn btn-sm btn-warning" href="" data-toggle="modal" data-target="#modalForm<?php echo $rowp['id_peminjaman']; ?>">Ubah Jumlah Pinjam Buku</a>
                                  <?php } ?>
                                </div>
                                <div class="form-group">
                                  <label for="catatan">Catatan:</label>
                                  <textarea class="form-control" id="catatan" name="catatan" rows="3"><?php echo $rowp['catatan']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>

            <!-- Modal -->
            <?php 
            $pin = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman");
            while ($rowpin = mysqli_fetch_assoc($pin)){
            ?>
            <div class="modal fade" id="modalForm<?php echo $rowpin['id_peminjaman']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalFormLabel">Jumlah Pinjaman</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="proses_jumlah.php">
                                <input type="hidden" name="idbuku" value="<?php echo $rowpin['buku_id']; ?>">
                                <input type="hidden" name="idpinjam" value="<?php echo $rowpin['id_peminjaman']; ?>">
                                <div class="form-group">
                                    <label for="jumlahPinjamawal">Jumlah Pinjam Awal</label>
                                    <input style="text-align: center;" type="text" class="form-control" id="jumlahPinjam" value="<?php echo $rowpin['jumlah_pinjam']; ?>" readonly>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="jumlahPinjam">Jumlah Pinjam/Kembalikan</label>
                                        <input style="text-align: center;" type="text" class="form-control" id="kembalikanPinjam" name="jumlah_pinjam">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="actionPinjam">Aksi</label>
                                        <select class="form-control" name="action">
                                            <option selected disabled>Pilih Aksi</option>
                                            <option value="kembalikan">Kembalikan</option>
                                            <option value="tambah">Tambah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Modal Status -->
            <?php 
            $pin = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman, tb_buku WHERE id_buku=buku_id");
            while ($rowpin = mysqli_fetch_assoc($pin)){
            ?>
            <div class="modal" id="statusModal<?php echo $rowpin['id_peminjaman']; ?>">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Ubah Status Pinjam</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="kembali_pinjam.php">
                        <input type="hidden" name="idpin" value="<?php echo $rowpin['id_peminjaman']; ?>">
                        <input type="hidden" name="idbuku" value="<?php echo $rowpin['id_buku']; ?>">
                        <input type="hidden" name="jumlah" value="<?php echo $rowpin['jumlah_pinjam']; ?>">
                        <div class="form-group">
                            <label for="statusSelect">Pilih Status:</label>
                            <select class="form-control" id="statusSelect" name="status">
                                <option selected disabled>Pilih Status</option>  
                                <option <?php if($rowpin['status_peminjaman'] == "1"){echo "selected='selected'";} ?> value="1">Proses</option>
                                <option <?php if($rowpin['status_peminjaman'] == "2"){echo "selected='selected'";} ?> <?php echo ($rowpin['status_peminjaman'] == "2") ? "disabled" : ""; ?> value="2">Dikembalikan</option>
                                <option <?php if($rowpin['status_peminjaman'] == "3"){echo "selected='selected'";} ?> value="3">Telat</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>

            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">2023 © <b>AANDANU</b> - All rights reserved.</div>
                <a class="px-4" href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589" target="_blank">BUY PREMIUM</a>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <div class="theme-config">
        <div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i class="ti-close theme-config-close"></i></div>
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
            }, 200000); // Mengarahkan ke lockscreen.php setelah 10 menit (600000 ms) tidak ada aktivitas
        }

        // Menambahkan event listener untuk mendeteksi aktivitas
        document.addEventListener("mousemove", resetInactivityTimeout);
        document.addEventListener("keydown", resetInactivityTimeout);
    </script>
</body>

</html>