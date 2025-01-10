<?php 
// file connection 
require_once('db_connection.php');

// update news 
if(isset($_REQUEST['update'])) {
    $newsId = $_REQUEST['news_id'];
    $nTile  = htmlspecialchars($_REQUEST['news_title']);
    $nIcon  = $_REQUEST['news_icon'];
    $nDesc  = htmlspecialchars($_REQUEST['news_desc']);
    $foreignKey = $_REQUEST['news_f_id'];

    // update query 
    $news_update_sql = "UPDATE `news` SET `title`='$nTile',`icon`='$nIcon',`description`='$nDesc',`n_id`=$foreignKey WHERE `id`=$newsId";
    if($conn ->query($news_update_sql)) {
        header('location: news.php');
    } else {
        die($conn ->error);
    }


}




if(isset($_REQUEST['newsid'])) {
    $newsId  = $_REQUEST['newsid'];
    // select query 
    $select_sql = "SELECT * FROM news WHERE id=$newsId";
    $query = $conn ->query($select_sql);
    if($query -> num_rows > 0) {
        while($show = $query -> fetch_assoc()) {
            $id        = $show['id'];
            $newsTitle = $show['title'];
            $newsIcon  = $show['icon'];
            $newsDesc  = $show['description'];
            $newsFid   = $show['n_id'];


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update News</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-6">
        <h1 class="mt-4 text-center">Update News</h1>
            <ol class="breadcrumb mb-4 justify-content-center">
                <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                <li class="breadcrumb-item active">News</li>
            </ol>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <div class="mb-3">
                <label for="n_title" class="form-label">News Title</label>
                <input type="text" value="<?php echo $newsTitle;?>" class="form-control" id="n_title" name="news_title" required>
            </div>
            <div class="mb-3">
                <label for="n_icon" class="form-label">News Icon</label>
                <input type="text" value="<?php echo $newsIcon;?>" class="form-control" id="n_icon" name="news_icon" required>
            </div>
            <div class="mb-3">
                <label for="n_desc" class="form-label">News Description</label>
                <textarea class="form-control" id="n_desc" name="news_desc" required><?php echo $newsDesc;?></textarea>
            </div>
            <div class="mb-3">
                <label for="n_id" class="form-label">Category Id</label>
                <input type="number" value="<?php echo $newsFid;?>" class="form-control" id="n_id" name="news_f_id" required>
            </div>
            <div class="mb-3">
                <label for="n_id" class="form-label">News Id</label>
                <input type="hidden" value="<?php echo $id;?>" class="form-control" name="news_id">
            </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
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

}


?>