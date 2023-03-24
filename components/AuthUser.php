<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
$login_date =  date("Y-m-d H:i:s");

if (isset($_COOKIE['login_user']) || isset($_COOKIE['user']) || isset($_COOKIE['pw']) || isset($_SESSION['user'])) {
    echo "<script>
            alert('Anda Sudah Melakukan Login');
            document.location.href = 'user/index.php';
        </script>";
}

if (isset($_POST['reg'])) :
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = hash('md5', $_POST['password']);
    $plaintext_password = $_POST['password'];
    $tlp = $_POST['tlp'];
    $status = $_POST['status'];
    $gender = $_POST['gender'];

    // Cek Email
    $cekEmail = $config->query("SELECT email FROM user WHERE email = '$email'");

    if (mysqli_num_rows($cekEmail) == 1) :
        $_SESSION['email_error'] = 'gagal';
    else :
        if (strlen($plaintext_password) >= 8) :
            $Insert = $config->query("INSERT INTO user VALUES (NULL, '$firstname', '$lastname', '$email', '$password', '$plaintext_password', '$tlp', '$gender', '$status', NULL)");
            if ($Insert == true) :
                $_SESSION['regSuccess'] = 'success';
                echo "
                    <script>
                        document.location.href = 'index.php';
                    </script>
                    ";
            else :
                echo "
                <script>
                    document.location.href = 'index.php';
                </script>
                ";
            endif;
        else :
            $_SESSION['pass_min'] = 'gagal';
        endif;
    endif;
elseif (isset($_POST['login'])) :
    $email = $_POST['email'];
    $password = hash('md5', $_POST['password']);
    $query = $config->query("SELECT * FROM user WHERE email = '$email'");
    $row = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) == 1) {
        if ($password == $row['password']) {
            $_SESSION['user'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['login'] = 'login';
            if (isset($_POST['remember'])) {
                setcookie("login_user", $login_date, time() + 86400);
                setcookie("user", hash('md5', $row['email']), time() + 86400);
                setcookie("pw", hash('md5', $row['password']), time() + 86400);
            }
            echo "<script>
                        document.location.href = 'user/index.php';
                    </script>";
        } else {
            $_SESSION['pass_error'] = 'gagal';
        }
    } else {
        $_SESSION['acc_error'] = 'gagal';
    }
endif;
