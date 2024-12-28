<?php
session_start(); // 啟動會話

// 清除所有的 Session 資料
$_SESSION = array();

// 如果需要清除 Session cookie，取消以下註解
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 銷毀會話
session_destroy();

// 將用戶重定向到首頁
header("Location: /Chiikawa_Shop/");
exit;
?>
