<div class="col-md-4">
   
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="POST">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- Search form -->
                    <!-- /.input-group -->
                </div>






             <!-- Login -->
            <div class="well">

            <?php if(isset($_SESSION['user_role'])): ?>

            <h4>Logged In as <?php echo $_SESSION['username']?></h4>
            <a href="includes/logout.php" class="btn btn-primary">Log Out</a>

            <?php else: ?>
            
                <h4>Login</h4>
                <form action="../../php cms/includes/login.php" method="POST">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                    </div>


                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">Log in</button>
                        </span>
                    </div>
                </form>
                    <!-- Search form -->
                    <!-- /.input-group -->


            <?php endif; ?>
                
            </div>










                <!-- Blog Categories Well -->
                <div class="well">

                <?php
                
                $query = "SELECT * FROM categories LIMIT 3";
                $select_sidebar_categories = mysqli_query($connection, $query); 
                
                ?>


                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

                            <?php
                            
                            while($row = mysqli_fetch_assoc($select_sidebar_categories)) {
                                $category_title = $row["category_title"];
                                $category_id = $row["category_id"];
            
                                echo "<li><a href='category.php?category=$category_id'>{$category_title}</a></li>";
                            }
                            
                            ?>
                                
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "./includes/widget.php" ?>

            </div>