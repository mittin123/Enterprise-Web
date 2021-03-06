<?php
require_once("#config.php");
include("function.php");
$function = new func();
if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['email'])){
    $function->redir("index.php");
}
else{
    if(isset($_POST['login'])){
        $email = addslashes($_POST['email']);
        $password = addslashes($_POST['password']);
        
        $db = Database::getInstance();
        
        $result = $db->login($email, $password);
        
        if($result && $result['status'] == 1){
            
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['type'] = $result['type'];
            $_SESSION['id'] = $result['username'];
            $_SESSION['tutor_id'] = $result['tutor_id'];
            $function->redir("index.php");
        }
        else{
            $function->alert("Wrong username/password");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="View/css/font-face.css" rel="stylesheet" media="all">
    <link href="View/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="View/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="View/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="View/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="View/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="View/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="View/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="View/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="View/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="View/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="View/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="View/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="View/images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" id="email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full"  name="password" id="password" placeholder="Password" type="password">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="login" id="login">sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="View/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="View/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="View/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="View/vendor/slick/slick.min.js">
    </script>
    <script src="View/vendor/wow/wow.min.js"></script>
    <script src="View/vendor/animsition/animsition.min.js"></script>
    <script src="View/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="View/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="View/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="View/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="View/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="View/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="View/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="View/js/main.js"></script>

</body>

</html>
<!-- end document-->