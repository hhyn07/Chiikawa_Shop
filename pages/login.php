<!DOCTYPE HTML>
<html>

<head>
  <title>PHP login System</title>
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
</head>

<body>
  <?php
  // 資料庫設定
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "mydb";

  // 建立資料庫連線
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // 定義變數
  $nameErr = $passwordErr = "";
  $name = $password = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // 驗證姓名
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
      $valid = false;
    } else {
      $name = test_input($_POST["name"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
        $valid = false;
      }
    }

    // 驗證密碼
    if (empty($_POST["password"])) {
      $passwordErr = "Password is required";
      $valid = false;
    } else {
      $password = test_input($_POST["password"]);
    }

    // 如果所有欄位有效，檢查使用者是否存在
    if ($valid) {
      $stmt = $conn->prepare("SELECT * FROM 會員 WHERE 姓名 = ? AND 密碼 = ?");
      $stmt->bind_param("ss", $name, $password);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        header("Location: http://localhost/Chiikawa_Shop/");
        exit(); // 確保後續代碼不會被執行
      } else {
        echo "<h3>Invalid name or password. Please try again.</h3>";
      }
      $stmt->close();
    }
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $conn->close();
  ?>

  <div class="system_name">
    <h1>Log In</h1>
  </div>

  <div class="login_page">

    <div id="frm">
      <div class="login">

        <form name="f1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validation()"
          method="POST">
          <p>
            <br>
            <input type="text" name="name" placeholder="Name" />
            <span class="error"><?php echo $nameErr; ?></span>
          </p>
          <p>
            <br>
            <input type="password" name="password" placeholder="Password" />
            <span class="error"><?php echo $passwordErr; ?></span>
          </p>
          <p>
            <input type="submit" id="btn" value="Sign Up" />
          </p>
        </form>
        <h5><a href="signup">尚未註冊</a></h5>
      </div>
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

      if (!/^[a-zA-Z-' ]*$/.test(name)) {
        alert("Invalid name format");
        return false;
      }

      if (!/^[0-9]*$/.test(phone)) {
        alert("Phone number must be numeric");
        return false;
      }

      return true;
    }
  </script>
</body>

</html>