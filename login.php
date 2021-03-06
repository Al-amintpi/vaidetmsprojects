<?php

    require_once("config.php");
    session_start();
    if(isset($_POST["login_submit"])){
        $user_mobile = $_POST['user_mobile'];
        $user_password = $_POST['user_password'];


        if (empty($user_password) OR empty($user_password)) {
            $error = "Mobile and Password is required";
        }
        else{
            $stm = $pdo->prepare("SELECT u_id,mobile,password FROM em_user WHERE mobile=?");
            $stm->execute(array($user_mobile));
            $userCount = $stm->rowCount();
            echo $userCount;
            $userData = $stm->fetchAll(PDO::FETCH_ASSOC);

            if ($userCount == 1) {
                $user_password = SHA1($user_password);
                $db_Password = $userData[0]['password'];
                $u_id = $userData[0]['u_id'];

                if ($user_password == $db_Password) {
                    $_SESSION['em_user'] = $userData;
                    header('location:index.php');

                    if(isset($_POST['remember'])){
                       $remember = $_POST['remember'];
                       if($remember == 1){
                        setcookie('rememberUser',$u_id,time()+3600,'/');
                       }
                       else{
                            setcookie('rememberUser',$u_id,time()-3600,'/');
                       }
                    }

                }
                else{
                    $error = "Mobile and password invalid";
                }
            }
            else{
                $error = "Mobile and password invalid";
            }
        }
    }
    if (isset($_SESSION["em_user"])) {
    header("location:index.php");
    }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ETMS - Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <?php if(isset($error)): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $error; ?>
                                        </div>
                                    <?php endif; ?>  

                                    <!-- Start LoginForm -->
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" name="user_mobile" class="form-control form-control-user" id="mobile" placeholder="Enter Mobile">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="user_password" class="form-control form-control-user" id="password" placeholder="Password">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" value="1" name="remember" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>

                                        <input type="submit" name="login_submit" class="btn btn-primary btn-user btn-block" value="Login">
                                         
                                    </form>
                                    <!-- End LoginForm -->
                                    
                                    <div class="text-center">
                                        <a class="small" href="forget_email.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>