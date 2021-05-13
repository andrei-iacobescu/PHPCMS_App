<?php include "../admin/includes/admin_header.php" ?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "../admin/includes/admin_navigation.php" ?>
    <div id="page-wrapper" style="height: 925px;">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row mt-5 mb-4">
                <div class="col-xl-12">
                     <h1 class="page-header">

                            Welcome to Admin CMS!



                            <small><?php echo $_SESSION["username"]; ?></small>

                        </h1>
                </div>
            </div>
            <!-- /.row -->


            <!-- WIDGET -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card text-white bg-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3"> <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div class="huge">
                                        <?php echo $post_count=recordCount( 'posts'); ?>
                                    </div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div> <a href="posts.php" class="text-white">

                                <div class="card-footer">

                                    <span class="float-left">View Details</span>

                                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>

                                </div>

                            </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card text-white bg-success">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3"> <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div class="huge">
                                        <?php echo $comment_count=recordCount( 'comments'); ?>
                                    </div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div> <a href="comments.php" class="text-white">

                                <div class="card-footer">

                                    <span class="float-left">View Details</span>

                                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>

                                </div>

                            </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card text-white bg-warning">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3"> <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div class="huge">
                                        <?php echo $users_count=recordCount( 'users'); ?>
                                    </div>
                                    <div>Users</div>
                                </div>
                            </div>
                        </div> <a href="users.php" class="text-white">

                                <div class="card-footer">

                                    <span class="float-left">View Details</span>

                                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>

                                </div>

                            </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card text-white bg-danger">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3"> <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div class="huge">
                                        <?php echo $categories_count=recordCount( 'categories'); ?>
                                    </div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div> <a href="categories.php" class="text-white">

                                <div class="card-footer">

                                    <span class="float-left">View Details</span>

                                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>

                                </div>

                            </a>
                    </div>
                </div>
            </div>
            <!-- /.row END WIDGET -->
            <?php
                $post_published_count = checkStatus('posts', 'post_status', 'Published');
                $post_draft_count = checkStatus('posts', 'post_status', 'Draft');
                $unapproved_comments_count = checkStatus('comments', 'comment_status', 'unapproved');
                $subscriber_count = checkUserRole('users', 'user_role', 'Subscriber');
            ?>

            <div class="row mt-5 pt-5">
            <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                            <?php

                            $element_text = ["All Posts", "Active Posts", "Draft Posts", "Comments", "Pending Comments", "Users", "Subscriber Users", "Categories"];  
                            $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $unapproved_comments_count, $users_count, $subscriber_count, $categories_count];
                            
                            for($i = 0; $i < 8; $i++) {
                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }
                            
                            ?>
                        ]);
                        var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 100%; height: 300px;"></div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php include "../admin/includes/admin_footer.php" ?>