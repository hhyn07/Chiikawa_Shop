<?php
include_once('configs/routes.php');

$root = "/Chiikawa_Shop/";
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!str_starts_with($request, $root)) {
  http_response_code(404);
  echo '<h1>404 - 頁面不存在</h1>';
  exit;
}
$relativePath = trim(substr($request, strlen($root)), '/');

// 路由匹配函式（支援正則）
function matchRoute($relativePath, $routes)
{
  foreach ($routes as $pattern => $route) {
    if (preg_match("#^$pattern$#", $relativePath, $matches)) {
      return [
        'file' => $route['file'],
        'title' => $route['title'],
        'params' => array_slice($matches, 1)
      ];
    }
  }

  // 如果未匹配到任何路由，返回 404 路由並設置默認空參數
  return [
    'file' => $routes['404']['file'],
    'title' => $routes['404']['title'],
    'params' => []
  ];
}
?>
