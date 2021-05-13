<?php

if(isset($_GET["edit_user"])) {
    $get_user_id = escape($_GET["edit_user"]);

    $query = "SELECT * FROM users WHERE user_id = $get_user_id ";
    $select_users_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row["user_id"];
        $user_name = $row["user_name"];
        $user_password = $row["user_password"];
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_email = $row["user_email"];
        $user_image = $row["user_image"];
        $user_role = $row["user_role"];

    }

}








if(isset($_POST["edit_user"])) {
    $user_firstname = escape($_POST["user_firstname"]);
    $user_lastname = escape($_POST["user_lastname"]);
    $user_role = escape($_POST["user_role"]);
    $user_name = escape($_POST["user_name"]);
    $user_email = escape($_POST["user_email"]);
    $user_password = escape($_POST["user_password"]);

    // $post_image = $_FILES["image"]["name"];
    // $post_image_temp = $_FILES["image"]["tmp_name"];

    // $post_tags = $_POST["post_tags"];
    // $post_content = $_POST["post_content"];
    // $post_date = date("d-m-y");
    // $post_comment_count = 4;
    

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
    if(!$select_randsalt_query) {
        die("Query Failed" . mysqli_error($connection));
    }

    

    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row["randSalt"];
    $hashed_password = crypt($user_password, $salt);

    $query = "UPDATE users SET ";
    $query .="user_firstname = '{$user_firstname}', ";
    $query .="user_lastname = '{$user_lastname}', ";
    $query .="user_role = '{$user_role}', ";
    $query .="user_name = '{$user_name}', ";
    $query .="user_email = '{$user_email}', ";
    $query .="user_password = '{$hashed_password}' "; 
    $query .= "WHERE user_id = {$get_user_id} ";



    $edit_user_query = mysqli_query($connection, $query);

    confirmQuery($edit_user_query);


}






?>







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

            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>


            <?php
                if($user_role == 'admin') {
                    echo "<option value='subscriber'>Subscriber</option>";
                } else {
                    echo "<option value='admin'>Admin</option>";
                }

            
            ?>



            
            
            
        </select>
      
    </div>


       
      
    <!-- <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file"  name="image">
    </div> -->

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
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>


</form>