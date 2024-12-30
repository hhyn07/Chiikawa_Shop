<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chiikawashop";
$id = $params[0];

// 資料庫查詢獲取 name 和 price
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = "";
$price = 0;
$image_path = "";

$sql = "SELECT * FROM `商品` WHERE `商品編號`=" . $id;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row) {
  $name = $row["商品名稱"];
  $price = $row["價格"];
  $image_path = $row["圖片路徑"];
  $inventory = $row["商品庫存"];
  $description = $row["商品描述"];
} else {
  echo "沒有這個產品";
  header("Location: /Chiikawa_Shop/404");
}
?>
<div class="container my-5">
  <div class="row align-items-start">
    <div class="col-md-6">
      <img src="<?php echo htmlspecialchars("/Chiikawa_Shop" . $image_path); ?>" alt="Product Image" class="img-fluid"
        style="width: 400px; height: auto;">
    </div>
    <div class="col-md-6">
      <h2 class="display-4 text-dark"><?php echo htmlspecialchars($name); ?></h2>
      <p class="text-danger">NT$<?php echo htmlspecialchars($price); ?></p>

      <!-- 使用 flex 排列，並將按鈕分配在左右兩邊 -->
      <div class="d-flex justify-content-between align-items-center" style="gap: 10px;">
        <!-- 加入購物車按鈕  -->
        <button type="button" class="btn btn-custom" id="add-to-cart-btn"
          style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
          加入購物車
        </button>
        <!-- 商品數量選取區域  -->
        <div class="d-flex align-items-center" style="gap: 10px;">
          <button type="button" class="btn btn-light btn-sm" id="decrease"
            style="background-color: #f992af; border: none; color: white;">−</button>
          <span id="quantity-display" class="fw-bold" style="font-size: 1.2rem;">1</span>
          <button type="button" class="btn btn-light btn-sm" id="increase"
            style="background-color: #f992af; border: none; color: white;">＋</button>
        </div>
      </div>

      <p class="text-danger">現庫存剩下 <?php echo htmlspecialchars($inventory); ?> 件</p>
      <p class="text-muted"><?php echo htmlspecialchars($description); ?></p>
      <p id="message" class="mt-3 text-muted"></p>
    </div>
  </div>
</div>

<script>
  let quantity = 1;
  const inventory = <?php echo htmlspecialchars($inventory); ?>;

  const decreaseBtn = document.getElementById('decrease');
  const increaseBtn = document.getElementById('increase');
  const quantityDisplay = document.getElementById('quantity-display');
  const addToCartBtn = document.getElementById('add-to-cart-btn');
  const message = document.getElementById('message');

  // 增加數量
  increaseBtn.addEventListener('click', function () {
    if (quantity < inventory) quantity += 1;
    quantityDisplay.textContent = quantity;
  });

  // 減少數量
  decreaseBtn.addEventListener('click', function () {
    if (quantity > 1) {
      quantity -= 1;
      quantityDisplay.textContent = quantity;
    }
  });

  // 加入購物車處理
  addToCartBtn.addEventListener('click', function () {
    message.textContent = "已加入購物車 " + quantity + " 件";
  });
</script>

<style>
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