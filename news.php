<?php
// file connection 
require_once('db_connection.php');

$message = null;
$submitted = null;

if(isset($_REQUEST['n_submit'])) {
    $title  = htmlspecialchars($_REQUEST['n_title']);
    $icon   = $_REQUEST['n_icon'];
    $desc   = htmlspecialchars($_REQUEST['n_desc']);
    $nid    = $_REQUEST['n_id'];
    $pass   = md5($_REQUEST['password']);
    $cpass  = md5($_REQUEST['c_password']);
    if($pass === $cpass) {
        // insert query 
        $sql = "INSERT INTO `news`(`title`, `icon`, `description`, `pass`, `n_id`) VALUES ('$title','$icon ','$desc','$pass',$nid)";
        // run query 
        if($conn ->query($sql)) {
            $submitted = "<p class='text-success'>Your data has been submitted</p>";
        } else {
            die($conn ->error);
        }
    } else {
        $message = "<p class='text-danger'>Password and confirm password didn't match. Please try again</p>";
    }
}
$select_sql = "SELECT news.title, news.icon, news.description, newsinfo.name, news.id 
FROM newsinfo, news 
WHERE newsinfo.id=news.n_id";
$query = $conn ->query($select_sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>News</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet"/>
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
                            
                            <a class="nav-link" href="category.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Category
                            </a>
                            <a class="nav-link active" href="news.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                News
                            </a>
                            <a class="nav-link" href="banner.php">
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
                            <h1 class="mt-4 text-center">News</h1>
                            <ol class="breadcrumb mb-4 justify-content-center">
                                <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">News</li>
                            </ol>
                        <!-- form  -->
                        <div class="row justify-content-center my-5">
                            <div class="col-lg-6">
                                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                    <div class="mb-3">
                                        <label for="n_title" class="form-label">News Title</label>
                                        <input type="text" class="form-control" id="n_title" name="n_title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="n_icon" class="form-label">News Icon</label>
                                        <input type="text" class="form-control" id="n_icon" name="n_icon" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="n_desc" class="form-label">News Description</label>
                                        <textarea class="form-control" id="n_desc" name="n_desc" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="n_id" class="form-label">News Id</label>
                                        <input type="number" class="form-control" id="n_id" name="n_id" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input">
                                            <input type="password" class="form-control operation" id="password" name="password" required>
                                            <span type="button" class="p_icon">
                                                <img src="images/favicon/eye1.png" id="eye1">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="c_password" class="form-label">Confirm password</label>
                                        <div class="input">
                                            <input type="password" class="form-control operation" id="c_password" name="c_password" required><span type="button" class="p_icon"><img src="images/favicon/eye1.png" id="eye2"></span>
                                        </div>
                                        <div>
                                            <?php 
                                            echo $message;
                                            echo $submitted;
                                            ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="n_submit">Submit</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <h2 class="text-center">News</h2>
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">News Id</th>
                                            <th style="width: 15%;">News Title</th>
                                            <th style="width: 15%;">News Icon</th>
                                            <th style="width:">Description</th>
                                            <th style="width: 10%;">Category</th>
                                            <th style="width: 13%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- inside php codes to show data into table -->
                                        <?php
                                        // require_once('select.php');
                                        if($query -> num_rows > 0) {
                                            while($result = $query -> fetch_assoc()) {
                                                echo 
                                                "<tr>
                                                <td>".$result['id']."</td>
                                                <td>".$result['title']."</td>
                                                <td>".$result['icon']."</td>
                                                <td>".$result['description']."</td>
                                                <td>".$result['name']."</td>
                                                <td>
                                                <a href='newsedit.php?newsid=".$result['id']."' class='btn btn-primary'>Edit</a>
                                                <a href='delete.php?newsdelid=".$result['id']."' class='btn btn-danger'>Delete</a>
                                                </td>
                                                </tr>";
                                            }
                                        } else {
                                            echo 
                                            "<tr>
                                            <td>No data to show</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
        <script>
            let password = document.getElementById("password");
            let eye1 = document.getElementById("eye1");
            eye1.onclick = function () {
                if(password.type == "password") {
                    password.type = "text";
                    eye1.src = "images/favicon/eye2.png";
                } else {
                    password.type = "password";
                    eye1.src = "images/favicon/eye1.png";
                }
            }
            let c_password = document.getElementById("c_password");
            let eye2 = document.getElementById("eye2");
            eye2.onclick = function () {
                if(c_password.type == "password") {
                    c_password.type = "text";
                    eye2.src = "images/favicon/eye2.png";
                } else {
                    c_password.type = "password";
                    eye2.src = "images/favicon/eye1.png";
                }
            }
            if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
            }
        </script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
