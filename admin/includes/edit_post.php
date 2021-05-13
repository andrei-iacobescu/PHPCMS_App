<?php

if(isset($_GET["p_id"])) {
    $get_post_id = escape($_GET["p_id"]);
}

$query = "SELECT * FROM posts WHERE post_id = $get_post_id";
$select_posts_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row["post_id"];
    $post_author = $row["post_author"];
    $post_title = $row["post_title"];
    $post_category_id = $row["post_category_id"];
    $post_status = $row["post_status"];
    $post_image = $row["post_image"];
    $post_tags = $row["post_tags"];
    $post_comment_count = $row["post_comment_count"];
    $post_date = $row["post_date"];
    $post_content = $row["post_content"];
}


    if(isset($_POST["update_post"])) {
        $post_author = escape($_POST["post_author"]);
        $post_title = escape($_POST["post_title"]);
        $post_category_id = escape($_POST["post_category"]);
        $post_status = escape($_POST["post_status"]);
        // $post_image = escape($_FILES["image"]["name"]);
        // $post_image_temp = escape($_FILES["image"]["tmp_name"]);
        $post_content = escape($_POST["post_content"]);
        $post_tags = escape($_POST["post_tags"]);
        // $post_date = escape($_POST["post_date"]);


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



        // move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $get_post_id";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image)) {
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .="post_title = '{$post_title}', ";
        $query .="post_category_id = '{$post_category_id}', ";
        $query .="post_date = now(), ";
        $query .="post_author = '{$post_author}', ";
        $query .="post_status = '{$post_status}', ";
        $query .="post_tags = '{$post_tags}', "; 
        $query .="post_content = '{$post_content}', ";
        $query .="post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$get_post_id} ";



        

        $update_post = mysqli_query($connection, $query);

        confirmQuery($update_post);

        echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id=$get_post_id'> View Post  </a> or <a href='posts.php'> Edit More Posts </a></p>";
        
    
    }


?>


<form action="" method="post" enctype="multipart/form-data">    
     
     
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
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
    

                

                if($category_id == $post_category_id) {
                    echo "<option selected value='{$category_id}'>{$category_title}</option>";
                } else {
                    echo "<option value='{$category_id}'>{$category_title}</option>";
                }
            
                }
            
            ?>
        
        </select>
      
    </div>


       <div class="form-group">
       <label for="author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">

       
      </div>


        <div class="form-group">
            <select name="post_status" class="form-control">

                <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>

                <?php
                    if($post_status == "Published") {
                        echo "<option value='Draft'>Draft</option>";
                    } else {
                        echo "<option value='Published'>Published</option>";
                    }
                
                
                ?>

            </select>
        </div>
      


      

        <!-- <div class="form-group">
       <label for="post_status">Post Status</label>
          <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
      </div>  -->
      
      
      
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="" srcset="">
    </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control" name="post_content" cols="30" rows="10"><?php echo str_replace('\r\n', '</br>', $post_content); ?>
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
      </div>


</form>