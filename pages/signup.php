<!DOCTYPE HTML>
<html>

<head>
  <title>PHP signup System</title>
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
</head>

<body>
  <?php
  // 資料庫設定
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "chiikawashop";

  // 建立資料庫連線
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // 定義變數
  $nameErr = $passwordErr = $phoneErr = "";
  $name = $password = $phone = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // 檢查 name 欄位
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

    // 檢查 password 欄位
    if (empty($_POST["password"])) {
      $passwordErr = "Password is required";
      $valid = false;
    } else {
      $password = test_input($_POST["password"]);
    }

    // 檢查 phone 欄位
    if (empty($_POST["phone"])) {
      $phoneErr = "Phone is required";
      $valid = false;
    } else {
      $phone = test_input($_POST["phone"]);
      if (!preg_match("/^[0-9]*$/", $phone)) {
        $phoneErr = "Only numbers allowed";
        $valid = false;
      }
    }

    // 資料驗證通過，執行 SQL 操作
    if ($valid) {
      $stmt = $conn->prepare("SELECT * FROM 會員 WHERE 電話 = ?");
      $stmt->bind_param("s", $phone);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        $phoneErr = "This phone number is already registered.";
      } else {
        // 如果不存在，插入新資料
        $stmt = $conn->prepare("INSERT INTO 會員 (帳號, 電話, 密碼) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $phone, $password);
        if ($stmt->execute()) {
          echo "<h3>Registration successful! Welcome, " . htmlspecialchars($name) . "!</h3>";
        } else {
          echo "<h3>Error inserting record: " . htmlspecialchars($stmt->error) . "</h3>";
        }
      }
      $stmt->close();
    }
  }

  // 輔助函式
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
    <h1>Sign Up</h1>
  </div>

  <div class="signup_page">

    <div id="frm2">
      <div class="signup">

        <form name="f1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validation()"
          method="POST">
          <p>
            <input type="text" id="name" name="name" placeholder="Name" />
            <span class="error"><?php echo $nameErr; ?></span>
          </p>
          <p>
            <input type="password" id="password" name="password" placeholder="Password" />
            <span class="error"><?php echo $passwordErr; ?></span>
          </p>
          <p>
            <input type="text" id="phone" name="phone" placeholder="Phone Number" />
            <span class="error"><?php echo $phoneErr; ?></span>
          </p>
          <p>
            <input type="submit" id="btn" value="Sign Up" />
          </p>
        </form>
        <h5 onclick="show_hide()"><a href="http://localhost/Chiikawa_Shop/login">登入帳號</a></h5>

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