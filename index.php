<?php
$root = "/Chiikawa_Shop/";
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!str_starts_with($request, $root)) {
  http_response_code(404);
  echo '<h1>404 - 頁面不存在</h1>';
  exit;
}
$relativePath = trim(substr($request, strlen($root)), '/');

// 定義路由表（支援正則表達式）和標題
$routes = [
  '' => [
    'file' => 'pages/home.php',
    'title' => 'Chiikawa Shop｜Home'
  ],
  'login' => [
    'file' => 'pages/login.php',
    'title' => 'Chiikawa Shop｜Login'
  ],
  'product/list' => [
    'file' => 'pages/product_list.php',
    'title' => 'Chiikawa Shop｜Product List'
  ],
  'product/view/(\d+)' => [
    'file' => 'pages/product_view.php',
    'title' => 'Chiikawa Shop｜Product Details'
  ],

  '404' => [
    'file' => 'pages/404.php',
    'title' => 'Chiikawa Shop｜404 - 頁面不存在'
  ],
];

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
  return $routes['404'];
}

// 執行路由匹配
$navbar = 'components/navbar.php';
$footer = 'components/footer.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>吉伊卡哇商店</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php include $navbar; ?>

  <main>
    <?php
      $routeMatch = matchRoute($relativePath, $routes);
      $params = $routeMatch['params'];
      include $routeMatch['file'];
      $title = $routeMatch['title'];
    ?>
  </main>

  <?php include $footer; ?>

  <script>
    let title = "<?php echo addslashes($title); ?>";
    document.title = title;
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>