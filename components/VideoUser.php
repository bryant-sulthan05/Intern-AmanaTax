<?php
date_default_timezone_set("Asia/Jakarta");
$tgl = date("Y-m-d H:i:s");
$date = date("Y-m-d");
$TransactionQuery = $config->query("SELECT * FROM transaction JOIN lesson USING (lesson_id) JOIN video USING (lesson_id) WHERE transaction.user_id = '$_SESSION[user_id]' AND transaction.status = 'approved'");
$Video = mysqli_fetch_all($TransactionQuery, MYSQLI_ASSOC);
$CekStatus = $config->query("SELECT * FROM user WHERE user_id NOT IN (SELECT user_id FROM transaction) AND user_id = '$_SESSION[user_id]'");
$cek = mysqli_fetch_assoc($CekStatus);
