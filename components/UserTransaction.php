<?php
date_default_timezone_set("Asia/Jakarta");
$tgl =  date("Y-m-d H:i:s");

$ListTransaction = $config->query("SELECT user_id, transaction_id, lesson_id, pict, lesson, transaction.created_at, transaction.updated_at, expired_at, transaction_proof, status, total FROM transaction JOIN lesson USING (lesson_id) WHERE user_id = '$_SESSION[user_id]' ORDER BY transaction.created_at DESC");
$CekTransaction = $config->query("SELECT * FROM transaction WHERE user_id = '$_SESSION[user_id]'");
$cek = mysqli_fetch_assoc($CekTransaction);

if (isset($_POST['post'])) :
    $file = $_FILES['proof']['name'];
    $source = $_FILES['proof']['tmp_name'];
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    if (!file_exists('../public/transaction_proof/' . $file)) {
        move_uploaded_file($source, '../public/transaction_proof/' . $file);
        $proof = $file;
    } else {
        $file = str_replace('.', '-', basename($file, $ext));
        $newfilename = $file . time() . "." . $ext;
        move_uploaded_file($source, '../public/transaction_proof/' . $newfilename);
        $proof = $newfilename;
    }

    $ProofUpload = $config->query("UPDATE transaction SET transaction_proof = '$proof' WHERE transaction_id = '$_POST[transaction_id]'");
    if ($ProofUpload == true) :
        $_SESSION['proof_update'] = true;
        echo "
            <script>
                document.location.href = 'ListTransaksi.php';
            </script>
        ";
    else :
        $_SESSION['proof_failed'] = 'failed';
        echo "
            <script>
                document.location.href = 'ListTransaksi.php';
            </script>
        ";
    endif;
endif;
