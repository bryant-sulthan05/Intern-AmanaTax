<?php
$title = 'Artikel';
include '../layouts/meta.php';
include '../layouts/navbar.php';

// Ambil Semua Artikel
$All = $config->query("SELECT categories.slug as cs, pict, title, article.slug as sa, category, description, body, article.updated_at FROM article JOIN categories USING (category_id)");
?>
<style>
    #read {
        background-color: #13cfac;
        color: #1f2833;
        border-radius: 10px;
    }

    #read:hover {
        background-color: #1f2833;
        color: #13cfac;
    }
</style>
<div class="container mt-5">
    <?php if (isset($_GET['read'])) : ?>
        <?php include 'Read.php'; ?>
    <?php else : ?>
        <div class="row justify-content-center px-3">
            <?php foreach ($All as $a) : ?>
                <div class="col-md-3 mt-2">
                    <div class="card shadow">
                        <img src="../public/uploaded_img/<?= $a['pict'] ?>" class="card-img-top" height="150">
                        <div class="card-body">
                            <h6 class="fw-bold"><?= $a['title'] ?></h6>
                            <p class="card-text"><?= $a['description'] ?></p>
                            <div class="d-flex justify-content-center">
                                <form action="" method="get">
                                    <input type="text" name="slug" id="slug" value="<?= $a['sa'] ?>" class="d-none">
                                    <button type="submit" name="read" id="read" class="btn fw-bold">Baca selengkapnya</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php include '../layouts/footer.php'; ?>