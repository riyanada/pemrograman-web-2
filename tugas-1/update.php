<?php
include './config/config.php';
include './config/database.php';

$id_mhs = $_REQUEST['id'];
if (!isset($_REQUEST['submit'])) { // memperoleh buku_id

    if ($id_mhs) {
        // Query
        $sql = "SELECT
                    a.nama_lengkap,
                    a.nim,
                    b.ps_id,
                    a.periode,
                    a.foto,
                    c.kelas_id
                FROM
                    mahasiswa a
                    INNER JOIN program_studi b ON a.program_studi = b.ps_id
                    INNER JOIN kelas_mahasiswa c ON a.id = c.mahasiswa_id
                WHERE a.id = '{$id_mhs}';";
        $query = mysqli_query($conn, $sql);
        $row = $query->num_rows;

        if ($row > 0) {
            $data_update = mysqli_fetch_array($query); // memperoleh data buku
        } else {
            echo "<script>alert('NIM Mahasiswa tidak ditemukan!');</script>";

            // mengalihkan halaman
            echo "<meta http-equiv='refresh' content='0; url=mahasiswa.php'>";
            exit;
        }
    } else {
        echo "<script>alert('NIM Mahasiswa kosong!');</script>";

        // mengalihkan halaman
        echo "<meta http-equiv='refresh' content='0; url=mahasiswa.php'>";
        exit;
    }
} else {
    $nama_siswa = $_REQUEST['nama_lengkap'];
    $nim = $_REQUEST['nim'];
    $periode = $_REQUEST['periode'];
    $prodi = $_REQUEST['id_prodi'];
    $kelas = $_REQUEST['id_kelas'];

    $targetDir = "uploads/";

    $fileName = $_FILES["file"]["name"];
    
    if ($fileName) {
        $fileTmpName = $_FILES["file"]["tmp_name"];
        $fileType = strtolower($_FILES["file"]["type"]);

        $customFileName = $nim . "_" . time() . "_" . $fileName;
        $targetFilePath = $targetDir . $customFileName;

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileExt, $allowedTypes)) {
            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                echo "File berhasil diunggah dengan nama kustom: " . $customFileName;
            } else {
                echo "Terjadi kesalahan saat mengunggah file.";
                die();
            }
        } else {
            echo "Jenis file yang diunggah tidak diizinkan.";
            die();
        }
        $query = "UPDATE mahasiswa SET nama_lengkap = '{$nama_siswa}', nim = '{$nim}', program_studi = '{$prodi}', periode = '{$periode}', foto = '{$customFileName}' WHERE id = $id_mhs";
    } else {
        $query = "UPDATE mahasiswa SET nama_lengkap = '{$nama_siswa}', nim = '{$nim}', program_studi = '{$prodi}', periode = '{$periode}' WHERE id = $id_mhs";
    }

    $query2 = "UPDATE kelas_mahasiswa SET kelas_id = '{$kelas}' WHERE mahasiswa_id = $id_mhs";

    $update = mysqli_query($conn, $query);
    $update2 = mysqli_query($conn, $query2);

    if ($update && $update2 === TRUE) {
        $_SESSION['desc'] = "success";
        $_SESSION['message'] = "Data berhasil diubah";
        header("location: mahasiswa.php");
    } else {
        $_SESSION['desc'] = "danger";
        $_SESSION['message'] = "error ngabs : " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="untuk tugas web1">
    <meta name="author" content="riyan">

    <title>
        <?= $_SITE_TITLE; ?> - Dashboard
    </title>
    <link rel="shortcut icon" href="https://tk.poltektedc.ac.id/wp-content/uploads/2020/09/cropped-unnamed-1.png"
        type="image/x-icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="<?= $_PATH_ASSETS; ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">

        <?php include $_MENU_TMP; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= (isset($_SESSION['username'])) ? $_SESSION['username'] : ''; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="<?= $_PATH_IMAGE; ?>undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Mahasiswa</h1>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card login-content shadow-lg border-0">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <h3 class="p-3 text-logo">
                                            Update Mahasiswa
                                        </h3>

                                        <div class="mb-3 row">
                                            <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama
                                                Lengkap</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nama_lengkap"
                                                    value="<?= $data_update['nama_lengkap'] ?>" name="nama_lengkap">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nim"
                                                    value="<?= $data_update['nim'] ?>" name="nim">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="periode" class="col-sm-2 col-form-label">Periode</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="periode" id="periode">
                                                    <?php
                                                    $year = date('Y');
                                                    for ($i = $year; $i > $year - 5; $i--) { ?>
                                                        <option value="<?= $i; ?>" <?= ($data_update['periode'] == $i) ? 'selected' : ''; ?>><?= $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="periode" class="col-sm-2 col-form-label">Program Studi</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_prodi">
                                                    <option disabled selected> Pilih Prodi</option>
                                                    <?php
                                                    $sql = "SELECT * FROM program_studi";
                                                    $query = mysqli_query($conn, $sql);
                                                    while ($data = mysqli_fetch_array($query)) {
                                                        ?>
                                                        <option value="<?= $data['ps_id'] ?>"
                                                            <?= ($data_update['ps_id'] == $data['ps_id']) ? 'selected' : ''; ?>><?= $data['program_studi'] ?> </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="periode" class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_kelas">
                                                    <option disabled selected> Pilih Kelas</option>
                                                    <?php
                                                    $sql = "SELECT * FROM kelas";
                                                    $query = mysqli_query($conn, $sql);
                                                    while ($data = mysqli_fetch_array($query)) {
                                                        ?>
                                                        <option value="<?= $data['id_kelas'] ?>"
                                                            <?= ($data_update['kelas_id'] == $data['id_kelas']) ? 'selected' : ''; ?>><?= $data['nama_kelas'] ?> </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="formFileMultiple" class="col-sm-2 col-form-label">Photo
                                                Profile</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="file" name="file" id="gambarInput"
                                                    onchange="previewImage()" multiple>
                                                <br>
                                                <img src="uploads/<?= $data_update['foto'] ?>" id="gambarPreview"
                                                    alt="Preview Gambar"
                                                    style="max-width: 300px; display: <?= ($data_update['foto']) ? '' : 'none'; ?>;">
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary float-end"
                                            value="Simpan">
                                        <a href="javascript:;" onclick="history.back()"
                                            class="btn btn-secondary float-end me-2">Kembali</a>
                                    </div>
                                </form>
                                <div class="footer">
                                    <p class="text-center">© 2023 Hand-crafted & Made with D112121062</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <?php include $_FOOT_TMP; ?>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= $_PATH_ASSETS; ?>js/page.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= $_PATH_ASSETS; ?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= $_PATH_ASSETS; ?>js/demo/datatables-demo.js"></script>

</body>

</html>