<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

<?php
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row["user_id"];
        $user_name = $row["user_name"];
        $user_password = $row["user_password"];
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_email = $row["user_email"];
        $user_image = $row["user_image"];
        $user_role = $row["user_role"];

        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$user_firstname}</td>";

        // $query = "SELECT * FROM categories WHERE category_id = {$post_category_id}";
        // $select_categories_id = mysqli_query($connection, $query); 
        
        // while($row = mysqli_fetch_assoc($select_categories_id)) {
        //     $category_id = $row["category_id"];
        //     $category_title = $row["category_title"];

        // echo "<td>{$category_title}</td>";

        // }

        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";

        // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
        // $select_post_id_query = mysqli_query($connection, $query);
        // while($row = mysqli_fetch_assoc($select_post_id_query)) {
        //     $post_id = $row["post_id"];
        //     $post_title = $row["post_title"];

        //     echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
        // }


        
        
        echo "<td><a href='users.php?promote={$user_id}'>Promote</a></td>";
        echo "<td><a href='users.php?demote={$user_id}'>Demote</a></td>";
        echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
        echo "<td><a rel='javascripvt.void(0)' href='users.php?delete={$user_id}'>Remove</a></td>";
        echo "</tr>";
    }


    
?>


    
    
</tbody>
</table>



<?php

    if(isset($_GET["promote"])) {

        $get_user_id = $_GET["promote"];

        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $get_user_id ";
        $promote_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
        

    } 



    if(isset($_GET["demote"])) {

        $get_user_id = $_GET["demote"];

        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $get_user_id ";
        $demote_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
        

    }   



    if(isset($_GET["delete"])) {

        if(isset($_SESSION['user_role'])) {

            if($_SESSION['user_role'] == 'Admin') {
                
                $get_user_id = mysqli_real_escape_string($connection, $_GET["delete"]) ;

                $query = "DELETE FROM users WHERE user_id = {$get_user_id}";
                $delete_query = mysqli_query($connection, $query);
                header("Location: users.php");
            }


            
        
        }

        

    }   



?>