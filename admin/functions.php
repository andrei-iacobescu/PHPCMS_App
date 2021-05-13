<?php


function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}






function confirmQuery ($result) {
    global $connection;

    if(!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    
}





function insert_categories() {

    global $connection;

    if(isset($_POST["submit"])) {
        $category_title = $_POST["category_title"];

        if($category_title == "" || empty($category_title)) {
            echo "This field should not be empty!";
        } else {
            $query = "INSERT INTO categories(category_title)";
            $query .= "VALUE('{$category_title}')";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query) {
                 die("QUERY FAILED" . mysqli_error($connection));
            }

        }
    }
}



function findAllCategories() {
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query); 
    
    while($row = mysqli_fetch_assoc($select_categories)) {
        $category_id = $row["category_id"];
        $category_title = $row["category_title"];
        
        echo "<tr>";
        echo "<td>{$category_id}</td>";
        echo "<td>{$category_title}</td>";
        echo "<td><a href='categories.php?delete={$category_id}'>Remove</a></td>";
        echo "<td><a href='categories.php?edit={$category_id}'>Edit</a></td>";
        echo "</tr>";
    }
}


function deleteCategories() {
    global $connection;

    if(isset($_GET["delete"])) {
        $get_category_id = $_GET["delete"];

        $query = "DELETE FROM categories WHERE category_id = {$get_category_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}





function recordCount($table) {
    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_posts);

    confirmQuery($result);

    return $result;
}




function checkStatus($table, $column, $status) {
    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    return mysqli_num_rows($result);
}


function checkUserRole($table, $column, $role) {
    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$role'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    return mysqli_num_rows($result);
}



function is_admin($username = '') {
    global $connection;

    $query = "SELECT user_role FROM users WHERE user_name = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $row = mysqli_fetch_array($result);

    if($row["user_role" == 'Admin']) {
        return true;
    } else {
        return false;
    }
}



