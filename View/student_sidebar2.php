<nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
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
                    <a href="view_folder.php?stu_id=1">
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
                    <a href="Chat/index.php?room_id=<?=$_SESSION['stu_tu_id']?>">
                        <i class="fas fa-rss-square"></i>Chat</a >
                </li>
                    </ul>
                </div>
            </nav>