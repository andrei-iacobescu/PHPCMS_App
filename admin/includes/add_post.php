<?php

if(isset($_POST["create_post"])) {
    $post_title = escape($_POST["post_title"]);
    $post_author = escape($_POST["post_author"]);
    $post_category_id = escape($_POST["post_category"]);
    $post_status = escape($_POST["post_status"]);

    // $post_image = escape($_FILES["image"]["name"]);
    // $post_image_temp = escape($_FILES["image"]["tmp_name"]);


    if(isset($_FILES['image'])){
        $errors= array();
    
        $dir = "../images/";
        $post_image = $_FILES['image']['name'];
        $post_image = $dir. $post_image;
        $file_size = $_FILES['image']['size'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $tmp = explode('.',$_FILES['image']['name']);
        $file_ext=strtolower(end($tmp));
        
        $extensions= array("jpeg","jpg","png","gif");
        
        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a GIF, JPEG or PNG file.";
        }
        
        if($file_size > 2097152) {
           $errors[]='File size must be excately 2 MB';
        }
        
        if(empty($errors)==true) {
           move_uploaded_file($post_image_temp, $post_image);
           echo "Success";
        }else{
           print_r($errors);
        }
     }








    $post_tags = escape($_POST["post_tags"]);
    $post_content = escape($_POST["post_content"]);
    
    $post_date = escape(date("d-m-y"));
    // $post_comment_count = 4;
    

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";

    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' )";

    $escape_string = htmlspecialchars($post_content);

    $create_post_query = mysqli_query($connection, $query);

    

    confirmQuery($create_post_query);
   //  $spacing = nl2br($post_content);

    $get_post_id = mysqli_insert_id($connection);

    echo "<p class='bg-success bold'>Post Created. <a href='posts.php?source=add_post' class='text-white'> Create More Posts </a> or <a href='../post.php?p_id={$get_post_id}' class='text-white'>View Created Post</a></p>";

}








?>







<form action="" method="post" enctype="multipart/form-data">    
     
     
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select name="post_category" id="">

        <?php

            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query); 

            confirmQuery($select_categories);


            while($row = mysqli_fetch_assoc($select_categories)) {
            $category_id = $row["category_id"];
            $category_title = $row["category_title"];


            echo "<option value='{$category_id}'>{$category_title}</option>";
        
            }
        
        ?>
    
        </select>
      
    </div>


       <div class="form-group">
       <label for="author">Post Author</label>
        <input type="text" class="form-control" name="post_author">

       
      </div>
      

       <div class="form-group">
       
          <select name="post_status" id="">
            <option value="Draft">Post Status</option>
            <option value="Published">Published</option>
            <option value="Draft">Draft</option>
          </select>
      </div>
      
      
      
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>


      <label for="post_content">Post Content</label>
      <div class="form-group" id="">
         
         <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>