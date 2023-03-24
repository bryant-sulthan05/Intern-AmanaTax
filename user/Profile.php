<?php
$title = 'Profile';
include '../layouts/meta.php';
include '../layouts/navbar.php';
include '../components/ProfileUser.php';
?>
<style>
    .card {
        background-color: #1f2833;
        color: #fff;
    }
</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <h4 class="fw-bold">Profile</h4>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="d-flex justify-content-center mt-3">
                            <!-- Menampilkan gambar yang dipilih -->
                            <?php if ($s['photo'] == NULL) { ?>
                                <img id="pict" src="../public/img/profile.svg" style="height: 150px;" class="rounded-circle" width="150" />
                            <?php } else { ?>
                                <img id="pict" src="../public/uploaded_img/<?= $s['photo'] ?>" style="height: 150px;" class="rounded-circle" width="150" />
                            <?php } ?>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <!-- Pilih gambar -->
                            <?php if ($s['photo'] == NULL) { ?>
                                <input type="file" name="pict" id="image-input" onchange="readURL(this);" class="d-none" accept="image/jpeg, image/png, image/jpg" value="../public/img/profile.svg" />
                            <?php } else { ?>
                                <input type="file" name="pict" id="image-input" onchange="readURL(this);" class="d-none" accept="image/jpeg, image/png, image/jpg" value="../public/uploaded_img/<?= $s['photo'] ?>" />
                            <?php } ?>
                            <label for="image-input" id="choose" class="d-flex justify-content-center btn fw-bold" style="background-color: #13cfac; color: #1f2833;"><span class="bi bi-upload">&nbsp;&nbsp;Pilih Gambar</span></label>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="firstname" class="fw-bold">Nama depan :</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Nama depan" value="<?= $s['firstname'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="lastname" class="fw-bold">Nama belakang :</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Nama belakang" value="<?= $s['lastname'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="email" class="fw-bold">Email :</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= $s['email'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="password" class="fw-bold">Passsword :</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Passsword (minimal memiliki 8 karakter)" value="<?= $s['plaintext_pass'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="tlp" class="fw-bold">Nomor tlp :</label>
                                    <input type="number" name="tlp" id="tlp" class="form-control" placeholder="Nomor tlp" value="<?= $s['tlp'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="status" class="fw-bold">Status :</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="<?= $s['status'] ?>"><?= $s['status'] ?></option>
                                        <option value="belum bekerja">Belum Bekerja</option>
                                        <option value="pelajar/mahasiswa">Pelajar/Mahasiswa</option>
                                        <option value="wiraswasta">Wiraswasta</option>
                                        <option value="profesional">Profesional</option>
                                        <option value="pns/bumn">PNS & BUMN</option>
                                        <option value="karyawan swasta">Karyawan Swasta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group mt-4">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" name="edit" id="edit" class="btn fw-bold col-4" style="background-color: #13cfac; color: #1f2833;">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../layouts/footer.php'; ?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#pict').attr('src', e.target.result).width(150).height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>