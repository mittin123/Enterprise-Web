<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="View/images/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="index.php">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="arrange_meeting.php?check=0">
                        <i class="fas fa-address-card"></i>Arrange List</a>
                </li>
                <li>
                    <a href="view_folder.php">
                        <i class="fas fa-address-card"></i>Folder</a>
                </li>
                <li>
                    <a href="view_blog.php">
                        <i class="fas fa-rss-square"></i>Your Blog</a>
                </li>
                <li>
                    <a href="view_blog.php?all_blog=1">
                        <i class="fas fa-rss-square"></i>All Blog</a>
                </li>
                <li>
                    <a href="Chat/index.php?id=<?=$_SESSION['tutor_id']?>">
                        <i class="fas fa-rss-square"></i>Chat</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->