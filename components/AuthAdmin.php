<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
$login_date =  date("Y-m-d H:i:s");

// Admins Login
if (isset($_COOKIE['login_admin']) && isset($_COOKIE['admin']) && isset($_COOKIE['pw']) && isset($_SESSION['admin'])) {
    echo "<script>
            alert('Anda Sudah Melakukan Login');
            document.location.href = 'dashboard.php';
        </script>";
}

if (isset($_POST['reg'])) :
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = hash('md5', $_POST['password']);
    $plaintext_password = $_POST['password'];
    $tlp = $_POST['tlp'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    // Cek Email
    $cekEmail = $config->query("SELECT email FROM admin WHERE email = '$email'");

    if (mysqli_num_rows($cekEmail) == 1) :
        $_SESSION['EmailError'] = 'gagal';
    else :
        if (strlen($plaintext_password) >= 8) :
            $Insert = $config->query("INSERT INTO admin VALUES (NULL, '$firstname', '$lastname', '$email', '$password', '$plaintext_password', '$tlp', '$address', '$gender', NULL)");
            if ($Insert == true) :
                $_SESSION['regAdmin'] = 'success';
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
            $_SESSION['min_pass'] = 'gagal';
        endif;
    endif;
elseif (isset($_POST['login'])) :
    $email = $_POST['email'];
    $password = hash('md5', $_POST['password']);
    $query = $config->query("SELECT * FROM admin WHERE email = '$email'");
    $row = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) == 1) {
        if ($password == $row['password']) {
            $_SESSION['admin'] = true;
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['firstnameAdmin'] = $row['firstname'];
            $_SESSION['lastnameAdmin'] = $row['lastname'];
            $_SESSION['emailAdmin'] = $row['email'];
            $_SESSION['LogAdmin'] = 'login';
            if (isset($_POST['remember'])) {
                setcookie("login_admin", $login_date, time() + 86400);
                setcookie("admin", hash('md5', $row['email']), time() + 86400);
                setcookie("pw", hash('md5', $row['password']), time() + 86400);
            }
            echo "<script>
                        document.location.href = 'dashboard.php';
                    </script>";
        } else {
            $_SESSION['LogError'] = 'gagal';
        }
    } else {
        $_SESSION['ErrorAcc'] = 'gagal';
    }
elseif (isset($_GET['admin'])) :
    unset($_SESSION['admin']);

    $_SESSION['logoutAdmin'] = 'logout';
    echo
    "<script>
        document.location.href = 'index.php';
    </script>";
endif;
