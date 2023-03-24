<?php
$title = 'Video Pembelajaran';
include '../layouts/meta.php';
include '../layouts/navbar.php';
include '../components/VideoUser.php';
?>
<style>
    #watch {
        background-color: #13cfac;
        color: #1f2833;
        border: #1f2833 2px solid;
    }

    #watch:hover {
        background-color: #1f2833;
        color: #13cfac;
        border: #13cfac 2px solid;
    }
</style>
<div class="container mt-5">
    <?php if (isset($_GET['watch'])) :
        $WatchVideo = $config->query("SELECT * FROM video JOIN lesson USING (lesson_id) WHERE video_id = '$_GET[id]'");
        $Watch = mysqli_fetch_assoc($WatchVideo);
    ?>
        <?php include '../user/watch.php' ?>
    <?php else : ?>
        <div class="row d-flex justify-content-center">
            <?php if ($cek) : ?>
                <?php
                $_SESSION['not_subscribe'] = true;
                ?>
                <script>
                    document.location.href = 'index.php';
                </script>
            <?php else : ?>
                <?php foreach ($Video as $v) : ?>
                    <?php if ($v['expired_at'] > $tgl) : ?>
                        <div class="col-md-3 mt-3">
                            <div class="card shadow">
                                <img src="../public/uploaded_img/<?= $v['thumbnail'] ?>" class="card-img-top" height="150">
                                <div class="card-body">
                                    <h6 class="fw-bold"><?= $v['title'] ?></h6>
                                    <div class="d-flex justify-content-center">
                                        <span class="fw-bold btn" style="background-color: #1f2833; color: #13cfac;">Materi <?= $v['lesson'] ?></span>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <form action="" method="get">
                                            <input type="text" name="id" id="id" value="<?= $v['video_id'] ?>" class="d-none">
                                            <button type="submit" name="watch" id="watch" class="btn fw-bold"><span class="bi bi-play-btn">&nbsp;Tonton Video</span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php include '../layouts/footer.php'; ?>