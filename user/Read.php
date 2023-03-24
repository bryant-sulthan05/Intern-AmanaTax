<?php
$Preview = $config->query("SELECT categories.slug as cs, pict, title, article.slug as sa, category, description, body, article.updated_at FROM article JOIN categories USING (category_id) WHERE article.slug = '$_GET[slug]'");
$Prev = mysqli_fetch_assoc($Preview);
?>
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <h2 class="text-center fw-bold"><?= $Prev['title'] ?></h2>
        <hr>
        <article>
            <div class="d-flex justify-content-center mb-5">
                <img src="../public/uploaded_img/<?= $Prev['pict'] ?>" width="400" height="250">
            </div>
            <span>Dibuat pada : <?= $Prev['updated_at'] = date("d/M/Y") ?></span>
            <p><?= $Prev['body'] ?></p>
        </article>
    </div>
</div>