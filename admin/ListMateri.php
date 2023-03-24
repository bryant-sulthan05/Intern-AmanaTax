<?php
if (isset($_POST['tambah'])) {
    $title = 'Tambah Materi';
} else if (isset($_POST['edit'])) {
    $title = 'Edit Materi';
} else {
    $title = 'Daftar Materi';
}
include '../layouts/meta.php';
include '../components/LessonQuery.php';
include '../components/session.php';
?>
<?php
if (isset($_COOKIE['lesson']) == 'success') {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Materi Berhasil Ditambahkan",
                icon: "success"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_COOKIE['lesson']);
}
?>
<?php
if (isset($_COOKIE['edited']) == 'success') {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Materi Berhasil Diedit",
                icon: "success"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_COOKIE['edited']);
}
?>
<?php
if (isset($_COOKIE['delete']) == 'success') {
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
    unset($_COOKIE['delete']);
}
?>
<div class="container-fluid">
    <div class="row">
        <?php include '../layouts/sidenav.php' ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-md-4" style="margin-bottom: 100px;">
            <div class="container mt-3">
                <?php if (isset($_GET['tambah'])) : ?>
                    <a href="ListMateri.php" class="btn fw-bold" style="background-color: #1f2833; color:#fff;"><span class="bi bi-backspace">&nbsp;Back</span></a>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4 class="text-center">Tambah Materi</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="d-flex justify-content-center">
                                            <img id="pict" src="../public/img/input-img.png" width="260" height="300" />
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="file" name="pict" id="image-input" onchange="readURL(this);" class="d-none" accept="image/jpeg, image/png, image/jpg" required />
                                            <label for="image-input" class="d-flex justify-content-center btn fw-bold mt-3" style="background-color: #1f2833; color: #fff;"><span class="bi bi-upload">&nbsp;&nbsp;Pilih Gambar</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="title" class="fw-bold">Judul Materi :</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan Judul Materi" required>
                                            <input type="text" name="slug" id="slug" class="form-control d-none" placeholder="Masukkan Judul Materi" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="price" class="fw-bold">Harga :</label>
                                            <input type="number" name="price" id="price" class="form-control" placeholder="Masukkan Harga Materi" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="discount" class="fw-bold">Diskon :</label>
                                            <input type="text" name="discount" id="discount" class="form-control" placeholder="Masukkan Diskon Materi">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 mb-3 d-flex justify-content-center">
                                        <button type="submit" name="add" class="btn fw-bold" style="background-color: #1f2833; color: #fff;"><span class="bi bi-plus">&nbsp;Tambah</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php elseif (isset($_GET['update'])) :
                    $tes = $config->query("SELECT * FROM lesson WHERE lesson_id = '$_GET[id]'");
                    $t = mysqli_fetch_assoc($tes);
                ?>
                    <a href="ListMateri.php" class="btn fw-bold" style="background-color: #1f2833; color:#fff;"><span class="bi bi-backspace">&nbsp;Back</span></a>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4 class="text-center">Edit Materi</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="d-flex justify-content-center">
                                            <?php if ($t['pict'] == NULL) : ?>
                                                <img id="pict" src="../public/img/input-img.png" width="260" height="300" style="border: #000 solid 1px;" />
                                            <?php else : ?>
                                                <img id="pict" src="../public/uploaded_img/<?= $t['pict'] ?>" width="260" height="300" style="border: #000 solid 1px;" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="file" name="pict" id="image-input" onchange="readURL(this);" accept="image/jpeg, image/png, image/jpg" class="d-none" />
                                            <label for="image-input" class="d-flex justify-content-center btn fw-bold mt-3" style="background-color: #1f2833; color: #fff;"><span class="bi bi-upload">&nbsp;&nbsp;Pilih Gambar</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="title" class="fw-bold">Judul Materi :</label>
                                            <input type="text" name="title" id="title" class="form-control" value="<?= $t['lesson'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="price" class="fw-bold">Harga :</label>
                                            <input type="number" name="price" id="price" class="form-control" value="<?= $t['price'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="disc" class="fw-bold">Diskon :</label>
                                            <input type="text" name="disc" id="disc" class="form-control" value="<?= $t['discount'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 mb-3 d-flex justify-content-center">
                                        <input type="text" name="lesson_id" id="lesson_id" value="<?= $t['lesson_id'] ?>" class="d-none">
                                        <button type="submit" name="edit" class="btn fw-bold" style="background-color: #0002A1; color: #fff;">
                                            <span class="bi bi-pencil-square">&nbsp;Edit</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php
                elseif (isset($_GET['delete'])) :
                    $Delete = $config->query("DELETE FROM lesson WHERE lesson_id = '$_GET[id]'");
                    if ($Delete == true) :
                        echo "
                        <script>
                            alert('Materi Berhasil Dihapus');
                            document.location.href = 'ListMateri.php';
                        </script>
                        ";
                    endif;
                ?>
                <?php else : ?>
                    <form action="" method="get">
                        <button type="submit" name="tambah" class="btn fw-bold" style="background-color: #1f2833; color: #fff;"><span class="bi bi-plus">&nbsp;Tambah Materi</span></button>
                    </form>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover">
                            <thead style="background-color: #1f2833; color:#fff;">
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Gambar</th>
                                <th scope="col" class="text-center">Judul</th>
                                <th scope="col" class="text-center">Harga</th>
                                <th scope="col" class="text-center">Diskon</th>
                                <th scope="col" class="text-center">Edit/Delete</th>
                            </thead>
                            <?php
                            $no = 1;
                            foreach ($LessonQuery as $L) :
                            ?>
                                <tbody>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><img src="../public/uploaded_img/<?= $L['pict'] ?>" width="80"></td>
                                    <td class="text-center"><?= $L['lesson'] ?></td>
                                    <td class="text-center">Rp. <?= number_format($L['price'], 0, ".", ".") ?></td>
                                    <?php if ($L['discount'] > 0) : ?>
                                        <td class="text-center"><?= $L['discount'] ?>%</td>
                                    <?php else : ?>
                                        <td class="text-center">Tidak Ada Diskon</td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <form action="" method="get">
                                            <input type="text" name="id" id="id" value="<?= $L['lesson_id'] ?>" class="d-none">
                                            <button type="submit" name="update" id="update" class="btn fw-bold" style="background-color: #0002A1; color:#fff;"><span class="bi bi-pencil-square">&nbsp;Edit</span></button>
                                            <button type="submit" name="delete" id="delete" class="btn fw-bold" style="background-color: #CF0A0A; color:#fff;"><span class="bi bi-trash">&nbsp;Hapus</span></button>
                                        </form>
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
                $('#pict').attr('src', e.target.result).width(260).height(300);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('input', function(e) {
        slug.value = title.value.toLowerCase().replace(/ /g, '-');
    });
</script>