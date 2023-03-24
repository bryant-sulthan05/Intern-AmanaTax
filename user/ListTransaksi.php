<?php
$title = 'Riwayat Transaksi';
include '../layouts/meta.php';
include '../layouts/navbar.php';
include '../components/UserTransaction.php';
?>
<style>
    @media print {
        .print {
            display: none;
        }

        img {
            width: 250;
            height: 250;
        }

        .navbar {
            display: none;
        }

        #send {
            display: none;
        }

        .footer {
            display: none;
        }
    }
</style>
<div class="container mt-5">
    <?php if (isset($_GET['send'])) : ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: #1f2833; color: #fff;">
                        <h4 class="fw-bold">Kirim bukti pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="alert alert-warning" role="alert">
                                    <span class="bi bi-exclamation-circle">&nbsp;Kirim dengan menggunakan format PDF</span>
                                </div>
                                <input type="file" name="proof" id="proof" class="form-control" accept="application/pdf" required>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <input type="text" name="transaction_id" id="transaction_id" value="<?= $_GET['id'] ?>" class="d-none">
                                <button type="submit" name="post" id="post" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    elseif (isset($_GET['upload'])) :
        $billTransaction = $config->query("SELECT user_id, transaction_id, lesson_id, pict, lesson, price, discount, payment_method, rek, transaction.created_at, transaction.updated_at, expired_at, transaction_proof, status, total, qty FROM transaction JOIN lesson USING (lesson_id) JOIN payment USING (payment_id) WHERE transaction_id = '$_GET[id]'");
        $bill = mysqli_fetch_assoc($billTransaction);
    ?>
        <div class="card shadow">
            <div class="card-body">
                <span class="fw-bold">Pembeli : <?= $s['firstname'] ?></span>
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-center">
                        <img src="../public/uploaded_img/<?= $bill['pict'] ?>" class="img-thumbnail">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <span class="fw-bold">Materi :</span>
                            <span class="form-control"><?= $bill['lesson'] ?></span>
                        </div>
                        <div class="d-flex">
                            <?php if ($bill['discount'] > 0) : ?>
                                <div class="mb-2 col-6">
                                    <span class="fw-bold text-nowrap">Harga permateri :</span>
                                    <span class="form-control">Rp. <?= number_format($bill['price'] - ($bill['discount'] / 100) * $bill['price'], 0, ".", ".") ?></span>
                                </div>
                                <div class="mb-2 col-6">
                                    <span class="fw-bold text-nowrap">Diskon :</span>
                                    <span class="form-control"><?= $bill['discount'] ?>%</span>
                                </div>
                            <?php else : ?>
                                <div class="mb-2 col-12">
                                    <span class="fw-bold text-nowrap">Harga permateri :</span>
                                    <span class="form-control">Rp. <?= number_format($bill['price'], 0, ".", ".") ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-2 col-12">
                            <span class="fw-bold text-nowrap">Tanggal pembelian :</span>
                            <span class="form-control"><?= $bill['created_at'] = date("d/M/Y") ?></span>
                        </div>
                        <div class="form-group mb-2 col-12">
                            <span class="fw-bold text-nowrap">Metode pembayaran :</span>
                            <span class="form-control"><?= $bill['payment_method'] ?></span>
                        </div>
                        <div class="mb-2 col-12">
                            <span class="fw-bold text-nowrap">Nomor rekening :</span>
                            <span class="form-control"><?= $bill['rek'] ?></span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group mb-2">
                            <span class="fw-bold">Jumlah pesanan :</span>
                            <span class="form-control"><?= $bill['qty'] ?></span>
                        </div>
                        <div class="form-group mb-2 col-12">
                            <span class="fw-bold text-nowrap">Total harga :</span>
                            <span class="form-control">Rp. <?= number_format($bill['total'], 0, ".", ".") ?></span>
                        </div>
                        <div class="form-group mb-2 col-12 py-3">
                            <div class="print">
                                <a href="#" class="btn btn-outline-primary float-start" aria-hidden="true" onclick="toggle()"><span class="bi bi-printer">&nbsp;Print</span></a>
                            </div>
                            <form action="" method="get">
                                <input type="text" name="id" id="id" value="<?= $bill['transaction_id'] ?>" class="d-none">
                                <button type="submit" name="send" id="send" class="float-end btn fw-bold" style="background-color: #1f2833; color: #13cfac;"><span class="bi bi-upload">&nbsp;Kirim</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <?php
        if (isset($_SESSION['proof_update']) == true) {
        ?>
            <script>
                const information = $("#notif", function() {
                    Swal.fire({
                        title: "Bukti berhasil terkirim",
                        icon: "success"
                    });
                });
            </script>
            <div class="notif" id="notif" data-infodata="info"></div>
        <?php
            unset($_SESSION['proof_update']);
        }
        ?>
        <h4 class="fw-bold"><span class="bi bi-cart">&nbsp;Riwayat Transaksi</span></h4>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead style="background-color: #1f2833; color: #fff;">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Gambar</th>
                        <th scope="col" class="text-center">Materi</th>
                        <th scope="col" class="text-center">Tanggal pembelian</th>
                        <th scope="col" class="text-center">Berlaku sampai dengan</th>
                        <th scope="col" class="text-center">Bukti pembayaran</th>
                        <th scope="col" class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($cek)) : ?>
                        <?php
                        $no = 1;
                        foreach ($ListTransaction as $t) :
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><img src="../public/uploaded_img/<?= $t['pict'] ?>" width="100"></td>
                                <td class="text-center"><?= $t['lesson'] ?></td>
                                <td class="text-center"><?= $t['created_at'] ?></td>
                                <?php if ($t['status'] == 'pending') : ?>
                                    <td class="text-center">Pesanan anda sedang diproses</td>
                                <?php elseif ($t['status'] == 'approved') :  ?>
                                    <td class="text-center">
                                        <?php if ($t['expired_at'] > $tgl) : ?>
                                            <?= $t['expired_at'] ?>
                                        <?php else : ?>
                                            Waktu Berlangganan Anda Sudah Habis
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                                <?php if ($t['transaction_proof'] == '') : ?>
                                    <td class="text-center">
                                        <form action="" method="get">
                                            <input type="text" name="id" id="id" value="<?= $t['transaction_id'] ?>" class="d-none">
                                            <button type="submit" name="upload" id="upload" class="btn fw-bold btn-outline-primary"><span class="bi bi-upload">&nbsp;Kirim bukti pembayaran</span></button>
                                        </form>
                                    </td>
                                <?php else : ?>
                                    <td class="text-center">
                                        <a href="../public/transaction_proof/<?= $t['transaction_proof'] ?>" download="../public/transaction_proof/<?= $t['transaction_proof'] ?>" class="btn fw-bold btn-outline-primary"><span class="bi bi-download">&nbsp;Download</span></a>
                                    </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <?php if ($t['status'] == 'approved') : ?>
                                        <span class="btn fw-bold bi bi-check2-all" style="background-color: #42b72a; color: #fff;">&nbsp;Approved</span>
                                    <?php elseif ($t['status'] == 'pending') : ?>
                                        <span class="btn fw-bold bi bi-hourglass-split mb-3" style="background-color: #FFB100; color: #fff;">&nbsp;Pending</span>
                                        <form action="" method="get">
                                            <input type="text" name="id" id="id" value="<?= $t['transaction_id'] ?>" class="d-none">
                                            <button type="submit" name="cancel" id="cancel" class="btn fw-bold btn-outline-danger"><span class="bi bi-x-circle">&nbsp;Cancel</span></button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td class="text-center fw-bold" colspan="7">
                                <a href="index.php#lesson" class="btn fw-bold" style="background-color: #13cfac; color: #1f2833;"><span class="bi bi-cart">&nbsp;Berlangganan Sekarang</span></a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<script>
    function toggle() {
        window.print()
    }
</script>
<?php include '../layouts/footer.php'; ?>