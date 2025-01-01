<?php
include_once("../includes/databases.php");

$conn = db_connect();
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['order_id'], $_POST['order_status'], $_POST['payment_status'])) {
        $order_id = $_POST['order_id'];
        $order_status = $_POST['order_status'];
        $payment_status = $_POST['payment_status'];

        // 使用預處理語句來更新訂單狀態
        $stmt = $conn->prepare("UPDATE `訂單` SET `訂單狀態` = ?, `付款狀態` = ? WHERE `訂單編號` = ?");
        $stmt->bind_param("ssi", $order_status, $payment_status, $order_id);
        if ($stmt->execute()) {
            $_SESSION['order_success'] = "訂單已更新成功";
            header("Location: /Chiikawa_Shop/order_view/" .$_SESSION['user_id']);
        } else {
            $_SESSION['order_fail'] = "訂單更新失敗";
            header("Location: /Chiikawa_Shop/order_view/" .$_SESSION['user_id']);
        }
    }
}
?>
