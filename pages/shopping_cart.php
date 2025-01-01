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
    $sql = "SELECT * FROM `購物車` WHERE `會員編號`= $id";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
    echo "<div class='table-container'>";
    echo "<table>";
    echo "<tr><th>商品</th><th>圖片</th><th>數量</th><th>價格</th></tr>";
    
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["商品編號"]. "</td><td>"; ?> 
        <img src="<?php echo htmlspecialchars("/Chiikawa_Shop" . $row["圖片"]); ?>" alt="Product Image" class="img-fluid"
        style="width: 200px; height: auto;">  
        <?php echo "</td><td>" . $row["數量"]. "</td><td>" . $row["數量"] * $row["價格"]. "</td></tr>";
    }
    echo "</table>";
    ?>
    <form id="order" action="/Chiikawa_Shop/order" method="POST" style="margin-top: 20px;">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <button type="submit" id="myButton" class="btn btn-custom">結帳</button>
    </form>
    </div>
    <?php
    }
    else{
        echo "<h2>購物車中沒有商品</h2><br>";
        echo "<h2><a href='http://localhost/Chiikawa_Shop/product/list'>去購物</a></h2>";
    }
} else {
    echo "會員編號不存在";
    header("Location: /Chiikawa_Shop/404");
}
?>
<style>
.table-container {
    display: flex;
    flex-direction: column; /* 垂直布局 */
    justify-content: flex-start; /* 内容从顶部开始 */
    align-items: center; /* 水平居中 */
    padding-top: 20px;
}
h2 {
    text-align: center;
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
<?php
if (isset($_SESSION['order_success'])) {
  echo '<div class="alert alert-success" role="alert">'
    . htmlspecialchars($_SESSION['order_success']) .
    '</div>';
  unset($_SESSION['order_success']);
}
if (isset($_SESSION['order_fail'])) {
  echo '<div class="alert alert-success" role="alert">'
    . htmlspecialchars($_SESSION['order_fail']) .
    '</div>';
  unset($_SESSION['order_fail']);
}
?>