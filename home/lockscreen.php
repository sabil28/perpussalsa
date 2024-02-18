<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["login_type"])) {
    echo '<script language="javascript" type="text/javascript">
        alert("Anda Tidak Berhak Memasuki Halaman Ini.!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=../index.php'>"; // Redirect ke halaman login jika tidak ada sesi
    exit();
}

$id = $_SESSION['id_admin'];
$data = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id_admin=$id");
$row = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Peminjaman Buku Perpustakaan | Locked Screen</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.css" rel="stylesheet" />
</head>

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" href="index.php" style="font-size: 14px;">Peminjaman Buku Perpustakaan Sekolah</a>
        </div>
        <div>
            <div class="text-center m-b-20">
                <img class="img-circle" src="<?php echo $row['foto']; ?>" width="110px" />
            </div>
            <form class="text-center" id="lock-form" action="proses_lockscren.php" method="post">
                <h5 class="font-strong"><?php echo $_SESSION['nama_admin']; ?></h5>
                <p class="font-13">Anda berada di lockscreen. Masukkan kata sandi Anda untuk mengambil sesi Anda</p>
                <div class="form-group">
                    <input style="text-align: center;" class="form-control" type="password" name="password" id="password" placeholder="******">
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit"> <i class="fa fa-unlock-alt m-r-5"></i>Unlock</button>
                </div>
            </form>
        </div>
    </div>
    <style>
        .brand {
            font-size: 44px;
            text-align: center;
            margin: 40px 0;
        }

        .content {
            max-width: 300px;
            margin: 0 auto;
        }
    </style>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#lock-form').validate({
                errorClass: "help-block",
                rules: {
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
                errorPlacement: function(e, r) {
                    var i = $(r).parents(".input-group, .check-list");
                    i.length ? i.after(e) : r.after(e)
                },
            });
        });
    </script>

    <script>
        window.addEventListener('beforeunload', function (e) {
            var passwordInput = document.querySelector('input[name="password"]');
            if (passwordInput && !passwordInput.value.trim()) {
                var confirmationMessage = 'Anda harus mengisi kata sandi sebelum meninggalkan halaman.';
                (e || window.event).returnValue = confirmationMessage; // For IE and Firefox
                return confirmationMessage; // For other browsers
            }
        });
    </script>

</body>

</html>