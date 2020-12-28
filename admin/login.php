<?php

  require_once('../config.php');

  session_start();

  if(isset($_POST['admin_login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stm = $pdo->prepare("SELECT ad_id,username,password FROM em_admins WHERE username=?");
    $stm->execute(array($username));
    $nameCount = $stm->rowCount();
   

    if(empty($username)){
      $error = "Username is required";
    }
    else if(empty($password)){
      $error = "Password is required";
    }
    else if($nameCount !=1){
      $error = "Username and password Wrong";
    }
    else{
          $result = $stm->fetchAll(PDO::FETCH_ASSOC);
          $db_password = $result[0]["password"];
          echo $db_password;
          $user_password = SHA1($password);
          if($db_password == $user_password){
            $_SESSION['em_admin'] = $result;
            header("location:index.php");
          }
          else{
            $error = "Username and password Wrong";
          }

    }
  }

  if(isset($_SESSION['em_admin'])){
    header("location:index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>ETMS - Admin Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Admin-Login</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="" class="was-validated" novalidate="">
                  <?php if(isset($error)): ?>
                    <div class="alert alert-danger">
                      <?php echo $error; ?>
                    </div>
                  <?php endif; ?>  
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required>
                    <div class="invalid-feedback">
                      Please fill in your Username
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="forgot-password.php" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
<!--                   <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <button type="submit" name="admin_login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                 
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>