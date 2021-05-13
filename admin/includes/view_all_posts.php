<?php include("modal_delete.php"); ?>

<?php

if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST["bulk_options"];
       
        switch($bulk_options) {
            case "Published":
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_published = mysqli_query($connection, $query);
                confirmQuery($update_to_published);
                break;
            case "Draft": 
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_draft = mysqli_query($connection, $query);
                confirmQuery($update_to_draft);
                break;
            case "Delete":
                $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $update_to_delete = mysqli_query($connection, $query);
                confirmQuery($update_to_delete);
                break;

            case "Duplicate":
                $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
                $select_post_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($select_post_query)) {
                    $post_title = $row["post_title"];
                    $post_category_id = $row["post_category_id"];
                    $post_date = $row["post_date"];
                    $post_author = $row["post_author"];
                    // $post_user = $row["post_user"];
                    $post_status = $row["post_status"];
                    $post_image = $row["post_image"];
                    $post_tags = $row["post_tags"];
                    $post_content = $row["post_content"];
                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' )";
                $copy_query = mysqli_query($connection, $query);

                if(!$copy_query) {
                    die("QUERY FAILED " . mysqli_error($connection));
                }
                break;

          
            

        }

    }

}




?>





<form action="" method="POST">

    <table class="table table-bordered table-hover">

    <div id="bulkOptionsContainer" class="col-xs-4 mb-4">

        <select name="bulk_options" class="form-control">
            <option value="">Select Options</option>
            <option value="Published">Publish</option>
            <option value="Draft">Draft</option>
            <option value="Duplicate">Duplicate</option>
            <option value="Delete">Delete</option>
            
        </select>

    </div>

    <div class="col-xs-4 mb-2">
        <input type="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="./posts.php?source=add_post">Add New</a>
    </div>

        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead>
        <tbody>

    <?php
        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $select_posts = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row["post_id"];
            $post_author = $row["post_author"];
            $post_title = $row["post_title"];
            $post_category_id = $row["post_category_id"];
            $post_status = $row["post_status"];
            $post_image = $row["post_image"];
            $post_tags = $row["post_tags"];
            $post_comment_count = $row["post_comment_count"];
            $post_date = $row["post_date"];
            $post_views = $row["post_views"];

            echo "<tr>";
            ?>   
                <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>
               
                
    <?php
             
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";

            $query = "SELECT * FROM categories WHERE category_id = {$post_category_id}";
            $select_categories_id = mysqli_query($connection, $query); 
            
            while($row = mysqli_fetch_assoc($select_categories_id)) {
                $category_id = $row["category_id"];
                $category_title = $row["category_title"];

            echo "<td>{$category_title}</td>";

            }

            echo "<td>{$post_status}</td>";
            echo "<td><img style='width: 100px;' src='../images/$post_image'></td>";
            echo "<td>{$post_tags}</td>";
            
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a rel='javascript:void(0)' href='posts.php?delete={$post_id}' class='delete_link'>Delete</a></td>";
            // echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to DELETE this item?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "<td><a href='posts.php?reset={$post_id}'>{$post_views}</a></td>";
            echo "</tr>";
        }


        
    ?>


        
        
    </tbody>
    </table>



    <?php

        if(isset($_GET["delete"])) {

            $the_post_id = $_GET["delete"];

            $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
            $delete_query = mysqli_query($connection, $query);

            header("Location: posts.php");

        }   


        if(isset($_GET["reset"])) {

            $the_post_id = $_GET["reset"];

            $query = "UPDATE posts SET post_views = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
            $reset_query = mysqli_query($connection, $query);

            header("Location: posts.php");

        }  



    ?>

    <script>

        $(document).ready(function(){
            $(".delete_link").on("click", function(){
                let id = $(this).attr("rel");
                let delete_url = "posts.php?delete="+ id +" ";

                $(".modal_delete_link").attr("href", delete_url);

                $("#myModal").modal("show");
            });
        });
    
    </script>






</form>