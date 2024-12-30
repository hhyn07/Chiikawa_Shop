<?php
include_once("includes/databases.php");

$conn = db_connect();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 定義變數
$nameErr = $passwordErr = $phoneErr = "";
$name = $password = $phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // 檢查 name 欄位
    if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $valid = false;
    } else {
    $name = test_input($_POST["name"]);
    }

    // 檢查 password 欄位
    if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
    $valid = false;
    } else {
    $password = test_input($_POST["password"]);
    }

    // 檢查 phone 欄位
    if (empty($_POST["phone"])) {
    $phoneErr = "Phone is required";
    $valid = false;
    } else {
    $phone = test_input($_POST["phone"]);
    }

    // 資料驗證通過，執行 SQL 操作
    if ($valid) {
        $stmt = $conn->prepare("SELECT * FROM 會員 WHERE 電話 = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['signup_error'] = "電話號碼已被註冊";
        } else {
            // 如果不存在，插入新資料
            $stmt = $conn->prepare("INSERT INTO 會員 (帳號, 電話, 密碼) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $phone, $password);
            if ($stmt->execute()) {
            echo "<h3>Registration successful! Welcome, " . htmlspecialchars($name) . "!</h3>";
            ?>
            <h5 onclick="show_hide()"><a href="http://localhost/Chiikawa_Shop/login">登入帳號</a></h5>
            <?php
            } else {
            echo "<h3>Error inserting record: " . htmlspecialchars($stmt->error) . "</h3>";
            }
        }
    }
    $stmt->close();
}


// 輔助函式
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$conn->close();
?>
