<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chiikawashop";

// 創建資料庫連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// 查詢所有商品
$sql = "SELECT `商品編號`, `商品名稱`, `價格`, `圖片路徑` FROM `商品`";
$result = $conn->query($sql);

// 如果有商品資料，則顯示
if ($result->num_rows > 0) {
  // 開始顯示商品清單
  echo '<div class="container my-5">';
  echo '<div class="row">';

  // 逐個顯示商品
  while ($row = $result->fetch_assoc()) {
    // 每個商品的編號
    $id = $row['商品編號'];
    // 商品名稱、價格、圖片路徑
    $name = $row['商品名稱'];
    $price = $row['價格'];
    $image_path = $row['圖片路徑'];

    // 顯示商品的 card
    echo '<div class="col-md-4 mb-4">';
    echo '<div class="card" style="width: 18rem;">';
    echo '<a href="/Chiikawa_Shop/product/view/' . htmlspecialchars($id) . '">';
    echo '<img src="' . htmlspecialchars("/Chiikawa_Shop" . $image_path) . '" class="card-img-top " alt="商品圖片">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title text-muted">' . htmlspecialchars($name) . '</h5>';
    echo '<p class="card-text text-muted">NT$' . number_format($price) . '</p>';
    echo '<a href="/Chiikawa_Shop/product/view/' . htmlspecialchars($id) . '" class="btn btn-custom">查看商品</a>';
    echo '</div>';
    echo '</a>';
    echo '</div>';
    echo '</div>';
  }

  echo '</div>';
  echo '</div>';
} else {
  echo '<p>沒有商品可以顯示。</p>';
}

$conn->close();
?>
</script>

<style>
  /* 字體樣式 */
  .card-title,
  .card-text,
  .card-body a {
    text-decoration: none !important;
    /* 移除底線 */
  }





  /* 按鈕樣式 */
  .btn-custom {
    background-color: #f992af;
    /* 自訂背景顏色 */
    border-color: #f992af;
    /* 自訂邊框顏色 */
    color: white;
    /* 文字顏色 */
  }

  .btn-custom:hover {
    background-color: #f6b4c7;
    /* 滑鼠懸停時的背景顏色 */
    border-color: #f6b4c7;
    /* 滑鼠懸停時的邊框顏色 */
    color: white;
  }

  .btn-custom:active {
    background-color: #f992af !important;
    /* 保持按鈕背景顏色不變 */
    border-color: #f992af !important;
    /* 保持按鈕邊框顏色不變 */
    color: white !important;
    /* 保持文字顏色不變 */
    box-shadow: none !important;
    /* 禁用焦點效果 */
  }

  .btn-custom:focus {
    background-color: #f992af !important;
    /* 保持按鈕背景顏色不變 */
    border-color: #f992af !important;
    /* 保持按鈕邊框顏色不變 */
    color: white !important;
    /* 保持文字顏色不變 */
    box-shadow: none !important;
    /* 禁用焦點效果 */
  }
</style>