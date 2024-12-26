<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chiikawashop";
$id = $params[0];

// 資料庫查詢獲取 name 和 price
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 商品名稱,價格 FROM 商品";
$echo = "";
$result = $conn->query($sql);

$name = "";
$price = 0;



?>
<!-- 到時候新增商品的時候，應該會多一個params的變數導到不同的商品 -->
<h1>product <?php echo $params[0]; ?></h1>