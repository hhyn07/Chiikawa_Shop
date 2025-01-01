<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chiikawashop";
// 資料庫查詢獲取 name 和 price
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['shipping_method'])) {
        $id = $_SESSION['user_id'];
        $sql = "SELECT * FROM `購物車` WHERE `會員編號`= $id";
        $result = $conn->query($sql);
        $price = 0;
        while ($row = $result->fetch_assoc()) {
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

        if ($result->num_rows > 0) {
            $stmt = $conn->prepare("INSERT INTO 訂單 (郵遞區號, 運費, 總價格, 運送方式, 運送國家, 運送地址, 顧客編號, 顧客姓名, 顧客電話, 顧客電郵) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("siisssisss", $zipcode, $fee, $total, $shipping_method, $country, $address, $id, $name, $phone, $email);

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
    }
}

?>
<style>
.table-container {
    display: flex;
    flex-direction: column; /* 垂直布局 */
    justify-content: flex-start; /* 内容从顶部开始 */
    align-items: center; /* 水平居中 */
    height: 100vh;
    padding-top: 20px;
}

table {
    margin: 0;
    border-collapse: collapse;
    font-size: 18px;
    table-layout: fixed;
    width: 70%; /* 设置表格宽度 */
    background-color: white;
}

table th {
    background-color: #f992af;
    color: white;
    font-weight: bold;
    text-align: center;
    padding: 12px 15px;
}

table td {
    padding: 12px 15px;
    border: 1px solid #f99;
    text-align: center;
    color: #333;
}

table tr {
    background-color: #ffe4e1;
}

form {
    margin-top: 20px; /* 按钮与表格的间距 */
}

.btn-custom {
    padding: 10px 20px;
    font-size: 18px;
    background-color: #f99;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-custom:hover {
    background-color: #e76f8d;
}

</style>