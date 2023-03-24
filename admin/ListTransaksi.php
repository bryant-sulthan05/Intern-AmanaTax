<?php
if (isset($_POST['tambah'])) {
    $title = 'Daftar Transaksi';
} else if (isset($_POST['edit'])) {
    $title = 'Edit Transaksi';
} else {
    $title = 'Daftar Transaksi';
}
include '../layouts/meta.php';
include '../components/TransactionQuery.php';
include '../components/session.php';
?>
<?php
if (isset($_COOKIE['transaction']) == 'success') {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Transaksi Berhasil Dikonfirmasi",
                icon: "success"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_COOKIE['transaction']);
}
?>
<div class="container-fluid">
    <div class="row">
        <?php include '../layouts/sidenav.php' ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-md-4" style="margin-bottom: 100px;">
            <div class="container mt-3">
                <?php if (isset($_GET['confirm'])) : ?>
                    <a href="ListTransaksi.php" class="btn fw-bold text-bg-danger"><span class="bi bi-backspace">&nbsp;Back</span></a>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover">
                            <thead style="background-color: #1f2833; color:#fff;">
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Nama Pelanggan</th>
                                <th scope="col" class="text-center">Materi</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Jumlah Pesanan</th>
                                <th scope="col" class="text-center">Status Pesanan</th>
                                <th scope="col" class="text-center">Bukti Transaksi</th>
                                <th scope="col" class="text-center">Konfirmasi</th>
                            </thead>
                            <?php
                            $no = 1;
                            foreach ($PendingTransaction as $P) :
                            ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <tbody>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center"><?= $P['firstname'] . " " . $P['lastname'] ?></td>
                                        <td class="text-center"><?= $P['lesson'] ?></td>
                                        <td class="text-center"><?= $P['total'] ?></td>
                                        <td class="text-center"><?= $P['qty'] ?></td>
                                        <td class="text-center">
                                            <?php if ($P['status'] == 'pending') : ?>
                                                <span class="bi bi-hourglass-split fw-bold btn btn-outline-warning">&nbsp;Pending</span>
                                            <?php else : ?>
                                                <span class="bi bi-x-circle fw-bold btn btn-outline-danger">&nbsp;Cancel</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><a href="../public/transaction_proof/<?= $P['transaction_proof'] ?>" download="../public/transaction_proof/<?= $P['transaction_proof'] ?>" class="btn fw-bold btn-outline-primary"><span class="bi bi-download">&nbsp;Download</span></a></td>
                                        <td class="text-center">
                                            <input type="text" name="transaction_id" id="transaction_id" class="d-none" value="<?= $P['transaction_id'] ?>" readonly>
                                            <button type="submit" name="add" class="btn fw-bold btn-success text-light"><span class="bi bi-check2-all">&nbsp;Konfirmasi</span></button>
                                        </td>
                                    </tbody>
                                </form>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php else : ?>
                    <form action="" method="get">
                        <button type="submit" name="confirm" class="btn fw-bold text-bg-success"><span class="bi bi-check2-all">&nbsp;Konfirmasi Transaksi</span></button>
                    </form>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover">
                            <thead style="background-color: #1f2833; color:#fff;">
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Nama Pelanggan</th>
                                <th scope="col" class="text-center">Materi</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Jumlah Pesanan</th>
                                <th scope="col" class="text-center">Berlaku Sampai Dengan</th>
                                <th scope="col" class="text-center">Bukti Transaksi</th>
                                <th scope="col" class="text-center">Edit</th>
                            </thead>
                            <?php
                            $no = 1;
                            foreach ($ApprovedTransaction as $A) :
                            ?>
                                <tbody>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><?= $A['firstname'] . " " . $A['lastname'] ?></td>
                                    <td class="text-center"><?= $A['lesson'] ?></td>
                                    <td class="text-center"><?= $A['total'] ?></td>
                                    <td class="text-center"><?= $A['qty'] ?></td>
                                    <td class="text-center"><?= $A['expired_at'] ?></td>
                                    <td class="text-center"><a href="../public/transaction_proof/<?= $A['transaction_proof'] ?>" download="../public/transaction_proof/<?= $A['transaction_proof'] ?>" class="btn fw-bold" style="background-color: #1f2833; color:#fff;"><span class="bi bi-download">&nbsp;Download</span></a></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $A['transaction_id'] ?>">
                                            <span class="bi bi-pencil-square">&nbsp;Edit</span>
                                        </button>
                                        <div class="modal fade" id="edit<?= $A['transaction_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex justify-content-center mb-3">
                                                            <h5 class="fw-bold">Riwayat Transaksi <?= $A['firstname'] . " " . $A['lastname'] ?></h5>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <div class="form-group">
                                                                    <label for="name" class="float-start">Nama :</label>
                                                                    <input type="text" name="name" id="name" value="<?= $A['firstname'] . " " . $A['lastname'] ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <div class="form-group">
                                                                    <label for="materi" class="float-start">Nama Materi :</label>
                                                                    <input type="text" name="materi" id="materi" value="<?= $A['lesson'] ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <div class="form-group">
                                                                    <label for="jumlah" class="float-start">Jumlah Pesanan :</label>
                                                                    <input type="text" name="jumlah" id="jumlah" value="<?= $A['qty'] ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <div class="form-group">
                                                                    <label for="total" class="float-start">Total Harga :</label>
                                                                    <input type="text" name="total" id="total" value="<?= $A['total'] ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <label for="status" class="float-start">Status Pembelian :</label>
                                                                        <select class="form-select" name="status">
                                                                            <option value="<?= $A['status'] ?>">Approved</option>
                                                                            <option value="pending">Pending</option>
                                                                            <option value="approved">Approved</option>
                                                                            <option value="cancel">Cancel</option>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="text" name="id" id="id" value="<?= $A['transaction_id'] ?>" class="d-none">
                                                        <button type="submit" name="edit" id="edit" class="btn fw-bold" style="background-color: #0002A1; color:#fff;"><span class="bi bi-pencil-square">&nbsp;Edit</span></button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tbody>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#pict').attr('src', e.target.result).width(400).height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('input', function(e) {
        slug.value = title.value.toLowerCase().replace(/ /g, '-');
    });

    // Text Editor JS
    $(document).ready(function() {
        $('#desc').summernote({
            placeholder: 'Tulis deskripsi artikel disini...',
            tabsize: 2,
            height: 100
        });
    });

    $(document).ready(function() {
        $('#body').summernote({
            placeholder: 'Tulis konten artikel disini...',
            tabsize: 2,
            height: 200
        });
    });
</script>