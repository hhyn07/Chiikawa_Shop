<?php
$id = $params[0];

// 資料庫查詢獲取 name 和 price
// Create connection
$conn = db_connect();
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `訂單` WHERE `訂單編號`= $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row) {
    ?>
    <div class="edit-order-container">
        <h2>編輯訂單</h2>
        <form action="/Chiikawa_Shop/order/update" method="POST">
            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($row['訂單編號']); ?>">
            <div>
                <label for="order_status">訂單狀態:</label>
                <select name="order_status" id="order_status">
                    <option value="待處理" <?php echo ($row['訂單狀態'] == '待處理') ? 'selected' : ''; ?>>待處理</option>
                    <option value="已發貨" <?php echo ($row['訂單狀態'] == '已發貨') ? 'selected' : ''; ?>>已發貨</option>
                    <option value="已完成" <?php echo ($row['訂單狀態'] == '已完成') ? 'selected' : ''; ?>>已完成</option>
                </select>
            </div>
            <div>
                <label for="payment_status">付款狀態:</label>
                <select name="payment_status" id="payment_status">
                    <option value="未付款" <?php echo ($row['付款狀態'] == '未付款') ? 'selected' : ''; ?>>未付款</option>
                    <option value="已付款" <?php echo ($row['付款狀態'] == '已付款') ? 'selected' : ''; ?>>已付款</option>
                </select>
            </div>
            <button type="submit" class="btn btn-custom">更新訂單</button>
        </form>
    </div>
    <?php
} else {
    echo "訂單不存在";
}
?>

<style>
/* 美化並居中表單 */
.edit-order-container {
    display: flex;
    flex-direction: column;
    justify-content: center; /* 垂直居中 */
    align-items: center; /* 水平居中 */
    background-color: #f9f9f9;
}

h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.order-form {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px; /* 設定最大寬度 */
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-size: 18px;
    color: #333;
}

select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn-custom {
    padding: 12px 20px;
    font-size: 18px;
    background-color: #f99;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.btn-custom:hover {
    background-color: #e76f8d;
}

</style>