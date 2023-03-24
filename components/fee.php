<?php
include '../components/config.php';

$payment_id = $_POST['payment_id'];

$query = $config->query("SELECT * FROM payment where payment_id = '$payment_id'");
$data = array();
while ($row = mysqli_fetch_array($query)) {
    $data['payment_method'] = $row['payment_method'];
    $data['fee'] = $row['fee'];
    $data['acc_number'] = $row['acc_number'];
}
echo json_encode($data);
