<?php
include_once("./Controller/Tutor/TutorController.php");
include_once("./function.php");
if(!isset($_SESSION)){
    session_start();
}
if(isset($_POST['upload']) && isset($_FILES['file_upload'])){
    
    $tutor_controller = new TutorController();
    $func = new Func();
    $file = $_FILES['file_upload'];
    $std_tutor_id = $_SESSION['std_tutor_id'];
    $folder_id = $_GET['id'];
    $uploader = $_SESSION['email'];
    $folder_name = $data['folder_info']['name'];
    $allow = array('pdf','docx','ppt','pptx','doc');
    $file_extension = pathinfo($file['name'],PATHINFO_EXTENSION);
    if(!in_array($file_extension,$allow)){
        $func->alert("Invalid file!");
    }
    else{
        $tutor_controller->uploadFile($uploader, $file['name'], $folder_id,1);
        move_uploaded_file($file['tmp_name'],'../upload/'.$std_tutor_id.'/'.$folder_name.'/'.$file['name']);
        $func->redir($_SERVER['REQUEST_URI']);
    }
}
?>

<?php
        if(!isset($_SESSION)){
            session_start();
        }
        if($_SESSION['type'] == 1){
            include('student_sidebar.php');
        }
        else include('tutor_sidebar.php');
        ?>

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
                                                    <img src="images/icon/avatar-06.jpg" alt="Michelle Moreno" />
                                                </div>
                                                <div class="content">
                                                    <h6>Michelle Moreno</h6>
                                                    <p>Have sent a photo</p>
                                                    <span class="time">3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-04.jpg" alt="Diane Myers" />
                                                </div>
                                                <div class="content">
                                                    <h6>Diane Myers</h6>
                                                    <p>You are now connected on message</p>
                                                    <span class="time">Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="mess__footer">
                                                <a href="#">View all messages</a>
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
                                                    <img src="images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, 3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-05.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-04.jpg" alt="Cynthia Harvey" />
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
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">john doe</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
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
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                    <h1>Folder Detail</h1>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                         <!-- Name of folder-->
                                        <strong>Folder Detail</strong> 
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Name Folder</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <p><?=$data['folder_info']['name']?></p>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Created Time</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                   <p><?=date('d/m/yy',$data['folder_info']['create_time'])?></p>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Update timer</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                   <p><?=date('d/m/yy',$data['folder_info']['create_time'])?></p>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">File</label>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                                <div class="table-responsive table--no-card m-b-40">
                                                    <table class="table table-borderless table-striped table-earning">
                                                        <thead>

                                                            <!--   Dat lenh foreach o day, -->
                                                            <tr>
                                                                <th>File Name</th>
                                                                <th>Create time</th>
                                                                <th>Access</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                foreach($data['file_list'] as $item){
                                                            ?>
                                                            <tr>
                                                                <td><?=$item['file_name']?></td>
                                                                <td><?=date('d/m/yy',$item['create_time'])?></td>
                                                                <td>
                                                                    <a href="<?php echo "?action=view_file&file_id=".$item['id']?>"
                                                                      <button type="button" class="btn btn-info" value="Access">Access</button>
                                                                     </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Upload new file</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                    
                                                    <input type="file" name="file_upload" id="file_upload" value="">                                              
                                                    <input class="btn btn-success" type="submit" name="upload" value="upload">
                                                </div>
                                            </div>
                                        
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <!--<button-- type="submit" class="btn btn-primary btn-sm" id="upfile" name="upfile">
                                            <i class="fa fa-dot-circle-o"></i> Upload
                                        </button-->
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    
