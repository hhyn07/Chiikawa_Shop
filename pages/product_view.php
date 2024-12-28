<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chiikawashop";
$id = $params[0];

// 資料庫查詢獲取 name 和 price
// Create connection
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
<!-- 到時候新增商品的時候，應該會多一個params的變數導到不同的商品 -->
<div class="container my-5">
  <div class="row align-items-start">
    <!-- 圖片區 -->
    <div class="col-md-6">
      <img src="<?php echo htmlspecialchars("/Chiikawa_Shop" . $image_path); ?>" alt="Product Image" class="img-fluid"
        style="width: 400px; height: auto;">
    </div>
    <!-- 文字區 -->
    <div class="col-md-6">
      <h2 class="display-4 text-dark"><?php echo htmlspecialchars($name); ?></h2>
      <p class="text-danger">NT$<?php echo htmlspecialchars($price); ?></p>
      <p class="text-danger">現庫存剩下 <?php echo htmlspecialchars($inventory); ?> 件</p>
      <p class="text-muted"><?php echo htmlspecialchars($description); ?></p>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>