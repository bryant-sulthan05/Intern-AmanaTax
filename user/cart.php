<?php
$title = 'Cart';
include '../layouts/meta.php';
include '../layouts/navbar.php';

$payment_id = 0;
$payment = "";
$rek = "";
$fee = "";
$query = $config->query("SELECT * FROM payment");

if (isset($_POST['delete'])) :
    $lesson_id = $_POST["id"];

    unset($_SESSION["transaksi"][$lesson_id]);

    $_SESSION['delete'] = true;
    echo "<script>location= 'cart.php'</script>";
endif;
?>
<?php
if (isset($_SESSION['pesanan']) == 'berhasil') {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Materi Berhasil Dimasukkan Keranjang",
                icon: "success"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_SESSION['pesanan']);
}
?>
<?php
if (isset($_SESSION['delete']) == true) {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Materi Berhasil Dihapus",
                icon: "success"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_SESSION['delete']);
}
?>
<div class="container p-5">
    <h3><i class="bi bi-cart me-3"></i>Transaksi Anda</h3>
    <hr class="mb-3">
    <div class="card p-3 bg-light">
        <span class="fw-bold mb-2">Pembeli : <?= $s['firstname'] . " " . $s['lastname'] ?></span>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Materi</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subharga</th>
                            <th scope="col" class="d-flex justify-content-center">Hapus</th>
                        </tr>
                    </thead>
                    <?php if (empty($_SESSION['transaksi']) || !isset($_SESSION['transaksi'])) : ?>
                        <tbody>
                            <tr>
                                <td colspan="8">
                                    <h4 class="text-center fw-bold">Keranjang Kosong</h4>
                                </td>
                            </tr>
                        </tbody>
                    <?php else : ?>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php $subtotal = 0; ?>
                            <?php foreach ($_SESSION["transaksi"] as $lesson_id => $jumlah) : ?>
                                <?php
                                $ambil = $config->query("SELECT * FROM lesson WHERE lesson_id = '$lesson_id'");
                                $pecah = $ambil->fetch_assoc();
                                $subharga = $pecah["price"] * $jumlah;
                                $totaldiskon = $pecah["discount"] * $jumlah;
                                ?>
                                <tr>
                                    <td><?= $nomor++; ?></td>
                                    <td><img src="../public/uploaded_img/<?= $pecah['pict'] ?>" width="100"></td>
                                    <td><?= $pecah["lesson"] ?></td>
                                    <td>Rp. <?= number_format($pecah["price"], 0, ".",  "."); ?></td>
                                    <td><?= $totaldiskon; ?>&nbsp;%</td>
                                    <td><?= $jumlah; ?></td>
                                    <?php if ($pecah['discount'] > 0) { ?>
                                        <td>Rp. <?= number_format($subharga - ($pecah['discount'] / 100) * $subharga, 0, ".", "."); ?></td>
                                    <?php } else { ?>
                                        <td>Rp. <?= number_format($subharga, 0, ".", "."); ?></td>
                                    <?php } ?>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="text" name="id" id="id" class="d-none" value="<?= $lesson_id ?>">
                                                <button type="submit" name="delete" id="delete" class="btn fw-bold" style="background-color: #CF0A0A; color: #fff;"><span class="bi bi-trash">&nbsp;Hapus</span></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php $nomor++; ?>
                                <?php if ($pecah['discount'] > 0) { ?>
                                    <?php $subtotal += $subharga - ($pecah['discount'] / 100) * $subharga; ?>
                                <?php } else { ?>
                                    <?php $subtotal += $subharga; ?>
                                <?php } ?>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6">Subtotal Belanja</th>
                                <th colspan="2">Rp. <?= number_format($subtotal, 0, ".", ".") ?></th>
                            </tr>
                        </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Pilih Metode Pembayaran</th>
                                <td>
                                    <select class="form-select" name="method" id="method">
                                        <option value="">Metode Pembayaran</option>
                                        <?php $no = 1;
                                        foreach ($query as $pay) {
                                            if ($payment == $pay['payment_id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                        ?>
                                            <option value="<?= $pay['payment_id'] ?>" <?= $selected ?>> <?= $pay['payment_method'] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="d-none">
                                <th>No Rekening</th>
                                <td><span name="acc_number" id="acc_number" class="form-control"></span></td>
                            </tr>
                            <tr>
                                <th>No Rekening</th>
                                <td><input type="text" name="rek" id="rek" class="form-control" placeholder="No Rekening"></td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-md-6">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Subtotal</th>
                                <td>Rp. <?= number_format($subtotal, 0, ".", "."); ?></td>
                            </tr>
                            <tr>
                                <th>Diskon</th>
                                <td><?= $totaldiskon ?>&nbsp;&nbsp;%</td>
                            </tr>
                            <tr>
                                <th>Pajak</th>
                                <td><span name="fee" id="fee" class="input"></span></td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Total Belanja</th>
                                <th><span id="total1" class="input"></span></th>
                                <input type="hidden" name="total" id="total">
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <button type="submit" name="confirm" id="confirm" class="btn fw-bold col-12" style="background-color: #13cfac; color: #1f2833;">Konfirmasi Pesanan</button>
        </form>
    <?php endif; ?>
    </div>
    <?php
    if (isset($_POST['confirm'])) {
        $user_id = $_SESSION['user_id'];
        $method = $_POST['method'];
        date_default_timezone_set("Asia/Jakarta");
        $tgl =  date("Y-m-d H:i:s");
        $total = $_POST['total'];

        foreach ($_SESSION["transaksi"] as $lesson_id => $jumlah) {
            $insert = $config->query("INSERT INTO transaction VALUES (NULL, '$user_id', '$lesson_id', '$method', NULL, '$subtotal', '$total', '$jumlah', '$_POST[rek]', 'pending', NULL, '$tgl', '$tgl')");
        }
        unset($_SESSION["transaksi"]);

        echo "<script>alert('Pemesanan akan segera diproses!');</script>";
        echo "<script>window.location= 'ListTransaksi.php';</script>";
    }
    ?>
</div>
<script>
    $(document).ready(function() {
        $("#method").click(function() {
            $.ajax({
                url: '../components/fee.php',
                type: 'post',
                data: {
                    payment_id: $("#method").val()
                },
                dataType: "JSON",
                success: function(data) {
                    $(".form-group").show();
                    $("#fee").text(data.fee);
                    $("#acc_number").text(data.acc_number);
                    let subtotal = parseInt("<?= $subtotal ?>")
                    let fee = parseInt($('span[name="fee"]').html())
                    let total = (fee + subtotal)

                    $('#total1').html(total)
                    document.querySelector('#total').value = total
                }
            });
        });
    });
</script>