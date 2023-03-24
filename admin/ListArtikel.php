<?php
if (isset($_POST['tambah'])) {
    $title = 'Tambah Artikel';
} else if (isset($_POST['edit'])) {
    $title = 'Edit Artikel';
} else {
    $title = 'Daftar Artikel';
}
include '../layouts/meta.php';
include '../components/ArticleQuery.php';
include '../components/session.php';
?>
<?php
if (isset($_COOKIE['article']) == 'success') {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Artikel Berhasil Ditambahkan",
                icon: "success"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_COOKIE['article']);
}
?>
<?php
if (isset($_COOKIE['updated']) == 'success') {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Artikel Berhasil Diupdate",
                icon: "success"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_COOKIE['updated']);
}
?>
<?php
if (isset($_COOKIE['delete']) == 'success') {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Artikel Berhasil Dihapus",
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
                    <a href="ListArtikel.php" class="btn fw-bold" style="background-color: #1f2833; color:#fff;"><span class="bi bi-backspace">&nbsp;Back</span></a>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4 class="text-center">Tambah Artikel</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="d-flex justify-content-center">
                                            <img id="pict" src="../public/img/input-img.png" width="400" height="200" />
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="file" name="pict" id="image-input" onchange="readURL(this);" class="d-none" accept="image/jpeg, image/png, image/jpg" required />
                                            <label for="image-input" id="choose" class="d-flex justify-content-center btn fw-bold mt-3" style="background-color: #1f2833; color: #fff;"><span class="bi bi-upload">&nbsp;&nbsp;Pilih Gambar</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="category" class="fw-bold">Kategori Artikel :</label>
                                            <select class="form-select" name="category" required>
                                                <option value="">---</option>
                                                <?php $no = 1;
                                                foreach ($Categories as $C) {

                                                    if ($CategoryTitle == $C['category_id']) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                    <option value="<?= $C['category_id'] ?>" <?= $selected ?>> <?= $C['category'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="title" class="fw-bold">Judul Artikel :</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan Judul Artikel" required>
                                            <input type="text" name="slug" id="slug" class="form-control d-none" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="desc" class="fw-bold">Deskripsi :</label>
                                            <textarea name="desc" id="desc" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="body" class="fw-bold">Konten Artikel :</label>
                                            <textarea name="body" id="body" class="form-control" required></textarea>
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
                    $Article = $config->query("SELECT category_id, article_id, category, pict, title, article.slug, description, body FROM article JOIN categories USING (category_id) WHERE article_id = '$_GET[id]'");
                    $art = mysqli_fetch_assoc($Article);
                ?>
                    <a href="ListArtikel.php" class="btn fw-bold" style="background-color: #1f2833; color:#fff;"><span class="bi bi-backspace">&nbsp;Back</span></a>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4 class="text-center">Edit Artikel</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="d-flex justify-content-center">
                                            <img id="pict" src="../public/uploaded_img/<?= $art['pict'] ?>" width="400" height="200" />
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="file" name="pict" id="image-input" onchange="readURL(this);" class="d-none" accept="image/jpeg, image/png, image/jpg" />
                                            <label for="image-input" id="choose" class="d-flex justify-content-center btn fw-bold mt-3" style="background-color: #1f2833; color: #fff;"><span class="bi bi-upload">&nbsp;&nbsp;Pilih Gambar</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="category" class="fw-bold">Kategori Artikel :</label>
                                            <select class="form-select" name="category">
                                                <option value="<?= $art['category_id'] ?>"><?= $art['category'] ?></option>
                                                <?php $no = 1;
                                                foreach ($Categories as $C) {

                                                    if ($CategoryTitle == $C['category_id']) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                    <option value="<?= $C['category_id'] ?>" <?= $selected ?>> <?= $C['category'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="title" class="fw-bold">Judul Artikel :</label>
                                            <input type="text" name="title" id="title" class="form-control" value="<?= $art['title'] ?>" required>
                                            <input type="text" name="slug" id="slug" class="form-control" value="<?= $art['slug'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="desc" class="fw-bold">Deskripsi :</label>
                                            <textarea name="desc" id="desc" class="form-control" required><?= $art['description'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="body" class="fw-bold">Konten Artikel :</label>
                                            <textarea name="body" id="body" class="form-control" required><?= $art['body'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 mb-3 d-flex justify-content-center">
                                        <input type="text" name="art_id" id="art_id" value="<?= $art['article_id'] ?>" class="d-none">
                                        <button type="submit" name="edit" class="btn fw-bold" style="background-color: #0002A1; color: #fff;"><span class="bi bi-pencil-square">&nbsp;Edit</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php elseif (isset($_GET['preview'])) :
                    $Preview = $config->query("SELECT article.slug, title, category, pict, description, body, article.updated_at FROM article JOIN categories USING (category_id) WHERE article_id = '$_GET[id]'");
                    $Prev = mysqli_fetch_assoc($Preview);
                ?>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <h2 class="text-center fw-bold"><?= $Prev['title'] ?></h2>
                            <hr>
                            <article>
                                <div class="d-flex justify-content-center mb-5">
                                    <img src="../public/uploaded_img/<?= $Prev['pict'] ?>" width="400" height="250">
                                </div>
                                <span>Dibuat pada : <?= $Prev['updated_at'] = date("d/M/Y") ?></span>
                                <h4 class="fw-bold mt-3">Deskripsi</h4>
                                <p><?= $Prev['description'] ?></p>
                                <h4 class="fw-bold">Isi</h4>
                                <p><?= $Prev['body'] ?></p>
                            </article>
                            <a href="ListArtikel.php" class="btn fw-bold float-end" style="background-color: #1f2833; color:#fff;"><span class="bi bi-backspace">&nbsp;Back</span></a>
                        </div>
                    </div>
                <?php else : ?>
                    <form action="" method="get">
                        <button type="submit" name="tambah" class="btn fw-bold" style="background-color: #1f2833; color: #fff;"><span class="bi bi-plus">&nbsp;Tambah Artikel</span></button>
                    </form>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover">
                            <thead style="background-color: #1f2833; color:#fff;">
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Gambar</th>
                                <th scope="col" class="text-center">Judul</th>
                                <th scope="col" class="text-center">Kategori</th>
                                <th scope="col" class="text-center">Deskripsi</th>
                                <th scope="col" class="text-center">Edit/Delete</th>
                            </thead>
                            <?php
                            $no = 1;
                            foreach ($ArticleQuery as $A) :
                            ?>
                                <tbody>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><img src="../public/uploaded_img/<?= $A['pict'] ?>" width="80"></td>
                                    <td class="text-center"><?= $A['title'] ?></td>
                                    <td class="text-center"><?= $A['category'] ?></td>
                                    <td class="text-center">
                                        <form action="" method="get">
                                            <input type="text" name="id" id="id" value="<?= $A['article_id'] ?>" class="d-none">
                                            <button type="submit" name="preview" id="preview" class="btn btn-outline-success fw-bold"><span class="bi bi-eye">&nbsp;Preview</span></button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="" method="get">
                                            <input type="text" name="id" id="id" value="<?= $A['article_id'] ?>" class="d-none">
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