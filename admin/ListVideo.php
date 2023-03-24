<?php
if (isset($_POST['tambah'])) {
    $title = 'Tambah Video';
} else if (isset($_POST['edit'])) {
    $title = 'Edit Video';
} else {
    $title = 'Daftar Video';
}
include '../layouts/meta.php';
include '../components/VideoQuery.php';
include '../components/session.php';
?>
<?php
if (isset($_COOKIE['video']) == 'success') {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Video Berhasil Ditambahkan",
                icon: "success"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_COOKIE['video']);
}
?>
<div class="container-fluid">
    <div class="row">
        <?php include '../layouts/sidenav.php' ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-md-4" style="margin-bottom: 100px;">
            <div class="container mt-3">
                <?php if (isset($_GET['tambah'])) : ?>
                    <a href="ListVideo.php" class="btn fw-bold" style="background-color: #1f2833; color:#fff;"><span class="bi bi-backspace">&nbsp;Back</span></a>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4 class="text-center">Tambah Video</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-center">
                                                <video controls width="400" width="200" id="video" controls controlsList="nodownload">
                                                    <source src="" id="video" />
                                                </video>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <input type="file" name="video" id="video-input" onchange="readURL(this);" class="d-none" accept="video/mp4, video/mkv" required />
                                                <label for="video-input" id="choose" class="d-flex justify-content-center btn fw-bold mt-3" style="background-color: #1f2833; color: #fff;"><span class="bi bi-upload">&nbsp;&nbsp;Pilih Video</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-center">
                                            <img id="pict" src="../public/img/img-thumbnail.png" width="400" height="200" />
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="file" name="pict" id="image-input" onchange="read(this);" class="d-none" accept="image/jpeg, image/png, image/jpg" required />
                                            <label for="image-input" id="choose" class="d-flex justify-content-center btn fw-bold mt-3" style="background-color: #1f2833; color: #fff;"><span class="bi bi-upload">&nbsp;&nbsp;Pilih Gambar</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="category" class="fw-bold">Kategori Video :</label>
                                            <select class="form-select" name="category" required>
                                                <option value="">---</option>
                                                <?php $no = 1;
                                                foreach ($Lesson as $L) {

                                                    if ($LessonTitle == $L['lesson_id']) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                    <option value="<?= $L['lesson_id'] ?>" <?= $selected ?>> <?= $L['lesson'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="title" class="fw-bold">Judul Video :</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan Judul Video" required>
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
                    $EditVideo = $config->query("SELECT * FROM video JOIN lesson USING (lesson_id) WHERE video_id = '$_GET[id]'");
                    $Video = mysqli_fetch_assoc($EditVideo);
                ?>
                    <a href="ListVideo.php" class="btn fw-bold" style="background-color: #1f2833; color:#fff;"><span class="bi bi-backspace">&nbsp;Back</span></a>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4 class="text-center">Edit Video</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-center">
                                                <video controls width="400" height="200" id="video" controls controlsList="nodownload">
                                                    <source src="../public/uploaded_video/<?= $Video['video'] ?>" id="video" />
                                                </video>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <input type="file" name="video" id="video-input" onchange="readURL(this);" class="d-none" accept="video/mp4, video/mkv" />
                                                <label for="video-input" id="choose" class="d-flex justify-content-center btn fw-bold mt-3" style="background-color: #1f2833; color: #fff;"><span class="bi bi-upload">&nbsp;&nbsp;Pilih Video</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-center">
                                            <img id="pict" src="../public/uploaded_img/<?= $Video['thumbnail'] ?>" width="400" height="200" />
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="file" name="pict" id="image-input" onchange="read(this);" class="d-none" accept="image/jpeg, image/png, image/jpg" />
                                            <label for="image-input" id="choose" class="d-flex justify-content-center btn fw-bold mt-3" style="background-color: #1f2833; color: #fff;"><span class="bi bi-upload">&nbsp;&nbsp;Pilih Gambar</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="category" class="fw-bold">Kategori Video :</label>
                                            <select class="form-select" name="category">
                                                <option value="<?= $Video['lesson_id'] ?>"><?= $Video['lesson'] ?></option>
                                                <?php $no = 1;
                                                foreach ($Lesson as $L) {

                                                    if ($LessonTitle == $L['lesson_id']) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                    <option value="<?= $L['lesson_id'] ?>" <?= $selected ?>> <?= $L['lesson'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="title" class="fw-bold">Judul Video :</label>
                                            <input type="text" name="title" id="title" class="form-control" value="<?= $Video['title'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 mb-3 d-flex justify-content-center">
                                        <input type="text" name="video_id" id="video_id" value="<?= $Video['video_id'] ?>" class="d-none">
                                        <button type="submit" name="edit" class="btn fw-bold" style="background-color: #0002A1; color: #fff;">
                                            <span class="bi bi-pencil-square">&nbsp;Edit</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php else : ?>
                    <form action="" method="get">
                        <button type="submit" name="tambah" class="btn fw-bold" style="background-color: #1f2833; color: #fff;"><span class="bi bi-plus">&nbsp;Tambah Video</span></button>
                    </form>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover">
                            <thead style="background-color: #1f2833; color:#fff;">
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Thumbnail</th>
                                <th scope="col" class="text-center">Kategori</th>
                                <th scope="col" class="text-center">Judul</th>
                                <th scope="col" class="text-center">Edit/Delete</th>
                            </thead>
                            <?php
                            $no = 1;
                            foreach ($VideoQuery as $V) :
                            ?>
                                <tbody>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><img src="../public/uploaded_img/<?= $V['thumbnail'] ?>" width="80"></td>
                                    <td class="text-center"><?= $V['lesson'] ?></td>
                                    <td class="text-center"><?= $V['title'] ?></td>
                                    <td class="text-center">
                                        <form action="" method="get">
                                            <input type="text" name="id" id="id" value="<?= $V['video_id'] ?>" class="d-none">
                                            <button type="submit" name="update" id="update" class="btn fw-bold mb-3" style="background-color: #0002A1; color:#fff;"><span class="bi bi-pencil-square">&nbsp;Edit</span></button>
                                            <button type="button" class="btn fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#delete<?= $V['video_id'] ?>" style="background-color: #CF0A0A; color:#fff;"><span class="bi bi-trash">&nbsp;Hapus</span></button>
                                            <div class="modal fade" id="delete<?= $V['video_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda yakin ingin menghapus video berjudul<br>"<?= $V['title'] ?>"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="text" name="video_id" id="video_id" value="<?= $V['video_id'] ?>" class="d-none">
                                                            <button type="submit" name="delete" id="delete" class="btn fw-bold" style="background-color: #CF0A0A; color:#fff;"><span class="bi bi-trash">&nbsp;Hapus</span></button>
                                                            <button type="button" class="btn fw-bold text-bg-secondary" data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                $('#video').attr('src', e.target.result).width(400).height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function read(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#pict').attr('src', e.target.result).width(400).height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>