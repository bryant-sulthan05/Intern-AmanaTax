<?php
$title = 'Dashboard';
include '../layouts/meta.php';
include '../components/session.php';
$CountLesson = mysqli_num_rows($config->query("SELECT * FROM lesson"));
$CountVideo = mysqli_num_rows($config->query("SELECT * FROM video"));
$CountArticle = mysqli_num_rows($config->query("SELECT * FROM article"));
$CountTransaction = mysqli_num_rows($config->query("SELECT * FROM transaction WHERE status = 'approved'"));
$PendingTransaction = mysqli_num_rows($config->query("SELECT * FROM transaction WHERE status = 'pending'"));
$CancelTransaction = mysqli_num_rows($config->query("SELECT * FROM transaction WHERE status = 'cancel'"));
?>
<style>
    .btn-outline-warning {
        border: #ffc107 2px solid;
    }

    .btn-outline-primary {
        border: #0d6efd 2px solid;
    }

    .btn-outline-secondary {
        border: #6c757d 2px solid;
    }

    .btn-outline-success {
        border: #198754 2px solid;
    }
</style>
<?php
if (isset($_SESSION['LogAdmin']) == 'success') {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Login Berhasil",
                icon: "success"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_SESSION['LogAdmin']);
}
?>
<div class="container-fluid">
    <div class="row">
        <?php include '../layouts/sidenav.php' ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-md-4" style="margin-bottom: 100px;">
            <div class="row mt-3">
                <div class="col-md-3 mt-3">
                    <a href="ListMateri.php" class="text-decoration-none text-dark">
                        <div class="card btn btn-outline-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="bi bi-book-half fs-1"></span>
                                    <h2 class="fw-bold">Materi</h2>
                                </div>
                                <div class="float-end">
                                    <h3 class="fw-bold"><?= $CountLesson ?></h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mt-3">
                    <a href="ListVideo.php" class="text-decoration-none text-dark">
                        <div class="card btn btn-outline-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="bi bi-camera-reels fs-1"></span>
                                    <h2 class="fw-bold">Video</h2>
                                </div>
                                <div class="float-end">
                                    <h3 class="fw-bold"><?= $CountVideo ?></h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mt-3">
                    <a href="ListArtikel.php" class="text-decoration-none text-dark">
                        <div class="card btn btn-outline-secondary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="bi bi-newspaper fs-1"></span>
                                    <h2 class="fw-bold">Artikel</h2>
                                </div>
                                <div class="float-end">
                                    <h3 class="fw-bold"><?= $CountArticle ?></h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mt-3">
                    <a href="ListTransaksi.php" class="text-decoration-none text-dark">
                        <div class="card btn btn-outline-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="bi bi-receipt-cutoff fs-1"></span>
                                    <h2 class="fw-bold">Transaksi</h2>
                                </div>
                                <div class="float-start">
                                    <span class="fw-bold">Terkonfirmasi</span>
                                </div>
                                <div class="float-end">
                                    <span class="fw-bold"><?= $CountTransaction ?></span>
                                </div><br>
                                <div class="float-start">
                                    <span class="fw-bold">Menunggu Konfirmasi</span>
                                </div>
                                <div class="float-end">
                                    <span class="fw-bold"><?= $PendingTransaction ?></span>
                                </div><br>
                                <div class="float-start">
                                    <span class="fw-bold">Batal</span>
                                </div>
                                <div class="float-end">
                                    <span class="fw-bold"><?= $CancelTransaction ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php include '../layouts/chart.php' ?>
        </main>
    </div>
</div>