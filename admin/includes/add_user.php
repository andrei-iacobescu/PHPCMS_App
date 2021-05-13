<?php

if(isset($_POST["create_user"])) {
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

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_name, user_email, user_password )";

    $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}','{$user_name}', '{$user_email}', '{$user_password}' )";

    

    $create_user_query = mysqli_query($connection, $query);

    

    confirmQuery($create_user_query);

    echo "User Created Successfully" . " " . "<a href='users.php'>View Users</a>";
}






?>







<form action="" method="post" enctype="multipart/form-data">    
     
     
    <div class="form-group">
       <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
      

       <div class="form-group">
       <label for="post_status">Lastname</label>
          <input type="text" class="form-control" name="user_lastname">
      </div>

    <div class="form-group">
        <label for="user_role">User Role</label><br>
        <select name="user_role" class="form-control" id="">
            <option value="select options" default>Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
      
    </div>


       
      
    <!-- <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file"  name="image">
    </div> -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="user_name">
    </div>
      
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    
      
    
      
      

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>


</form>