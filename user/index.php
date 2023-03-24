<?php
$title = 'Home';
include '../layouts/meta.php';
include '../layouts/navbar.php';

$CheckTransaction = $config->query("SELECT * FROM transaction WHERE user_id = '$_SESSION[user_id]' AND status = 'approved'");
$check = mysqli_fetch_assoc($CheckTransaction);

$LessonList = $config->query("SELECT * FROM lesson");

if (isset($_GET['buy'])) :
    $lesson_id = $_GET['lesson_id'];

    if (isset($_SESSION['transaksi'][$lesson_id])) {
        echo "<script>
                alert('Pesanan sudah ada didalam keranjang!');
                document.location.href = 'index.php';
            </script>";
    } else {
        $_SESSION['transaksi'][$lesson_id] = 1;
        $_SESSION['pesanan'] = 'berhasil';
        echo "<script>
                document.location.href = 'cart.php';
            </script>";
    }
endif;
if (isset($_GET['bought'])) :
    $_SESSION['empty'] = true;
endif;
?>
<?php
if (isset($_SESSION['not_subscribe']) == true) {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Anda belum berlangganan pada AmanaTax",
                icon: "warning"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_SESSION['not_subscribe']);
}
?>
<?php
if (isset($_SESSION['login']) == 'login') {
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
    unset($_SESSION['login']);
}
?>
<?php
if (isset($_SESSION['pesanan']) == 'gagal') {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Materi Sudah Didalam Keranjang",
                icon: "warning"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_SESSION['pesanan']);
}
?>
<?php
if (isset($_SESSION['empty']) == true) {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Video Pada Materi Belum Ada",
                icon: "warning"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_SESSION['empty']);
}
?>
<style>
    @media only screen and (max-width: 320px) {
        #contnav .row .col-lg-6 .swiper {
            width: 100%;
            height: 100%;
        }

        .about {
            margin-bottom: 25px;
        }

        .abouts {
            padding: 25px;
        }

        .info {
            margin-top: 0px;
        }

        .slicker-slide {
            height: 85%;
        }
    }

    @media only screen and (min-width: 375px) {
        #contnav .row .col-lg-6 .swiper {
            width: 100%;
            height: 100%;
        }
    }

    @media only screen and (min-width: 425px) {
        #contnav .row .col-lg-6 .swiper {
            width: 100%;
            height: 100%;
        }
    }

    @media only screen and (min-width: 768px) {
        #contnav .row .col-lg-6 .swiper {
            width: 100%;
            height: 100%;
        }
    }

    @media only screen and (min-width: 992px) {
        #contnav .row .col-lg-6 .swiper {
            width: 55%;
            height: 50%;
        }

        .about {
            margin-bottom: 0px;
        }

        .slicker-slide {
            height: 73%;
        }
    }

    .jumbotron {
        background-color: #1f2833;
        color: #fff;
    }

    #contnav .row .col-lg-6 {
        padding: 40px;
    }

    #contnav .row .col-lg-6 .swiper .swiper-wrapper {
        height: 80%;
    }

    #contnav .row .col-lg-6 .swiper .swiper-wrapper .swiper-slide {
        cursor: pointer;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        height: auto;
        background: transparent;
        width: 420px;
        border-radius: 12px;
        overflow: hidden;
    }

    .daftar {
        background-color: #13cfac;
        color: #1f2833;
        border-radius: 20px;
        width: 200px;
    }

    .daftar:hover {
        background-color: #1f2833;
        color: #13cfac;
    }

    .slicker-slide {
        padding: 1rem;
    }

    #buy {
        background-color: #13cfac;
        color: #1f2833;
    }

    #buy:hover {
        transform: scale(1.05);
        transition: all 0.3s ease-in-out;
        box-shadow: 0 0 20px #fff;
        background-color: #212529;
        color: #13cfac;
    }

    .diskon {
        background-color: #13cfac;
        color: #212529;
        border-radius: 5px;
        padding: 5px;
    }

    .materi {
        border-radius: 8px;
        background-color: #212529;
        color: #fff;
        padding: 5px;
    }

    .materi:hover {
        transform: scale(1.05);
        transition: all 0.3s ease-in-out;
        box-shadow: 0 0 20px #212529;
        background-color: #fff;
        color: #1f2833;
    }
</style>
<section class="jumbotron">
    <div class="container" id="contnav">
        <div class="row">
            <div class="col-lg-6 d-flex justify-content-center mt-3">
                <div id="about">
                    <h3><b>Amana Tax</b></h3>
                    <h5>
                        <i class="bi bi-camera-video"></i>&nbsp;Online Video Training & Grup Diskusi Pajak
                    </h5>
                    <h3><b>Program pelatihan & sertifikat kompetensi BREVET PAJAK A & B Sebagai Bekal Keterampilan Memasuki dunia kerja, profesi & usaha</b></h3>
                    <p><i>Dapatkan kesempatan magang di kantor konsultan pajak</i></p>
                    <?php if (isset($check)) : ?>
                    <?php else : ?>
                        <a href="#lesson" class="btn fw-bold daftar">Daftar Sekarang</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-center">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="../public/img/kapan.png" class="card-img-top" />
                            </div>
                            <div class="swiper-slide">
                                <img src="../public/img/dimana.png" class="card-img-top" />
                            </div>
                            <div class="swiper-slide">
                                <img src="../public/img/hemat.png" class="card-img-top" />
                            </div>
                            <div class="swiper-slide">
                                <img src="../public/img/ulang.png" class="card-img-top" />
                            </div>
                            <div class="swiper-slide">
                                <img src="../public/img/akses.png" class="card-img-top" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#fff" fill-opacity="1" d="M0,128L120,144C240,160,480,192,720,181.3C960,171,1200,117,1320,90.7L1440,64L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
    </svg>
