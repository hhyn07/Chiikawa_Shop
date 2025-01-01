<?php
include_once("../includes/databases.php");

$conn = db_connect();
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// 檢查是否有表單資料提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取表單資料
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_stock = $_POST['product_stock'];
    $product_price = $_POST['product_price'];

// 定義目標目錄
$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Chiikawa_Shop/assets/images/";
$target_file = $target_dir . basename($_FILES["product_image"]["name"]);

// 嘗試移動檔案
if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
    $image_path = "/assets/images/" . basename($_FILES["product_image"]["name"]);
    echo "圖片上傳成功！";
} else {
    echo "上傳圖片時發生錯誤！";
    echo "錯誤詳細資訊：";
    echo "臨時檔案位置: " . $_FILES["product_image"]["tmp_name"] . "<br>";
    echo "目標檔案位置: " . $target_file . "<br>";
}


    // 插入資料庫
    $sql = "INSERT INTO `商品` (`商品名稱`, `商品描述`, `商品庫存`, `價格`, `會員編號`, `圖片路徑`) 
            VALUES ('$product_name', '$product_description', '$product_stock', '$product_price', 1, '$image_path')";
    
    if ($conn->query($sql) === TRUE) {
        echo "商品新增成功！";
        header("Location: /Chiikawa_Shop/product/list");
        exit();
    } else {
        echo "錯誤: " . $sql . "<br>" . $conn->error;
    }

    // 關閉資料庫連接
    $conn->close();
}
?>
