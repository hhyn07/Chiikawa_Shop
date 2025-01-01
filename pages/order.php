
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chiikawashop";

// 資料庫查詢獲取 name 和 price
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "SELECT * FROM `會員` WHERE `會員編號`= $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($row) {
            echo "<div class='table-container'>";
            echo "<h1>您訂購的商品</h1>";
            echo "<table>";
            echo "<tr><th>商品</th><th>圖片</th><th>數量</th><th>價格</th></tr>";
            $sql = "SELECT * FROM `購物車` WHERE `會員編號`= $id";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["商品編號"]. "</td><td>"; ?> 
                <img src="<?php echo htmlspecialchars("/Chiikawa_Shop" . $row["圖片"]); ?>" alt="Product Image" class="img-fluid"
                style="width: 100px; height: auto;">  
                <?php echo "</td><td>" . $row["數量"]. "</td><td>" . $row["數量"] * $row["價格"]. "</td></tr>";
            }
            echo "</table>";
            echo "總價格計算方式：運費=商品價格*10% + 商品價格";
            echo "<br>表格內價格即為商品價格";
        }
    }
}
?>
    <div class="form-container">
        <h2>訂單資訊</h2>
        <form action="/Chiikawa_Shop/controller/order.php" method="POST">
            <table>
                <tr>
                    <td>郵遞區號</td>
                    <td><input type="text" name="zipcode" required></td>
                </tr>
                <tr>
                    <td>運送方式</td>
                    <td>
                        <select name="shipping_method" required>
                            <option value="">選擇運送方式</option>
                            <option value="standard">標準運送</option>
                            <option value="express">快速運送</option>
                            <option value="same-day">當日送達</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>運送國家</td>
                    <td><input type="text" name="country" required></td>
                </tr>
                <tr>
                    <td>運送地址</td>
                    <td><input type="text" name="address" required></td>
                </tr>
                <tr>
                    <td>顧客姓名</td>
                    <td><input type="text" name="name" required></td>
                </tr>
                <tr>
                    <td>顧客電話</td>
                    <td><input type="tel" name="phone" required></td>
                </tr>
                <tr>
                    <td>顧客電郵</td>
                    <td><input type="email" name="email" required></td>
                </tr>
            </table>
            <button type="submit" id="myButton" class="btn btn-custom">確定送出</button>
        </form>
    </div>

<style>
.table-container,
.form-container {
    display: flex;
    flex-direction: column; /* 垂直布局 */
    justify-content: flex-start; /* 从顶部对齐内容 */
    align-items: center; /* 水平居中 */
    width: 100%; /* 确保父容器占满屏幕宽度 */
    padding-top: 20px; /* 顶部间距 */
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
    width: 50%; /* 保持与表格一致的宽度 */
    margin: 0 auto; /* 水平居中 */
    padding: 10px;
    border-radius: 5px; /* 圆角样式 */
    text-align: center; /* 确保内部元素居中，包括按钮 */
}

form table {
    width: 100%; /* 表单表格的宽度与父容器一致 */
}

.btn-custom {
    display: inline-block; /* 按钮保持块状并适配居中 */
    margin-top: 10px; /* 与表单内容分隔 */
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
