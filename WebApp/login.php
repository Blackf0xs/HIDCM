<?  session_start(); ob_start(); error_reporting(0); ?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Hajj ID - Login</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesdesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

    </head>


    <body>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mt-0 m-b-15">
                        <a href="index.php" class="logo logo-admin"><img src="assets/images/7.png" height="60" alt="logo"></a>
                    </h3>

                    <h4 class="text-muted text-center font-18"><b>Sign In</b></h4>

                    <div class="p-3">
                        <form class="form-horizontal m-t-20" method="POST">

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="user" type="text" required="" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" name="pass" type="password" required="" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember me</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <input name="login" type="submit" class="btn btn-primary" value="log in">
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-sm-7 m-t-20">
                                    <a href="?reset=pwd" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                </div>
                            </div>
                        </form>
                    </div>


<?php
    session_start();
    ob_start();
    error_reporting(0);

    include('inc/cfg.php');
    include('inc/func.php');

    
    if(isset($_GET['reset']) == 'pwd') {
        print '<form method="POST">
                <center>
                    <br><br>
                    <h3>Enter Your Email Address</h3>
                    <input type="email" name="email" placeholder="youremail@example.com">
                    <input type="submit" name="recover" value="Recover">
                </center>
            </form>';
        if(isset($_POST['recover'])) {
            $email = $con->prepare("SELECT * FROM `bfsCP` WHERE `email`=:b0x");
            $email->bindParam(":b0x", $_POST['email']); # try to inject me darling ;(
            $email->execute();
            $count = $email->RowCount();
            if($count > 0) {
                
                $token = token(1); # option 1 mean encrypt it to MD5 check inc/func.php =) 
                # sender(); // u need to add mail and letter at [ inc/func.php ] 
                
                $update = $con->prepare("UPDATE `bfsCP` SET `token`='{$token}' WHERE `email` = :email;");
                $update->bindParam(":email", $_POST['email']);
                $update->execute();
                if($update) {
                    print 'We Send Link At Your Email Adrress Please Check Your Email To Continue.';
                } else {
                    print 'Error We Cannot Recover Your Password Please Contact The Support Maybe Mail() is Disabled .';
                }
            } else {
                print 'Error , The e-mail not found in database ..';
            }
        }
    } else {
?>

<?php 
    }

    $uid = $_POST['user'];
    $pwd = $_POST['pass'];
    $captcha = $_POST['g-recaptcha-response'];

    $good = "Login Complete"; # true  login
    $error = "Please Check Your Username/Password"; # false Login
    //header("Location: ?log=1");

    if(isset($_POST['login'])) {
        
            # mysql command using php PDO ->
            $sql = $con->prepare("SELECT * FROM `bfsCP` WHERE username=:user");
            # bind paramater , :user for security
            $sql->bindParam(":user", $uid);
            # and execute the command
            $sql->execute();
            # for loop ( foreach() )
            foreach($sql as $login) {
                # stripslashes login for secure
                $username = stripslashes($login['username']);
                $password = stripslashes($login['password']);
            }
            # then check username POST == username in database and passwords the same thing
            if($uid == $username and md5($pwd) == $password) {
                # if true, then start session with login and go to dashboard file ;)
                $_SESSION['bfslogin'] = $username;
                $_SESSION['bfspassw'] = $password;
                # print good msg check ( 21 LINE )
                echo $good;
                # here moving to dashboard file using header function
                header("Location: dashboard.php");
                # else print error msg check ( 22 LINE )
            } else {
                echo $error;
            }
        }

?>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>