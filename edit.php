<?php
// file connection 
require_once('db_connection.php');

// update operation 
if(isset($_REQUEST['update'])) {
    $c_id   = $_REQUEST['c_id'];
    $c_name = $_REQUEST['c_name'];
    $c_icon = $_REQUEST['c_icon'];
    // update query 
    $update_sql = "UPDATE `newsinfo` SET `name`='$c_name',`icon`='$c_icon' WHERE id=$c_id";
    if($conn ->query($update_sql)) {
        header('location:category.php');
    } else {
        die($conn ->error);
    }
}

if(isset($_REQUEST['upid'])) {
    $upid = $_REQUEST['upid'];
    // select query to show data for editing in the input 
    $select_sql = "SELECT * FROM newsinfo WHERE id = $upid";
    $query = $conn ->query($select_sql);
    while($result = $query -> fetch_assoc()) {

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet"/>
</head>
<body>
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-6">
        <h1 class="mt-4 text-center">Update Category</h1>
            <ol class="breadcrumb mb-4 justify-content-center">
                <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="mb-3">
                    <label for="c_name" class="form-label">Category Name</label>
                    <input type="text" value="<?php echo $result['name'];?>" class="form-control" id="c_name" name="c_name">
                </div>
                <div class="mb-3">
                    <label for="c_icon" class="form-label">Category Icon</label>
                    <input type="text" value="<?php echo $result['icon'];?>" class="form-control" id="c_icon" name="c_icon">
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>

<?php
    }
}
?>