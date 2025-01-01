<?php
session_start();
include_once("../includes/databases.php");
// 資料庫查詢獲取 name 和 price
// Create connection
$conn = db_connect();
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['shipping_method'])) {
        $id = $_SESSION['user_id'];
        $sql_1 = "SELECT * FROM `購物車` WHERE `會員編號`= $id";
        $result_1 = $conn->query($sql_1);
        $goods_name = "";
        $goods_num = "";
        $price = 0;
        while ($row = $result_1->fetch_assoc()) {
            $goods_id = $row["商品編號"];
            $sql_2 = "SELECT * FROM `商品` WHERE `商品編號`= $goods_id";
            $result_2 = $conn->query($sql_2);
            $row_2 = $result_2->fetch_assoc();
            $goods_name .= $row_2["商品名稱"] . "<br>";
            $goods_num .= $row["數量"] . "<br>";
            $price += $row["數量"] * $row["價格"];
        }
        $zipcode = $_POST['zipcode'];
        $shipping_method = $_POST['shipping_method'];
        $country = $_POST['country'];
        $address = $_POST['address'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $fee = $price * 0.1;
        $total = $price * 1.1;

        if ($result_1->num_rows > 0) {
            $stmt = $conn->prepare("INSERT INTO 訂單 (郵遞區號, 運費, 總價格, 運送方式, 運送國家, 運送地址, 顧客編號, 顧客姓名, 顧客電話, 顧客電郵, 商品名稱, 商品數量) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("siisssisssss", $zipcode, $fee, $total, $shipping_method, $country, $address, $id, $name, $phone, $email, $goods_name, $goods_num);
            if ($stmt->execute()) {
                // 刪除購物車中該用戶的資料
                $delete_sql = "DELETE FROM `購物車` WHERE `會員編號` = ?";
                $delete_stmt = $conn->prepare($delete_sql);
                $delete_stmt->bind_param("i", $id);

                if ($delete_stmt->execute()) {
                    $_SESSION['order_success'] = "訂單已成功送出，購物車已清空！";
                } else {
                    $_SESSION['order_fail'] = "訂單送出成功，但清空購物車時發生錯誤：" . htmlspecialchars($delete_stmt->error);
                }

                // 導向頁面
                header("Location: /Chiikawa_Shop/cart/$id");
                exit;
            } else {
                echo "<h3>Error inserting record: " . htmlspecialchars($stmt->error) . "</h3>";
            }
        } else {
            $_SESSION['order_fail'] = "購物車裡沒有商品";
            header("Location: /Chiikawa_Shop/cart/$id");
            exit;
        }
    }else{
        $_SESSION['order_fail'] = "沒有選擇運送方式";
        header("Location: /Chiikawa_Shop/cart/$id");
        exit;
    }
}
$conn->close();
?>
