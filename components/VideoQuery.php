<?php
$date = date("Y-m-d H:i:s");
$VideoQuery = $config->query("SELECT * FROM video JOIN lesson USING (lesson_id)");
$Lesson = $config->query("SELECT * FROM lesson");
$id = 0;
$LessonTitle = '';

if (isset($_POST['add'])) :
    $category = $_POST['category'];
    $title = $_POST['title'];
    $thumbnail = $_FILES['pict']['name'];
    $source = $_FILES['pict']['tmp_name'];
    $video = $_FILES['video']['name'];
    $source_video = $_FILES['video']['tmp_name'];
    $ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
    $extVideo = pathinfo($video, PATHINFO_EXTENSION);
    if (!file_exists('../public/uploaded_img/' . $thumbnail)) {
        move_uploaded_file($source, '../public/uploaded_img/' . $thumbnail);
        $img = $thumbnail;
    } else {
        $thumbnail = str_replace('.', '-', basename($thumbnail, $ext));
        $newfilename = $thumbnail . time() . "." . $ext;
        move_uploaded_file($source, '../public/uploaded_img/' . $newfilename);
        $img = $newfilename;
    }
    if (!file_exists('../public/uploaded_video/' . $video)) {
        move_uploaded_file($source_video, '../public/uploaded_video/' . $video);
        $vd = $video;
    } else {
        $video = str_replace('.', '-', basename($video, $extVideo));
        $newVideo = $video . time() . "." . $extVideo;
        move_uploaded_file($source_video, '../public/uploaded_video/' . $newVideo);
        $vd = $newVideo;
    }

    $AddVideo = $config->query("INSERT INTO video VALUES (NULL, '$category', '$title', '$vd', '$img', '$date', '$date')");
    if ($AddVideo == true) :
        // $_SESSION['lesson'] = 'success';
        setcookie('video', 'success', time() + 2);
        echo "
            <script>
                document.location.href = 'ListVideo.php';
            </script>
        ";
    else :
        $_SESSION['video'] = 'failed';
        echo "
            <script>
                document.location.href = 'ListVideo.php';
            </script>
        ";
    endif;
elseif (isset($_POST['edit'])) :
    $category = $_POST['category'];
    $title = $_POST['title'];
    $thumbnail = $_FILES['pict']['name'];
    $source = $_FILES['pict']['tmp_name'];
    $video = $_FILES['video']['name'];
    $source_video = $_FILES['video']['tmp_name'];
    $ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
    $extVideo = pathinfo($video, PATHINFO_EXTENSION);
    if (!file_exists('../public/uploaded_img/' . $thumbnail)) {
        move_uploaded_file($source, '../public/uploaded_img/' . $thumbnail);
        $img = $thumbnail;
    } else {
        $thumbnail = str_replace('.', '-', basename($thumbnail, $ext));
        $newfilename = $thumbnail . time() . "." . $ext;
        move_uploaded_file($source, '../public/uploaded_img/' . $newfilename);
        $img = $newfilename;
    }
    if (!file_exists('../public/uploaded_video/' . $video)) {
        move_uploaded_file($source_video, '../public/uploaded_video/' . $video);
        $vd = $video;
    } else {
        $video = str_replace('.', '-', basename($video, $extVideo));
        $newVideo = $video . time() . "." . $extVideo;
        move_uploaded_file($source_video, '../public/uploaded_video/' . $newVideo);
        $vd = $newVideo;
    }

    if ($thumbnail == '') :
        $UpdateVideo = $config->query("UPDATE video SET lesson_id = '$category', title = '$title', video = '$vd', updated_at = '$date' WHERE video_id = '$_POST[video_id]'");
    elseif ($video == '') :
        $UpdateVideo = $config->query("UPDATE video SET lesson_id = '$category', title = '$title', thumbnail = '$img', updated_at = '$date' WHERE video_id = '$_POST[video_id]'");
    else :
        $UpdateVideo = $config->query("UPDATE video SET lesson_id = '$category', title = '$title', video = '$vd', thumbnail = '$img', updated_at = '$date' WHERE video_id = '$_POST[video_id]'");
    endif;

    if ($UpdateVideo == true) :
        // $_SESSION['lesson'] = 'success';
        setcookie('edited', 'success', time() + 2);
        echo "
            <script>
                document.location.href = 'ListVideo.php';
            </script>
        ";
    else :
        $_SESSION['edited'] = 'failed';
        echo "
            <script>
                document.location.href = 'ListVideo.php';
            </script>
        ";
    endif;
elseif (isset($_GET['delete'])) :
    $DeleteVideo = $config->query("DELETE FROM video WHERE video_id = '$_GET[video_id]'");
    if ($DeleteVideo == true) :
        // setcookie('deleted', 'success', time() + 2);
        echo "
            <script>
                alert('Video Berhasil Dihapus');
                document.location.href = 'ListVideo.php';
            </script>
        ";
    else :
        // $_SESSION['deleted'] = 'failed';
        echo "
            <script>
                document.location.href = 'ListVideo.php';
            </script>
        ";
    endif;
endif;
