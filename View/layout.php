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
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <li>
                            <a href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                            <a href="form.html">
                                <i class="fas fa-rss-square"></i>Blog</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="as fa-archive"></i>Option</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.php">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="View/images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-address-card"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-align-justify"></i>Arrange meeting</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="fas fa-rss-square"></i>Blog</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="as fa-archive"></i>Option</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">1</span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>You have 2 news message</p>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="View/images/icon/avatar-06.jpg" alt="Michelle Moreno" />
                                                </div>
                                                <div class="content">
                                                    <h6>Michelle Moreno</h6>
                                                    <p>Have sent a photo</p>
                                                    <span class="time">3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="View/images/icon/avatar-04.jpg" alt="Diane Myers" />
                                                </div>
                                                <div class="content">
                                                    <h6>Diane Myers</h6>
                                                    <p>You are now connected on message</p>
                                                    <span class="time">Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="mess__footer">
                                                <a href="inbox.html">View all messages</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <span class="quantity">1</span>
                                        <div class="email-dropdown js-dropdown">
                                            <div class="email__title">
                                                <p>You have 3 New Emails</p>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="View/images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, 3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="View/images/icon/avatar-05.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="View/images/icon/avatar-04.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, April 12,,2018</span>
                                                </div>
                                            </div>
                                            <div class="email__footer">
                                                <a href="#">See all emails</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Redirect đến trang login hộ t phát-->
                                <div align="right" style="margin-top: -5px;">
                                      <a href ="login.php"><button type="button" class="btn btn-primary">Log In</button></a>
                                <!-- </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="View/images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">john doe</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="View/images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">john doe</a>
                                                    </h5>
                                                    <span class="email">johndoe@example.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
             <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <h3 class="title-5 m-b-35">Blogs</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Blog 1</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                             <p class="card-text">The unique stripes of zebras make them one of the animals most familiar to people..... 
                                            </p>
                                            <h6><i>by (Name of author)</i></h6>
                                            <h6><i>Last update: dd/mm/yyyy</i></h6>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <a href="#"><input class="btn btn-info" type="button" value="Details"></a> <!-- Chỉ hiện lên khi đã đăng nhập -->
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Blog 2</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <p class="card-text">The unique stripes of zebras make them one of the animals most familiar to people..... 
                                            </p>
                                            <h6><i>by (Name of author)</i></h6>
                                            <h6><i>Last update: dd/mm/yyyy</i></h6>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <a href="#"><input class="btn btn-info" type="button" value="Details"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Blog 3</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                             <p class="card-text">The unique stripes of zebras make them one of the animals most familiar to people.... 
                                            </p>
                                            </p>
                                            <h6><i>by (Name of author)</i></h6>
                                            <h6><i>Last update: dd/mm/yyyy</i></h6>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <a href="#"><input class="btn btn-info" type="button" value="Details"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Blog 4</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                             <p class="card-text">The unique stripes of zebras make them one of the animals most familiar to people.... 
                                            </p>
                                            </p>
                                            <h6><i>by (Name of author)</i></h6>
                                            <h6><i>Last update: dd/mm/yyyy</i></h6>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <a href="#"><input class="btn btn-info" type="button" value="Details"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Blog 5</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                             <p class="card-text">The unique stripes of zebras make them one of the animals most familiar to people.... 
                                            </p>
                                            </p>
                                            <h6><i>by (Name of author)</i></h6>
                                            <h6><i>Last update: dd/mm/yyyy</i></h6>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <a href="#"><input class="btn btn-info" type="button" value="Details"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Blog 6</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                             <p class="card-text">The unique stripes of zebras make them one of the animals most familiar to people..... 
                                            </p>
                                            </p>
                                            <h6><i>by (Name of author)</i></h6>
                                            <h6><i>Last update: dd/mm/yyyy</i></h6>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <a href="#"><input class="btn btn-info" type="button" value="Details"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
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