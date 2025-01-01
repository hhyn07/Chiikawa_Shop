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
if ($row) {
    $sql = "SELECT * FROM `購物車` JOIN `商品` WHERE `購物車`.`商品編號` = `商品`.`商品編號` AND `購物車`.`會員編號` = $id";
    $result = $conn->query($sql);
    if($result){   
?>
<div class="my-5 row d-flex align-items-stretch">
    <div class="col col-xl-8 mx-xl-auto mx-sm-3 mx-3">
        <div class="card shadow-sm">
            <div class="card-body">
        <?php
        $total = 0;
        $first = true;
        while ($row = $result->fetch_assoc()) {
                if(!$first)
                    echo "<hr>";
                $first = false;
        ?>
                <div class="d-flex">
                    <span class="my-auto mx-4"><?php echo $row["商品編號"];?></span>
                    <img class="object-fit-cover" style="max-height: 150px;" src="<?php echo htmlspecialchars("/Chiikawa_Shop" . $row["圖片"]); ?>" alt="">
                    <span class="my-auto">
                        商品名稱：<?php echo $row["商品名稱"]; ?><br>
                        商品數量：<?php echo $row["數量"]; ?><br>
                    </span>
                    <span class="ms-auto my-auto">項目金額：<?php echo $row["數量"] * $row["價格"]?></span>
                </div>
        <?php

            $total += $row["數量"] * $row["價格"];
        }
        ?>
            </div>
            <div class="card-footer d-flex">
                <span class="ms-auto h4">總價格：<?php echo $total;?></span>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-4 d-flex">
        <form class="mx-auto mb-4" id="order" action="/Chiikawa_Shop/order" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <button class="btn btn-custom" type="submit" id="myButton">結帳</button>
        </form>
    </div>
</div>
    <?php
    } else{
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