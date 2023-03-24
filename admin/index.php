<?php
if (isset($_GET['register'])) {
    $title = 'Registerasi';
} else {
    $title = 'Login';
}
include '../layouts/meta.php';
include '../components/AuthAdmin.php';
?>
<style>
    body {
        margin: 5%;
        padding: 2%;
    }

    .card {
        background-color: #1f2833;
        color: #fff;
    }
</style>

<body>
    <?php
    if (isset($_SESSION['logoutAdmin']) == 'logout') {
    ?>
        <script>
            const information = $("#notif", function() {
                Swal.fire({
                    title: "Logout Berhasil",
                    icon: "success"
                });
            });
        </script>
        <div class="notif" id="notif" data-infodata="info"></div>
    <?php
        unset($_SESSION['logoutAdmin']);
    }
    ?>
    <?php
    if (isset($_SESSION['EmailError']) == 'gagal') {
    ?>
        <script>
            const information = $("#notif", function() {
                Swal.fire({
                    title: "Alamat email sudah terpakai!",
                    icon: "warning"
                });
            });
        </script>
        <div class="notif" id="notif" data-infodata="info"></div>
    <?php
        unset($_SESSION['EmailError']);
    }
    ?>
    <?php
    if (isset($_SESSION['reg']) == 'success') {
    ?>
        <script>
            const information = $("#notif", function() {
                Swal.fire({
                    title: "Registerasi Berhasil!",
                    icon: "success"
                });
            });
        </script>
        <div class="notif" id="notif" data-infodata="info"></div>
    <?php
        unset($_SESSION['reg']);
    }
    ?>
    <?php
    if (isset($_SESSION['min_pass']) == 'gagal') {
    ?>
        <script>
            const information = $("#notif", function() {
                Swal.fire({
                    title: "Password harus memiliki minimal 8 karakter!",
                    icon: "warning"
                });
            });
        </script>
        <div class="notif" id="notif" data-infodata="info"></div>
    <?php
        unset($_SESSION['min_pass']);
    }
    ?>
    <?php
    if (isset($_SESSION['LogError']) == 'gagal') {
    ?>
        <script>
            const information = $("#notif", function() {
                Swal.fire({
                    title: "Email atau Password salah!",
                    icon: "warning"
                });
            });
        </script>
        <div class="notif" id="notif" data-infodata="info"></div>
    <?php
        unset($_SESSION['LogError']);
    }
    ?>
    <?php
    if (isset($_SESSION['ErrorAcc']) == 'gagal') {
    ?>
        <script>
            const information = $("#notif", function() {
                Swal.fire({
                    title: "Akun belum terdaftar",
                    icon: "warning"
                });
            });
        </script>
        <div class="notif" id="notif" data-infodata="info"></div>
    <?php
        unset($_SESSION['ErrorAcc']);
    }
    ?>
    <div class="container">
        <?php if (isset($_GET['register'])) : ?>
            <div class="row justify-content-center register">
                <div class="col-md-6">
                    <div class="card p-3 shadow">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-center mb-3">
                                <h4 class="fw-bold">Register</h4>
                            </div>
                            <div class="card-title d-flex justify-content-center">
                                <img src="../public/img/profile.svg" width="128">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="firstname" class="fw-bold">Nama Depan :</label>
                                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Nama depan" required>
                                        </div>
                                </div>
                                <div class="col-md-6 mt-3 mb-3">
                                    <div class="form-group">
                                        <label for="lastname" class="fw-bold">Nama Belakang :</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Nama belakang" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="fw-bold">Email :</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="password" class="fw-bold">Password :</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bi bi-lock" id="basic-addon1"></span>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" required>
                                            <input type="radio" class="btn-check" name="show" id="show" autocomplete="off" aria-hidden="true" onclick="toggle()">
                                            <label class="btn btn-outline-secondary text-light" for="show" style="font-size: 25px;"><span class="bi bi-eye"></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="tlp" class="fw-bold">No tlp :</label>
                                    <div class="input-group">
                                        <span class="input-group-text bi bi-telephone" id="basic-addon1"></span>
                                        <input type="number" name="tlp" id="tlp" class="form-control" placeholder="No tlp" aria-label="Username" aria-describedby="basic-addon1" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="address" class="fw-bold">Alamat :</label>
                                    <textarea name="address" id="address" class="form-control" placeholder="Alamat" required></textarea>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="gender" class="fw-bold">Jenis Kelamin :</label>
                                    <div class="d-flex">
                                        <div class="form-group me-3">
                                            <div class="card text-bg-light">
                                                <div class="d-flex p-2">
                                                    <input type="radio" name="gender" id="laki-laki" value="Laki-laki">
                                                    <label for="laki-laki">&nbsp;Laki-laki</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="card text-bg-light">
                                                <div class="d-flex p-2">
                                                    <input type="radio" name="gender" id="perempuan" value="Perempuan">
                                                    <label for="perempuan">&nbsp;Perempuan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" name="reg" id="reg" class="btn fw-bold col-4" style="background-color: #1877f2; color: #fff;">Daftar</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8">
                                    <div class="form-group mt-3">
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-bold mt-2 ms-4">Sudah Punya Akun?</span>
                                            <form action="" method="get">
                                                <button type="submit" name="login" id="login" class="btn fw-bold me-4" style="background-color: #42b72a; color: #fff;">Login Sekarang</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <?php
            if (isset($_SESSION['regAdmin']) == 'success') {
            ?>
                <script>
                    const information = $("#notif", function() {
                        Swal.fire({
                            title: "Registerasi Berhasil",
                            icon: "success"
                        });
                    });
                </script>
                <div class="notif" id="notif" data-infodata="info"></div>
            <?php
                unset($_SESSION['regAdmin']);
            }
            ?>
            <div class="row justify-content-center login">
                <div class="col-md-6">
                    <div class="card p-3 shadow">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-center mb-3">
                                <h4 class="fw-bold">Login</h4>
                            </div>
                            <div class="card-title d-flex justify-content-center">
                                <img src="../public/img/profile.svg" width="128">
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <label for="email" class="fw-bold">Email :</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bi bi-envelope" id="basic-addon1"></span>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1" required>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="password" class="fw-bold">Password :</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bi bi-lock" id="basic-addon1"></span>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" required>
                                        <input type="radio" class="btn-check" name="show" id="show" autocomplete="off" aria-hidden="true" onclick="toggle()">
                                        <label class="btn btn-outline-secondary text-light" for="show" style="font-size: 25px;"><span class="bi bi-eye"></span></label>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember" class="fw-bold">Remember Me</label>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="login" id="login" class="btn fw-bold col-4" style="background-color: #1877f2; color: #fff;">Login</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-bold mt-2 ms-3">Belum Punya Akun?</span>
                                            <form action="" method="get">
                                                <button type="submit" name="register" id="register" class="btn fw-bold me-4" style="background-color: #42b72a; color:#fff;">Daftar Sekarang</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
<script>
    var state = false;

    function toggle() {
        if (state) {
            document.getElementById("password").setAttribute("type", "password");
            document.getElementById("show");
            state = false;
        } else {
            document.getElementById("password").setAttribute("type", "text");
            document.getElementById("show");
            state = true;
        }
    }
</script>