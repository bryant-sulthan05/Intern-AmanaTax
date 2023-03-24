<?php
$created_at = date("Y-m-d H:i:s");
$ApprovedTransaction = $config->query("SELECT transaction_id, firstname, lastname, lesson, transaction_proof, qty, expired_at, total, transaction.status FROM transaction JOIN user USING (user_id) JOIN lesson USING (lesson_id) JOIN payment USING (payment_id) WHERE transaction.status = 'approved'");
$PendingTransaction = $config->query("SELECT transaction_id, firstname, lastname, lesson, transaction_proof, qty, expired_at, total, transaction.status FROM transaction JOIN user USING (user_id) JOIN lesson USING (lesson_id) JOIN payment USING (payment_id) WHERE transaction_proof != '' && transaction.status = 'pending' || transaction.status = 'cancel'");
date_default_timezone_set("Asia/Jakarta");
$tgl = date("Y-m-d H:i:s");

if (isset($_POST['add'])) :
    $id = $_POST['transaction_id'];
    if (date('d') == 31 || (date('m') == 1 && date('d') > 28)) {
        $date = strtotime('last day of next month');
    } else {
        $date = strtotime('+6 months');
    }
    $due = date('Y-m-d', $date);

    $Confirm = $config->query("UPDATE transaction SET status = 'approved', expired_at = '$due', updated_at = '$tgl' WHERE transaction_id = '$id'");
    if ($Confirm == true) :
        setcookie('transaction', 'success', time() + 2);
        echo "
            <script>
                document.location.href = 'ListTransaksi.php';
            </script>
        ";
    else :
        $_SESSION['transaction'] = 'failed';
        echo "
            <script>
                document.location.href = 'ListTransaksi.php';
            </script>
        ";
    endif;
elseif (isset($_POST['edit'])) :
    if ($_POST['status'] == 'approved') :
        $EditStatus = $config->query("UPDATE transaction SET status = '$_POST[status]' WHERE transaction_id = '$_POST[id]'");
    elseif ($_POST['status'] == 'pending') :
        $EditStatus = $config->query("UPDATE transaction SET status = '$_POST[status]', expired_at = NULL, updated_at = '$tgl' WHERE transaction_id = '$_POST[id]'");
    elseif ($_POST['status'] == 'cancel') :
        $EditStatus = $config->query("UPDATE transaction SET status = '$_POST[status]', expired_at = NULL, updated_at = '$tgl' WHERE transaction_id = '$_POST[id]'");
    endif;
    if ($EditStatus == true) :
        setcookie('edit', 'success', time() + 2);
        echo "
            <script>
                document.location.href = 'ListTransaksi.php';
            </script>
        ";
    else :
        setcookie('edit', 'failed', time() + 2);
        echo "
            <script>
                document.location.href = 'ListTransaksi.php';
            </script>
        ";
    endif;
endif;
