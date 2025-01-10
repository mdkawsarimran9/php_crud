<?php
// file connection 
require_once('db_connection.php');
// delete operation 
if(isset($_REQUEST['delid'])) {
    $delid = $_REQUEST['delid'];
    // delete query 
    $delete_sql = "DELETE FROM newsinfo WHERE id = $delid";
    if($conn ->query($delete_sql)) {
        header('location:category.php');
    } else {
        die($conn ->error);
    }
}

if(isset($_REQUEST['newsdelid'])) {
    $ndelete = $_REQUEST['newsdelid'];
    $ndel_sql = "DELETE FROM news WHERE id = $ndelete";
    if($conn ->query($ndel_sql)) {
       header('location: news.php');
    } else {
        die($conn ->error);
    }
}

?>