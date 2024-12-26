<?php
// 資料庫設定
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chiikawashop";

function db_connect()
{
  // 資料庫設定
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "chiikawashop";

  // 建立資料庫連線
  $conn = new mysqli($servername, $username, $password, $dbname);
  return $conn;
}
?>