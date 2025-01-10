<?php
// file connection 
require_once('db_connection.php');

// data selection operations to read all data 
// query 
$select_sql = "SELECT * FROM newsinfo";
$query = $conn ->query($select_sql);

// Codes run here to show data into banner page 
// select operation 
$select_sql = "SELECT * FROM `banner`";
$select_query = $conn ->query($select_sql);
?>