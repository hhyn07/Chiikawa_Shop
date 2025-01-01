<?php
// 創建資料庫連接
$conn = db_connect();

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
  echo '<div class="container-sm my-5">';
  echo '<div class="row g-4 d-flex align-items-stretch">';

  // 逐個顯示商品
  while ($row = $result->fetch_assoc()) {
    // 每個商品的編號
    $id = $row['商品編號'];
    // 商品名稱、價格、圖片路徑
    $name = $row['商品名稱'];
    $price = $row['價格'];
    $image_path = $row['圖片路徑'];

    ?>
    <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
      <div class="card shadow-sm h-100 d-flex flex-column">
        <a href="<?php echo '/Chiikawa_Shop/product/view/' . htmlspecialchars($id); ?>">
          <div class="ratio ratio-4x3">
            <img class="card-img-top object-fit-cover" alt="商品圖片" src="<?php echo htmlspecialchars("/Chiikawa_Shop" . $image_path); ?>">
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-muted"><?php echo htmlspecialchars($name); ?></h5>
            <p class="card-text text-muted mb-2">NT$<?php echo number_format($price); ?></p>
            <a class="btn btn-custom mt-auto" href="/Chiikawa_Shop/product/view/<?php echo htmlspecialchars($id); ?>">查看商品</a>
          </div>
        </a>
      </div>
    </div>
    <?php
  }
  echo '</div>';
  echo '</div>';
} else {
  echo '<p>沒有商品可以顯示。</p>';
}

$conn->close();
?>

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