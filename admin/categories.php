<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper" style="height: 925px;">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header mt-5 mb-5">
                            Categories Section
                        </h1>

                        <div class="col-xs-6">
                        <!-- Insert Categories PHP -->
                        <?php insert_categories();  ?>
                            

                            <form action="" method="POST">
                                <div class="form-group">
                                <label for="category_title">Add Category</label>
                                    <input class="form-control" type="text" name="category_title">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            
                            </form>


                            <?php
                                // UPDATE AND INCLUDE QUERY
                                if(isset($_GET["edit"])) {
                                    $category_id = $_GET["edit"];

                                    include "../admin/includes/update_categories.php";
                                }
                            
                            ?>
                        
                        </div> <!-- Add category form -->


                        <div class="col-xs-6">

                    
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php
                                    // Find all Categories query
                                   findAllCategories();
                                ?>

                                    
                                    <?php
                                        // DELETE QUERY
                                        deleteCategories();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php include "includes/admin_footer.php" ?>
