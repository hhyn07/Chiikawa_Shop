<style>
  * {
    font-family: 微軟正黑體;
  }

  body {
    background: #eee;
  }

  h5 {
    margin: 20px;
    color: #a3a2a3;
  }

  h5:hover {
    color: black;
  }


  #name,
  #password,
  #h1 {
    width: 200px;
    height: 20px;
    color: #df5334;
    top: 50px;
  }

  /*白色外框*/
  #frm {
    margin: 50px;
    padding: 10px;
    width: 230px;
    height: 300px;
    background-color: white;
    border-radius: 5px;
    border-top: 10px solid #a3a2a3;
    box-shadow: 0 0px 70px rgba(0, 0, 0, 0.1);

    /*定位對齊*/
    position: relative;
    margin: auto;
    top: 100px;
    text-align: center;
  }
  #btn {
    background: #cbd5e1;
    padding: 7px;
    text-align: center;
    width: 200px;
    height: 30px;
    margin: 10px;
  }

  .system_name {
    position: relative;
    margin: auto;
    top: 50px;
    text-align: center;
  }

  .submit {
    color: white;
    background: #df5334;
    width: 200px;
    height: 30px;
    margin: 10px;
    padding: 5px;
    border-radius: 5px;
    border: 0px;
  }

  .submit:hover {
    background: #cbd5e1;
  }

  #copyright {
    text-align: center;
    color: #a3a2a3;
    margin: -200px 0px 0px 0px;
    font-size: 14px;
  }

  input {
    padding: 5px;
    border: none;
    border: solid 1px #cbd5e1;
    border-radius: 5px;
  }
</style>
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

// 將用戶重定向到首頁或登錄頁
header("Location: /Chiikawa_Shop/");
exit;
?>
