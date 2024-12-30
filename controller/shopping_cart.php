<?php
session_start();
include_once("../includes/databases.php");

$conn = db_connect();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 檢查是否是 POST 請求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $added_cart = $_POST['id'];
        $user_id = $_SESSION['user_id'];
        $quantity = $_POST['quantity'];

        // 檢查購物車是否已存在該商品
        $stmt_check = $conn->prepare("SELECT 數量 FROM 購物車 WHERE 商品編號 = ? AND 會員編號 = ?");
        $stmt_check->bind_param("ii", $added_cart, $user_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();

        if ($row_check) {
            $stmt_update = $conn->prepare("UPDATE `購物車` SET `數量` = `數量` + ? WHERE `商品編號` = ? AND `會員編號` = ?");
            $stmt_update->bind_param("iii", $quantity, $added_cart, $user_id);
            $stmt_update->execute();
        } else {
            $stmt = $conn->prepare("SELECT * FROM `商品` WHERE `商品編號` = ?");
            $stmt->bind_param("i", $added_cart);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                $price = $row["價格"];
                $image_path = $row["圖片路徑"];
                $stmt_insert = $conn->prepare("INSERT INTO 購物車 (商品編號, 圖片, 會員編號, 數量, 價格) VALUES (?, ?, ?, ?, ?)");
                $stmt_insert->bind_param("isiss", $added_cart, $image_path, $user_id, $quantity, $price);
                $stmt_insert->execute();
            }
        }

        // 設置加入購物車的訊息
        $_SESSION['cart_message'] = $quantity."件商品已成功加入購物車！";

        // 導回之前的商品頁面
        $referer = $_SERVER['HTTP_REFERER'] ?? '/Chiikawa_Shop';
        header("Location: $referer");
        exit();
    } else {
        echo "錯誤：未提供商品編號！";
    }
} else {
    echo "錯誤：請求方法無效！";
}
?>
