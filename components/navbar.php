<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <!-- 左侧导航 -->
      <ul class="navbar-nav">
        <li class="nav-item me-3">
            <h4><a class="nav-link active" href="<?php echo $root . 'product/list'; ?>">商品清單</a></h4>
        </li>
        <li class="nav-item me-3">
            <h4><a class="nav-link" href="#">Features</a></h4>
        </li>
        <li class="nav-item me-3">
            <h4><a class="nav-link" href="#">Pricing</a></h4>
        </li>
      </ul>
      <!-- 右邊登入 -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <h4><a class="nav-link active" href="<?php echo $root . 'signup'; ?>">註冊</a></h4>
        </li>
        <li class="nav-item">
            <h4><a class="nav-link active" href="<?php echo $root . 'login'; ?>">登入</a></h4>
        </li>
      </ul>
    </div>
  </div>
</nav>
