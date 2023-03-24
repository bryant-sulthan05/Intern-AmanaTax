<?php
$created_at = date("Y-m-d H:i:s");
$LessonQuery = $config->query("SELECT * FROM lesson");

if (isset($_POST['add'])) :
    $LessonTitle = $_POST['title'];
    $slug = $_POST['slug'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $pict = $_FILES['pict']['name'];
    $pict_tmp = $_FILES['pict']['tmp_name'];
    $storage = '../public/uploaded_img/';
    $upload = move_uploaded_file($pict_tmp, $storage . $pict);

    $LessonAdd = $config->query("INSERT INTO lesson VALUES (NULL, '$LessonTitle', '$price', '$discount', '$pict', '$created_at', '$created_at')");
    $AddCategory = $config->query("INSERT INTO categories VALUES (NULL, '$LessonTitle', '$slug')");
    if ($LessonAdd == true) :
        // $_SESSION['lesson'] = 'success';
        setcookie('lesson', 'success', time() + 2);
        echo "
            <script>
                document.location.href = 'ListMateri.php';
            </script>
        ";
    else :
        $_SESSION['lesson'] = 'failed';
        echo "
            <script>
                document.location.href = 'ListMateri.php';
            </script>
        ";
    endif;
endif;
if (isset($_POST['edit'])) :
    $id = $_POST['lesson_id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $disc = $_POST['disc'];
    $pict = $_FILES['pict']['name'];
    $pict_tmp = $_FILES['pict']['tmp_name'];
    $storage = '../public/uploaded_img/';
    $upload = move_uploaded_file($pict_tmp, $storage . $pict);

    if ($_FILES['pict']['name'] == '') :
        $LessonUpdate = $config->query("UPDATE lesson SET lesson = '$title', price = '$price', discount = '$disc' WHERE lesson_id = '$id'");
    else :
        $LessonUpdate = $config->query("UPDATE lesson SET lesson = '$title', price = '$price', discount = '$disc', pict = '$pict' WHERE lesson_id = '$id'");
    endif;
    if ($LessonUpdate == true) :
        setcookie('edited', 'success', time() + 2);
        echo "
            <script>
                document.location.href = 'ListMateri.php';
            </script>
        ";
    else :
        setcookie('edited', 'failed', time() + 2);
        echo "
            <script>
                document.location.href = 'ListMateri.php';
            </script>
        ";
    endif;
endif;
