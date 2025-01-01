<?php
if ($_SESSION['permission'] != 1) {
    header("Location: /Chiikawa_Shop/404"); // 若非管理員則重定向
    exit();
}
?>
<div class="form-container">
    <h2>新增商品</h2>
    <form action="/Chiikawa_Shop/controller/add_goods.php" method="POST" enctype="multipart/form-data">
        <label for="product_name">商品名稱:</label>
        <input type="text" id="product_name" name="product_name" required><br>

        <label for="product_description">商品描述:</label><br>
        <textarea id="product_description" name="product_description" rows="4" cols="50" required></textarea><br>

        <label for="product_stock">商品庫存:</label>
        <input type="number" id="product_stock" name="product_stock" required><br>

        <label for="product_price">價格:</label>
        <input type="number" id="product_price" name="product_price" required><br>

        <label for="product_image">商品圖片:</label>
        <input type="file" id="product_image" name="product_image" accept="image/*" required><br>

        <button type="submit">新增商品</button>
    </form>
</div>

<!-- 樣式 -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffe4e1;
        margin: 0;
        padding: 0;
    }
    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: auto;
        width: 50%;
        border-radius: 10px;
    }
    form {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }
    label {
        margin: 10px 0 5px;
        font-weight: bold;
    }
    input, textarea, button {
        width: 100%;
        margin-bottom: 15px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    button:hover {
        background-color: #45a049;
    }
    h2 {
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }
</style>
