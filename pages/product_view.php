<!-- 到時候新增商品的時候，應該會多一個params的變數導到不同的商品 -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chiikawashop";


$product = [
  [
    "id" => 0,
    "name" => "魔法少女烏薩奇",
    "price" => 540,
  ],
  [
    "id" => 1,
    "name" => "魔法少女小八",
    "price" => 540,
  ],
  [
    "id" => 3,
    "name" => "魔法少女吉伊",
    "price" => 540,
  ]
];

$id = $params[0];

// 資料庫查詢獲取 name 和 price
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 商品名稱,價格 FROM 商品";
$result = $conn->query($sql);

$name = "";
$price = 0;



?>
<h1>product <?php echo $params[0]; ?></h1>