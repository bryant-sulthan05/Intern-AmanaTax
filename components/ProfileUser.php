<?php
if (isset($_POST['edit'])) :
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = hash('md5', $_POST['password']);
    $plain_text = $_POST['password'];
    $tlp = $_POST['tlp'];
    $status = $_POST['status'];
    $ProfilePict = $_FILES['pict']['name'];
    $source = $_FILES['pict']['tmp_name'];
    $ext = pathinfo($ProfilePict, PATHINFO_EXTENSION);
    if (!file_exists('../public/uploaded_img/' . $ProfilePict)) {
        move_uploaded_file($source, '../public/uploaded_img/' . $ProfilePict);
        $Pict = $ProfilePict;
    } else {
        $ProfilePict = str_replace('.', '-', basename($ProfilePict, $ext));
        $newfilename = $ProfilePict . time() . "." . $ext;
        move_uploaded_file($source, '../public/uploaded_img/' . $newfilename);
        $Pict = $newfilename;
    }
    if ($ProfilePict == '') :
        $UpdateProfile = $config->query("UPDATE user SET firstname = '$firstname', lastname = '$lastname', email = '$email', password = '$password', plaintext_pass = '$plain_text', tlp = '$tlp', status = '$status' WHERE user_id = '$_SESSION[user_id]'");
    else :
        $UpdateProfile = $config->query("UPDATE user SET firstname = '$firstname', lastname = '$lastname', email = '$email', password = '$password', plaintext_pass = '$plain_text', tlp = '$tlp', status = '$status', photo = '$Pict' WHERE user_id = '$_SESSION[user_id]'");
    endif;

    if ($UpdateProfile == true) :
        echo "
            <script>
                alert('Profile berhasil diubah');
                document.location.href = 'Profile.php';
            </script>
        ";
    else :
        $_SESSION['UpdateFailed'] = false;
        echo "
                <script>
                    document.location.href = 'Profile.php';
                </script>
            ";
    endif;
endif;
