<nav class="navbar navbar-dark fixed-top navbar-expand-md" style="background-color: #222;" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span>
&#x2630;</button> <a class="navbar-brand"
    href="index.php">CMS Admin</a>
    <!-- Top Menu Items -->
    <ul class="nav top-nav " style="background-color: #222;">
        <li class="nav-item float-right"> <a href="../index.php" class="nav-link">LIVE</a>
        </li>
        <li class="dropdown nav-item"> <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-user"></i> 

                <!-- Dynamic USER Personalization -->

                <?php

                    if(isset($_SESSION["username"])) {

                        echo $_SESSION["username"];

                    }

                

                ?>

            

             <b class="caret"></b></a>
            <ul class="dropdown-menu" style="background-color: #222;">
                <li class="dropdown-item"> <a href="#" class="text-white"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider dropdown-item"></li>
                <li class="dropdown-item"> <a href="../includes/logout.php" class="text-white"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>





    

    <!-- Sidebar Menu Items - These collapse to the responsive navigation
    menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse" style="background-color: #222;">
        <ul class="nav navbar-nav side-nav mt-5" style="background-color: #222;">
            <li class="nav-item"> <a href="index.php" class="nav-link"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="nav-item"> <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"
                class="nav-link"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul
                id="posts_dropdown" class="collapse">
                    <li> <a href="./posts.php">View All Posts</a>
                    </li>
                    <li> <a href="posts.php?source=add_post">Add Post</a>
                    </li>
        </ul>
        </li>
        
        <li class="nav-item"> <a href="javascript:;" data-toggle="collapse" data-target="#demo2" class="nav-link"><i class="fa fa-fw fa-arrows-v"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>
            <ul
            id="demo2" class="collapse">
                <li> <a href="./categories.php">View All Categories</a>
                </li>
                <li> <a href="#">Add Category</a>
                </li>
                </ul>
        </li>
        <li class="nav-item"> <a href="comments.php" class="nav-link"><i class="fa fa-fw fa-file"></i> Comments</a>
        </li>
        <li class="nav-item"> <a href="javascript:;" data-toggle="collapse" data-target="#users" class="nav-link"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
            <ul
            id="users" class="collapse">
                <li> <a href="users.php">View All Users</a>
                </li>
                <li> <a href="users.php?source=add_user">Add User</a>
                </li>
                </ul>
        </li>
        <li class="nav-item"> <a href="profile.php" class="nav-link"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
        </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>