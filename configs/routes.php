<?php
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
  'logout' => [
    'file' => 'controller/logout.php',
    'title' => 'Chiikawa Shop｜Logout'
  ],
  'signup' => [
    'file' => 'pages/signup.php',
    'title' => 'Chiikawa Shop｜Signup'
  ],
  'cart/(\d+)' => [
    'file' => 'pages/shopping_cart.php',
    'title' => 'Chiikawa Shop｜Shopping Cart'
  ],
  'order/update' => [
    'file' => 'controller/order_update.php',
    'title' => 'Chiikawa Shop｜Order Update'
  ],
  'order/edit/(\d+)' => [
    'file' => 'pages/order_edit.php',
    'title' => 'Chiikawa Shop｜Order'
  ],
  'order_view/(\d+)' => [
    'file' => 'pages/order_view.php',
    'title' => 'Chiikawa Shop｜Order View'
  ],
  'order' => [
    'file' => 'pages/order.php',
    'title' => 'Chiikawa Shop｜Order'
  ],
  'product/list' => [
    'file' => 'pages/product_list.php',
    'title' => 'Chiikawa Shop｜Product List'
  ],
  'product/view/(\d+)' => [
    'file' => 'pages/product_view.php',
    'title' => 'Chiikawa Shop｜Product Details'
  ],
  's/login' => [
    'file' => 'controller/login.php',
    'title' => 'Chiikawa Shop｜login'
  ],
  's/signup' => [
    'file' => 'controller/signup.php',
    'title' => 'Chiikawa Shop｜signup'
  ],
  'add' => [
    'file' => 'pages/add_goods.php',
    'title' => 'Chiikawa Shop｜Add Goods'
  ],
  '404' => [
    'file' => 'pages/404.php',
    'title' => 'Chiikawa Shop｜404 - 頁面不存在'
  ],
];
?>
