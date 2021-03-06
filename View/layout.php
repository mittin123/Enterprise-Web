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
    <title>Homepage</title>

    <!-- Fontfaces CSS-->
    <link href="View/css/font-face.css" rel="stylesheet" media="all">
    <link href="View/css/datetimepicker.css" rel="stylesheet" media="all">
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
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="View/images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 1){
            include('student_sidebar2.php');
        }
        
        else include('tutor_sidebar2.php');
        ?>
        </header>
        <!-- END HEADER MOBILE-->

        <?php include("$view.php");?>
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
    <script src="View/js/moment.js"></script>
    <script src="View/js/bootstrap-datetimepicker.js"></script>
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