</section>
<div class="container">
    <div class="row d-flex justify-content-center abouts">
        <h4 class="text-center fw-bold text-wrap">Amanatax Fokus Memberikan Bekal Keterampilan<br>Memasuki Dunia Kerja, Profesi & Usaha</h4>
        <hr class="mb-4">
        <div class="col-md-3">
            <div class="card shadow about" style="background-color: #1f2833; color: #fff;">
                <img src="../public/img/materi.jpg" class="card-img-top" height="200">
                <div class="card-body">
                    <p class="card-text">
                        Video Pembelajaran Yang Disampaikan Menyenangkan Dan Tidak Membosankan
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow about" style="background-color: #1f2833; color: #fff;">
                <img src="../public/img/diskusi.jpg" class="card-img-top" height="200">
                <div class="card-body">
                    <p class="card-text">
                        Tim Instruktur Yang Berpengalaman Dan Kompeten Di Bidangnya
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow about" style="background-color: #1f2833; color: #fff;">
                <img src="../public/img/belajar.jpeg" class="card-img-top" height="200">
                <div class="card-body">
                    <p class="card-text">
                        Video Pembelajaran Sangat Aplikatif Sesuai Realita Di Dunia Kerja, Profesi & Usaha
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow about" style="background-color: #1f2833; color: #fff;">
                <img src="../public/img/kurikulum.jpg" class="card-img-top" height="200">
                <div class="card-body">
                    <p class="card-text">
                        Modul Pelatihan Yang Selalu Di-Update sesuai peraturan terbaru (Update UU HPP)
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="video-player" style="background-color: #1f2833;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#fff" fill-opacity="1" d="M0,32L60,74.7C120,117,240,203,360,218.7C480,235,600,181,720,149.3C840,117,960,107,1080,112C1200,117,1320,139,1380,149.3L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
    </svg>
    <div class="container">
        <div class="info py-4">
            <h4 class="text-center fw-bold text-light">Sekilas Tentang Amanatax</h4>
            <hr class="mb-4 text-light">
            <div class="row d-flex justify-content-center" id="video">
                <video controls poster="../public/img/thumbnail3.jpeg" id="video" controls controlsList="nodownload" style="width: auto;">
                    <source src="../public/video/video1.mp4" id="video" />
                </video>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#fff" fill-opacity="1" d="M0,32L60,74.7C120,117,240,203,360,218.7C480,235,600,181,720,149.3C840,117,960,107,1080,112C1200,117,1320,139,1380,149.3L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
    </svg>
</section>
<div class="container py-3" style="color: #fff;">
    <h4 class="text-center fw-bold">Online Course</h4>
    <div class="slicker" id="lesson">
        <div class="slicker-wrapper">
            <?php foreach ($LessonList as $lesson) {
                $CountVideo = mysqli_num_rows($config->query("SELECT * FROM video WHERE lesson_id = '$lesson[lesson_id]'"));
            ?>
                <div class="slicker-slide">
                    <div class="card materi">
                        <img src="../public/uploaded_img/<?= $lesson['pict'] ?>" width="100%" height="300" />
                        <div class="card-body">
                            <div class="card-text">
                                <span class="d-flex justify-content-center fw-bold"><?= $lesson['lesson'] ?></span>
                            </div>
                            <?php if ($lesson['discount'] > 0) { ?>
                                <div class="d-flex justify-content-between mt-3">
                                    <div class="card-disc">
                                        <span>
                                            <b class="diskon">
                                                <?= $lesson['discount'] ?>%
                                            </b>
                                        </span>
                                    </div>
                                    <div class="card-disc">
                                        <span>
                                            <del>
                                                Rp. <?= number_format($lesson['price'], 0, ".", ".") ?>
                                            </del>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="card-price mt-3">
                                        <spab class="float-start fw-bold">
                                            Hanya&nbsp;&nbsp;Rp. <?= number_format($lesson['price'] - ($lesson['discount'] / 100) * $lesson['price'], 0, ".", ".") ?>
                                        </spab>
                                    </div>
                                    <div class="card-price mt-3">
                                        <span class="float-end text-nowrap">
                                            <b class="diskon">
                                                <?= $CountVideo ?> Video
                                            </b>
                                        </span>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="d-flex justify-content-between">
                                    <div class="card-price mt-3">
                                        <span class="float-start fw-bold">
                                            Rp. <?= number_format($lesson['price'], 0, ".", ".") ?>
                                        </span>
                                    </div>
                                    <div class="card-price mt-3">
                                        <span class="float-end text-nowrap">
                                            <b class="diskon">
                                                <?= $CountVideo ?> Video
                                            </b>
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="card-action d-flex justify-content-center">
                                <?php if ($CountVideo > 0) : ?>
                                    <form action="" method="get">
                                        <input type="text" name="lesson_id" id="lesson_id" value="<?= $lesson['lesson_id'] ?>" class="d-none">
                                        <button type="submit" name="buy" id="buy" class="btn fw-bold">Berlangganan Sekarang</button>
                                    </form>
                                <?php else : ?>
                                    <form action="" method="get">
                                        <input type="text" name="lesson_id" id="lesson_id" value="<?= $lesson['lesson_id'] ?>" class="d-none">
                                        <button type="submit" name="bought" id="buy" class="btn fw-bold">Berlangganan Sekarang</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include '../layouts/footer.php'; ?>
<script type="text/javascript">
    $(".slicker-wrapper").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        dots: true,
        infinite: true,
        autoplay: true,
        speed: 1500,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    $(".swiper-wrapper").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        autoplay: true,
        speed: 1500,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
</script>