<?php include "includes/admin_header.php" ?>
<?php

    if(isset($_SESSION["username"])) {
        $username = $_SESSION["username"];

        $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
        $select_user_profile_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_user_profile_query)) {
            $user_id = $row["user_id"];
            $user_name = $row["user_name"];
            $user_password = $row["user_password"];
            $user_firstname = $row["user_firstname"];
            $user_lastname = $row["user_lastname"];
            $user_email = $row["user_email"];
            $user_role = $row["user_role"];
        }
    }


?>



<?php

    if(isset($_POST["edit_user"])) {
        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_role = $_POST["user_role"];
        $user_name = $_POST["user_name"];
        $user_email = $_POST["user_email"];
        $user_password = $_POST["user_password"];

        // $post_image = $_FILES["image"]["name"];
        // $post_image_temp = $_FILES["image"]["tmp_name"];

        // $post_tags = $_POST["post_tags"];
        // $post_content = $_POST["post_content"];
        // $post_date = date("d-m-y");
        // $post_comment_count = 4;
        

        // move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "UPDATE users SET ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_role = '{$user_role}', ";
        $query .="user_name = '{$user_name}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_password = '{$user_password}' "; 
        $query .= "WHERE user_name = '{$username}' ";



        $edit_user_query = mysqli_query($connection, $query);

        confirmQuery($edit_user_query);


    }




?>








    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper" style="height: 925px;">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header mt-5 mb-5">
                            Profile Section
                        </h1>

                    <!-- FORM -->
                        <form action="" method="post" enctype="multipart/form-data">    
     
     
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input value="<?php echo $user_firstname ?>" type="text" class="form-control" name="user_firstname">
                            </div>
                            
                        
                                <div class="form-group">
                                <label for="post_status">Lastname</label>
                                <input value="<?php echo $user_lastname ?>" type="text" class="form-control" name="user_lastname">
                            </div>
                        
                            <div class="form-group">
                                <label for="user_role">User Role</label><br>
                                <select name="user_role" class="form-control" id="">
                        
                                    <option value="subscriber"><?php echo $user_role; ?></option>
                        
                        
                                    <?php
                                        if($user_role == 'admin') {
                                            echo "<option value='subscriber'>Subscriber</option>";
                                        } else {
                                            echo "<option value='admin'>Admin</option>";
                                        }
                    
                                    ?>
                                </select>
                            </div>
                        
                    
                        
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input value="<?php echo $user_name ?>" type="text" class="form-control" name="user_name">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input value="<?php echo $user_email ?>" type="email" class="form-control" name="user_email">
                            </div>
                        
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input value="<?php echo $user_password ?>" type="password" class="form-control" name="user_password">
                            </div>
                        
                            
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                            </div>
 
 
                        </form>
                        
                    <!-- END FORM -->
                        
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
