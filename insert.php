<?php
// file connection 
require_once('db_connection.php');

// data insert operation 
if(isset($_REQUEST['submit'])) {
    $name = $_REQUEST['c_name'];
    $icon = $_REQUEST['c_icon'];
    
    // insert query 
    $insert_sql = "INSERT INTO newsinfo (name, icon) VALUES ('$name', '$icon')";
    if($conn ->query($insert_sql)) {
        header('location:category.php');
    } else {
        die($conn ->error);
    }
}
// The codes of banner pages 
if(isset($_POST['b_submit'])) {
    $b_title = $_POST['b_title'];
    $b_desc  = $_POST['b_desc'];
    $b_icon  = $_POST['b_icon'];

    // insert query 
    $insert_sql = "INSERT INTO `banner`(`title`, `description`, `icon`) VALUES ('$b_title','$b_desc','$b_icon')";
    if($conn ->query($insert_sql) === TRUE) {
        header('location: banner.php');
    } else {
        die($conn ->error);
    }
}



?>