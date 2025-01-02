<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <!-- 左侧导航 -->
      <ul class="navbar-nav">
        <li class="nav-item h4">
            <a class="nav-link active" href="<?php echo $root;?>">精選推薦</a>
        </li>
        <li class="nav-item h4">
            <a class="nav-link active" href="<?php echo $root . 'product/list'; ?>">商品清單</a>
        </li>
      </ul>
      <!-- 右邊登入 -->
      <ul class="navbar-nav ms-auto">
        <?php
        if (isset($_SESSION['user_account']) && $_SESSION['permission'] == 0) {
          ?>
          <li class="navbar-text h4">歡迎會員：<?php echo $_SESSION['user_account']; ?></li>
          <li class="nav-item h4"><a class="nav-link active" href="<?php echo $root . "order_view/".$_SESSION['user_id']; ?>">我的訂單</a></li>                    
          <li class="nav-item h4"><a class="nav-link active" href="<?php echo $root . "cart/".$_SESSION['user_id']; ?>">購物車</a></li>                    
          <li class="nav-item h4"><a class="nav-link active" href="<?php echo $root . "logout"; ?>">登出</a></li>                    
        <?php }
        else if(isset($_SESSION['user_account']) && $_SESSION['permission'] == 1) {
          ?>
          <li class="navbar-text h4">歡迎管理員：<?php echo $_SESSION['user_account']; ?></li>
          <li class="nav-item h4"><a class="nav-link active" href="<?php echo $root . "order_view/".$_SESSION['user_id']; ?>">處理訂單</a></li>                                  
          <li class="nav-item h4"><a class="nav-link active" href="<?php echo $root . "add"?>">新增商品</a></li>
          <li class="nav-item h4"><a class="nav-link active" href="<?php echo $root . "logout"; ?>">登出</a></li>                    
        <?php }
        else{ ?>
          <li class="nav-item h4">
            <a class="nav-link active" href="<?php echo $root . "signup"; ?>">註冊</a>
          </li>
          <li class="nav-item h4">
            <a class="nav-link active" href="<?php echo $root . "login"; ?>">登入</a>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
