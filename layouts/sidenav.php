<?php
$PendingTransactions = mysqli_num_rows($config->query("SELECT * FROM transaction WHERE transaction_proof != '' && status = 'pending' || status = 'cancel'"));
?>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    body {
        font-size: 1rem;
    }

    .feather {
        width: 16px;
        height: 16px;
    }

    /*
 * Sidebar
 */

    .sidebar {
        position: fixed;
        top: 0;
        /* rtl:raw:
  right: 0;
  */
        bottom: 0;
        /* rtl:remove */
        left: 0;
        z-index: 100;
        /* Behind the navbar */
        padding: 48px 0 0;
        /* Height of navbar */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    @media (max-width: 767.98px) {
        .sidebar {
            top: 5rem;
        }
    }

    .sidebar-sticky {
        height: calc(100vh - 48px);
        overflow-x: hidden;
        overflow-y: auto;
        /* Scrollable contents if viewport is shorter than content. */
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #333;
    }

    .sidebar .nav-link .feather {
        margin-right: 4px;
        color: #727272;
    }

    .sidebar .nav-link.active {
        color: #2470dc;
    }

    .sidebar .nav-link:hover .feather,
    .sidebar .nav-link.active .feather {
        color: inherit;
    }

    .sidebar-heading {
        font-size: .75rem;
    }

    /*
 * Navbar
 */

    .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar .navbar-toggler {
        top: .25rem;
        right: 1rem;
    }

    .navbar .form-control {
        padding: .75rem 1rem;
    }

    .form-control-dark {
        color: #fff;
        background-color: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .1);
    }

    .form-control-dark:focus {
        border-color: transparent;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
    }

    .dropdown:hover>.dropdown-menu {
        display: block;
    }

    .dropdown>.dropdown-toggle:active {
        pointer-events: none;
    }
</style>

<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" style="background-color: #1f2833;">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="dashboard.php"><img src="../public/img/nav-logo.png" width="128"></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <span class="form-control form-control-dark w-100 rounded-0 border-0 fw-bold">Selamat datang, <?= $_SESSION['firstnameAdmin'] ?></span>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="index.php?admin=<?= $_SESSION['admin_id'] ?>"><span class="bi bi-box-arrow-left">&nbsp;Sign out</span></a>
        </div>
    </div>
</header>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse mt-3">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= $title == 'Dashboard' ? 'active' : '' ?>" aria-current="page" href="dashboard.php">
                    <span class="bi bi-house-door">&nbsp;&nbsp;Dashboard</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?= $title == 'Daftar Materi' && 'Tambah Materi' && 'Edit Materi' ? 'active' : '' ?>" href="ListMateri.php">
                    <span class="bi bi-book-half">&nbsp;&nbsp;Daftar Materi</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?= $title == 'Daftar Video' && 'Tambah Video' && 'Edit Video' ? 'active' : '' ?>" href="ListVideo.php">
                    <span class="bi bi-camera-reels">&nbsp;&nbsp;Daftar Video</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?= $title == 'Daftar Artikel' && 'Tambah Artikel' && 'Edit Artikel' ? 'active' : '' ?>" href="ListArtikel.php">
                    <span class="bi bi-newspaper">&nbsp;&nbsp;Daftar Artikel</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?= $title == 'Daftar Transaksi' && 'Edit Transaksi' ? 'active' : '' ?>" href="ListTransaksi.php">
                    <div class="d-flex justify-content-between">
                        <span class="bi bi-receipt-cutoff">&nbsp;&nbsp;Daftar Transaksi</span>
                        <?php if ($PendingTransactions > 0) : ?>
                            <span class="fw-bold text-light text-center" style="background-color: #0002A1; text-decoration: none; width: 20px; border-radius: 8px;"><?= $PendingTransactions ?></span>
                        <?php endif; ?>
                    </div>
                </a>
            </li>
            <!-- <li class="nav-item fixed-bottom mb-3">
                <a class="nav-link" href="Profile.php">
                    <span class="bi bi-person-circle">&nbsp;&nbsp;Profile</span>
                </a>
            </li> -->
        </ul>
    </div>
</nav>