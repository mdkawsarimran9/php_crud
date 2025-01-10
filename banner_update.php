<?php
// file connection 
include('db_connection.php');

// update data 
if(isset($_POST['update'])) {
    $b_title = $_POST['b_title'];
    $b_desc  = $_POST['b_desc'];
    $b_icon  = $_POST['b_icon'];
    $b_id    = $_POST['myid'];
    // update query 
    $update_sql = "UPDATE `banner` SET `title`='$b_title',`description`='$b_desc',`icon`='$b_icon' WHERE id=$b_id";
    if($conn ->query($update_sql)) {
        header('location: banner.php');
    }
}



if(isset($_GET['id'])) {
    $id   = $_GET['id'];
    $sql = "SELECT * FROM banner WHERE id=$id";
    $query = $conn ->query($sql);
    while($result = $query -> fetch_assoc()) {
        $bannerId = $result['id'];
        $bannerTitle = $result['title'];
        $bannerDesc  = $result['description'];
        $bannerIcon  = $result['icon'];

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Update Banner</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="admin.php">Mynews</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="index.php" target="_blank">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Website
                            </a>
                            <div class="sb-sidenav-menu-heading">Pages</div>
                            <a class="nav-link collapsed" href="category.php" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Category
                            </a>
                            <a class="nav-link" href="news.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                News
                            </a>
                            <a class="nav-link active" href="banner.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                banner
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                            <h1 class="mt-4 text-center">Update Banner</h1>
                            <ol class="breadcrumb mb-4 justify-content-center">
                                <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Banner</li>
                            </ol>
                        <!-- form  -->
                        <div class="row justify-content-center my-5">
                            <div class="col-lg-6">
                                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                    <div class="mb-3">
                                        <label for="b_title" class="form-label">Edit Title</label>
                                        <input type="text" class="form-control" value="<?php echo $bannerTitle;?>" id="b_title" name="b_title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="b_desc" class="form-label">Edit Description</label>
                                        <textarea class="form-control" id="b_desc" name="b_desc"><?php echo $bannerDesc;?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="b_icon" class="form-label">Edit Icon</label>
                                        <input type="text" class="form-control" value="<?php echo $bannerIcon;?>" id="b_icon" name="b_icon">
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" value="<?php echo $bannerId;?>" name="myid">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Mynews 2025</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
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