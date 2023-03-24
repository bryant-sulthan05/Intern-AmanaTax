<section class="watch mb-5 px-5">
    <h4 class="fw-bold"><?= $Watch['title'] ?></h4>
    <hr>
    <div class="row d-flex justify-content-center" id="video">
        <video controls poster="../public/uploaded_img/<?= $Watch['thumbnail'] ?>" id="video" controls controlsList="nodownload" style="width: auto;">
            <source src="../public/uploaded_video/<?= $Watch['video'] ?>" id="video" />
        </video>
    </div>
    <div class="VideoList mt-5">
        <h4 class="fw-bold">Video berlangganan lainnya</h4>
        <hr>
        <div class="row justify-content-center">
            <?php foreach ($Video as $v) : ?>
                <?php if ($v['expired_at'] > $tgl) : ?>
                    <div class="col-md-3">
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
        </div>
    </div>
</section>