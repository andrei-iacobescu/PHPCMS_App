<?php
ob_start();

// The most secure way to connect (convert the values into constants)
$db["db_host"] = "localhost";
$db["db_user"] = "root";
$db["db_pass"] = "";
$db["db_name"] = "cms";

foreach($db as $key => $value) {
    define(strtoupper($key), $value);
}



$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);



// The easy way, not the correct way
// $connection = mysqli_connect("localhost", "root", "", "cms");




// if($connection) {
//     echo "We are connected";
// }

// 


