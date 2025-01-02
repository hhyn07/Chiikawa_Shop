<?php
$id = $params[0];

// 資料庫查詢獲取 name 和 price
// Create connection
$conn = db_connect();
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = "";
$price = 0;
$image_path = "";

$sql = "SELECT * FROM `會員` WHERE `會員編號`= $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($_SESSION['permission']==0){
    if ($row) {
        $sql = "SELECT * FROM `訂單` WHERE `顧客編號`= $id";
        $result = $conn->query($sql);
        ?>
        <div class="container-sm my-5">
            <div class="row  g-4">
        <?php
        if($row){
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col col-sm-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex">
                            <span>訂單編號：</span>
                            <span class="ms-auto">訂單狀態：<?php echo $row["訂單狀態"];?></span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <!-- <div class="ratio ratio-1x1">
                                    <img src="" alt="">
                                </div> -->
                                <span>
                                    商品名稱：<br><?php echo $row["商品名稱"]; ?><br>
                                    商品數量：<br><?php echo $row["商品數量"]; ?><br>
                                </span>
                                <span class="ms-auto my-auto">項目金額：<?php echo $row["總價格"]-$row["運費"];?></span>
                            </div>
                            <!-- <hr> -->
                        </div>
                        <div class="card-footer d-flex">
                            <span>訂購時間：<?php echo $row["下單日期"];?></span>
                            <span class="ms-auto">總價格：<?php echo $row["總價格"];?></span>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
                </div>
            </div>
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
}
if($_SESSION['permission']==1){
    $sql = "SELECT * FROM `訂單`";
    $result = $conn->query($sql);
    if($row){
    echo "<div class='table-container'>";
    echo "<table>";
    echo "<tr><th>總價格</th><th>商品名稱</th><th>商品數量</th><th>訂單狀態</th><th>付款狀態</th><th>下單日期</th><th>編輯訂單</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["總價格"] . "</td>";
        echo "<td>" . $row["商品名稱"] . "</td>";
        echo "<td>" . $row["商品數量"] . "</td>";
        echo "<td>" . $row["訂單狀態"] . "</td>";
        echo "<td>" . $row["付款狀態"] . "</td>";
        echo "<td>" . $row["下單日期"] . "</td>";
        echo "<td><a href='/Chiikawa_Shop/order/edit/" . $row['訂單編號'] . "' class='btn btn-custom'>編輯</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    }    
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
    width: 80%; /* 设置表格宽度 */
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