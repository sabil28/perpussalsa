        <?php 
        $akses = $_SESSION['hak_akses'];
        $id = $_SESSION['id_admin'];
        $data = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id_admin=$id");
        $row = mysqli_fetch_assoc($data);
        ?>

        <?php if ($akses == "admin") { ?>
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="<?php echo $row['foto']; ?>" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?php echo $_SESSION['nama_admin']; ?></div><small><?php echo $_SESSION['hak_akses']; ?></small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="index.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="heading">Peminjaman Buku</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">Master Data</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="anggota.php"><i class="fa fa-users"></i> Anggota</a>
                            </li>
                            <li>
                                <a href="buku.php"><i class="fa fa-book"></i> Buku</a>
                            </li>
                            <li>
                                <a href="kategori.php"><i class="fa fa-coffee"></i> Kategori</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="peminjaman.php"><i class="sidebar-item-icon fa fa-sticky-note"></i>
                            <span class="nav-label">Peminjaman Buku</span></a>
                    </li>
                    <li>
                        <a href="riwayat.php"><i class="sidebar-item-icon fa fa-history"></i>
                            <span class="nav-label">Riwayat</span></a>
                    </li>
                    <li>
                        <a href="admin.php"><i class="sidebar-item-icon fa fa-user"></i>
                            <span class="nav-label">Admin</span></a>
                    </li>
                    <li class="heading">Lainnya</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-file"></i>
                            <span class="nav-label">Laporan</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="laporanP.php"><i class="fa fa-file"></i> Laporan Peminjaman</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="keluar.php"><i class="sidebar-item-icon fa fa-sign-out"></i>
                            <span class="nav-label">Keluar</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php }elseif ($akses == "user") { ?>
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="<?php echo $row['foto']; ?>" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?php echo $_SESSION['nama_admin']; ?></div><small><?php echo $_SESSION['hak_akses']; ?></small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="index.html"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="heading">Peminjaman Buku</li>
                    <li>
                        <a href="peminjaman.php"><i class="sidebar-item-icon fa fa-sticky-note"></i>
                            <span class="nav-label">Peminjaman Buku</span></a>
                    </li>
                    <li>
                        <a href="riwayat.php"><i class="sidebar-item-icon fa fa-history"></i>
                            <span class="nav-label">Riwayat</span></a>
                    </li>
                    <li class="heading">Lainnya</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-file"></i>
                            <span class="nav-label">Laporan</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="laporanP.php"><i class="fa fa-file"></i> Laporan Peminjaman</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="keluar.php"><i class="sidebar-item-icon fa fa-sign-out"></i>
                            <span class="nav-label">Keluar</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php } ?>