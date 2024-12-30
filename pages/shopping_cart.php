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

$sql = "SELECT * FROM `會員` WHERE `會員編號`= $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row) {
    echo "<table>";
    echo "<tr><th>商品</th><th>圖片</th><th>數量</th><th>價格</th></tr>";
    $sql = "SELECT * FROM `購物車` WHERE `會員編號`= $id";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        echo "<tr><td>" . $row["商品編號"]. "</td><td>"; ?> <img src="<?php echo htmlspecialchars("/Chiikawa_Shop" . $row["圖片"]); ?>" alt="Product Image" class="img-fluid"
        style="width: 200px; height: auto;">  <?php echo "</td><td>" . $row["數量"]. "</td><td>" . $row["數量"]*$row["價格"]. "</td></tr>";
    }
    echo "</table>";
} else {
  echo "會員編號不存在";
  header("Location: /Chiikawa_Shop/404");
}
?>
  <style>
    /* 讓表格容器使用彈性盒模型，並水平垂直置中 */


    /* 表格樣式 */
    table {
    display: flex;
      flex-direction: column; /* 垂直方向排列，讓標題在表格上方 */
      height: 50vh; /* 設定頁面高度，使其能夠垂直置中 */
      margin: 0;
      border-collapse: collapse;
      font-size: 18px;
      table-layout: fixed; /* 平分欄寬 */
      background-color: #f7f7f7; /* 表格背景顏色 */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 添加陰影 */
    }

    /* 表頭樣式 */
    table th {
      background-color: #f992af;
      color: white; /* 表頭文字顏色 */
      font-weight: bold;
      text-align: center; /* 水平置中 */
      padding: 12px 15px;
    }

    /* 表格內容樣式 */
    table td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: center; /* 水平置中 */
      color: #333; /* 深色文字 */
    }

    /* 偶數行背景色 */
    table tr:nth-child(even) {
      background-color: #F3C623; /* 淡藍色 */
    }

    /* 表格行滑過效果 */
    table tr:hover {
      background-color: #e0e0e0; /* 灰色滑過效果 */
    }

    /* 表格標題字體大小 */
    table th, table td {
      font-family: Arial, sans-serif;
    }
  </style>