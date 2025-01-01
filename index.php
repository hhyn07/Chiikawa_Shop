<!-- 不用動 -->
<?php
session_start();
include_once('includes/databases.php');
include_once('includes/router.php');

// 執行路由匹配
$navbar = 'components/navbar.php';
$footer = 'components/footer.php';
?>
<!doctype html>
<html lang="zh-hant">

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