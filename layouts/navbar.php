<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['failed'] = 'failed';
    echo "
    <script>
        document.location.href = '../index.php'
    </script>
    ";
}

$UserQuery = $config->query("SELECT * FROM user WHERE user_id = '$_SESSION[user_id]'");
$s = mysqli_fetch_assoc($UserQuery);

if (isset($_GET['logout'])) :
    unset($_SESSION['user']);

    $_SESSION['logout'] = 'logout';
    echo
    "<script>
        document.location.href = '../index.php';
    </script>";
endif;
?>
<style>
    @media only screen and (min-width: 320px) {
        .navbar {
            background-color: #1b222c;
        }

        .navbar a {
            color: white;
        }

        .navbar-nav a:hover {
            color: #fff;
        }

        .navbar-nav .nav-link.active {
            color: #13cfac;
        }
    }

    @media only screen and (min-width: 992px) {
        .navbar {
            background-color: #1f2833;
        }

        .navbar a {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #fff;
            border-bottom: #13cfac solid;
        }

        .navbar-nav .nav-link.active {
            color: #fff;
            border-bottom: #13cfac solid;
            margin-right: 5px;
            margin-left: 5px;
        }

        .dropdown-item {
            color: #fff;
        }

        .dropdown-item:hover {
            background-color: #1f2833;
            color: #fff;
            border-bottom: #13cfac solid;
        }

        .navbar-nav .nav-item .dropdown-menu .dropdown-item.active {
            background-color: transparent;
            color: #fff;
            border-bottom: #13cfac solid;
        }
    }

    #logout {
        background-color: #13cfac;
        color: #fff;
    }

    #logout:hover {
        background-color: #1f2833;
        color: #13cfac;
        border: 2px #13cfac solid;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="../public/img/nav-logo.png" width="128"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto me-3">
                <a class="nav-link <?= $title == 'Home' ? 'active' : '' ?>" aria-current="page" href="index.php">Home</a>
                <a class="nav-link <?= $title == 'Artikel' ? 'active' : '' ?>" aria-current="page" href="ListArtikel.php">Artikel</a>
                <a class="nav-link <?= $title == 'Video Pembelajaran' ? 'active' : '' ?>" aria-current="page" href="ListVideo.php">Video Pembelajaran</a>
                <a class="nav-link <?= $title == 'Cart' ? 'active' : '' ?> mt-1 fw-bold" aria-current="page" href="cart.php"><span class="bi bi-cart"></span></a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../public/img/profile.svg" width="28">
                    </a>
                    <ul class="dropdown-menu" style="background-color: #1f2833; color: #fff;">
                        <li>
                            <a class="dropdown-item fs-6 <?= $title == 'Riwayat Transaksi' ? 'active' : '' ?>" href="ListTransaksi.php" class="btn fw-bold">Riwayat Transaksi</a>
                        </li>
                        <li>
                            <a class="dropdown-item fs-6" href="Profile.php" class="btn fw-bold">Profile</a>
                        </li>
                        <form action="" method="get">
                            <li>
                                <button type="submit" name="logout" id="logout" class="btn fw-bold ms-3 mt-2">Logout</button>
                            </li>
                        </form>
                    </ul>
                </li>
            </div>
        </div>
    </div>
</nav>