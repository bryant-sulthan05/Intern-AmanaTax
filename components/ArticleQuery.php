<?php
$created_at = date("Y-m-d H:i:s");
$ArticleQuery = $config->query("SELECT * FROM article JOIN categories USING (category_id)");
$Categories = $config->query("SELECT * FROM categories");
$id = 0;
$CategoryTitle = '';

if (isset($_POST['add'])) :
    $category = $_POST['category'];
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $desc = $_POST['desc'];
    $body = $_POST['body'];
    $thumbnail = $_FILES['pict']['name'];
    $source = $_FILES['pict']['tmp_name'];
    $ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
    if (!file_exists('../public/uploaded_img/' . $thumbnail)) {
        move_uploaded_file($source, '../public/uploaded_img/' . $thumbnail);
        $img = $thumbnail;
    } else {
        $thumbnail = str_replace('.', '-', basename($thumbnail, $ext));
        $newfilename = $thumbnail . time() . "." . $ext;
        move_uploaded_file($source, '../public/uploaded_img/' . $newfilename);
        $img = $newfilename;
    }

    $AddArticle = $config->query("INSERT INTO article VALUES (NULL, '$category', '$img', '$title', '$slug', '$desc', '$body', '$created_at', '$created_at')");
    if ($AddArticle == true) :
        setcookie('article', 'success', time() + 2);
        echo "
            <script>
                document.location.href = 'ListArtikel.php';
            </script>
        ";
    else :
        $_SESSION['article'] = 'failed';
        echo "
            <script>
                document.location.href = 'ListArtikel.php';
            </script>
        ";
    endif;
elseif (isset($_POST['edit'])) :
    $category = $_POST['category'];
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $desc = $_POST['desc'];
    $body = $_POST['body'];
    $thumbnail = $_FILES['pict']['name'];
    $source = $_FILES['pict']['tmp_name'];
    $ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
    if (!file_exists('../public/uploaded_img/' . $thumbnail)) {
        move_uploaded_file($source, '../public/uploaded_img/' . $thumbnail);
        $img = $thumbnail;
    } else {
        $thumbnail = str_replace('.', '-', basename($thumbnail, $ext));
        $newfilename = $thumbnail . time() . "." . $ext;
        move_uploaded_file($source, '../public/uploaded_img/' . $newfilename);
        $img = $newfilename;
    }

    if ($thumbnail == '') :
        $UpdateArticle = $config->query("UPDATE article SET category_id = '$category', title = '$title', slug = '$slug', description = '$desc', body = '$body', updated_at = '$created_at' WHERE article_id = '$_POST[art_id]'");
    else :
        $UpdateArticle = $config->query("UPDATE article SET category_id = '$category', pict = '$img', title = '$title', slug = '$slug', description = '$desc', body = '$body', updated_at = '$created_at' WHERE article_id = '$_POST[art_id]'");
    endif;

    if ($UpdateArticle == true) :
        setcookie('updated', 'success', time() + 2);
        echo "
            <script>
                document.location.href = 'ListArtikel.php';
            </script>
        ";
    else :
        $_SESSION['article'] = 'failed';
        echo "
            <script>
                document.location.href = 'ListArtikel.php';
            </script>
        ";
    endif;
elseif (isset($_GET['delete'])) :
    $DeleteArt = $config->query("DELETE FROM article WHERE article_id = '$_GET[id]'");
    if ($DeleteArt == true) :
        setcookie('delete', 'success', time() + 2);
        echo "
            <script>
                document.location.href = 'ListArtikel.php';
            </script>
        ";
    else :
        setcookie('delete', 'failed', time() + 2);
        echo "
            <script>
                document.location.href = 'ListArtikel.php';
            </script>
        ";
    endif;
endif;
