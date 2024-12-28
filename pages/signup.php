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
  #phone,
  #h1 {
    width: 200px;
    height: 20px;
    color: #black;
    top: 50px;
  }

  #frm2 {
    margin: 50px;
    padding: 10px;
    width: 230px;
    height: 350px;
    background-color: white;
    border-radius: 5px;
    border-top: 10px solid #a3a2a3;
    box-shadow: 0 0px 70px rgba(0, 0, 0, 0.1);

    /*定位對齊*/
    position: relative;
    margin: auto;
    top: 50px;
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

<div class="system_name">
  <h1>Sign Up</h1>
</div>

<div class="signup_page">

  <div id="frm2">
    <div class="signup">

      <form name="f1" action="/Chiikawa_Shop/s/signup" onsubmit="return validation()"
        method="POST">
        <p>
          <input type="text" id="name" name="name" placeholder="Account" />
          <!-- <span class="error"><?php echo $nameErr; ?></span> -->
        </p>
        <p>
          <input type="password" id="password" name="password" placeholder="Password" />
          <!-- <span class="error"><?php echo $passwordErr; ?></span> -->
        </p>
        <p>
          <input type="text" id="phone" name="phone" placeholder="Phone Number" />
          <!-- <span class="error"><?php echo $phoneErr; ?></span> -->
        </p>
        <span class="error" style="color: red;">
          <?php
          if (isset($_SESSION['signup_error'])) {
            echo "<p class='error'>" . htmlspecialchars($_SESSION['signup_error']) . "</p>";
            unset($_SESSION['signup_error']); // 清除錯誤訊息
          }
          ?>
        </span>
        <p>
          <input type="submit" id="btn" value="Sign Up" />
        </p>
      </form>
      <h5 onclick="show_hide()"><a href="http://localhost/Chiikawa_Shop/login">登入帳號</a></h5>

    </div>
  </div>
</div>


<script>
  function validation() {
    var name = document.f1.name.value;
    var password = document.f1.password.value;
    var phone = document.f1.phone.value;

    if (name == "" || password == "" || phone == "") {
      alert("All fields are required!");
      return false;
    }

    if (!/^[a-zA-Z0-9-' ]*$/.test(name)) {
      alert("Invalid account format");
      return false;
    }

    if (!/^[0-9]*$/.test(phone)) {
      alert("Phone number must be numeric");
      return false;
    }

    return true;
  }
</script>