<?php
include_once("includes/databases.php");

$conn = db_connect();
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// 定義變數
$nameErr = $passwordErr = "";
$name = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $valid = true;

  // 驗證姓名
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $valid = false;
  } else {
    $name = test_input($_POST["name"]);
  }

  // 驗證密碼
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
    $valid = false;
  } else {
    $password = test_input($_POST["password"]);
  }

  // 如果所有欄位有效，檢查使用者是否存在
  if ($valid) {
    $stmt = $conn->prepare("SELECT * FROM 會員 WHERE 姓名 = ? AND 密碼 = ?");
    $stmt->bind_param("ss", $name, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      header("Location: /Chiikawa_Shop");
      exit; // 確保後續代碼不會被執行
    } else {
      $_SESSION['login_error'] = "帳號或密碼無效";
      header("Location: /Chiikawa_Shop/login");
      exit; // 確保後續代碼不會被執行
    }
  }
  $stmt->close();
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$conn->close();
