<?php
    session_start();

    if (strlen($_SESSION['useremail']) == 0) {
        header('Location:index.php');
    } else {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Restaurant || Admin Dashboard</title>
                <link rel="stylesheet" href="assets/css/all.min.css">
                <link rel="stylesheet" href="assets/css/bootstrap.min.css">
                <link rel="stylesheet" href="assets/css/fontawesome.min.css">
                <link rel="stylesheet" href="assets/css/style.css">
                <link rel="icon" href="assets/images/restaurant.svg">
            </head>
            <body>
                <!--Loader-->
                <!--<div class="page-loader">
                    <div class="loader-content">
                        <div class="cont-text">
                            <div class="avatar-m">
                                <div class="avatar">
                                    <i class="fas fa-utensils"></i>
                                </div>
                            </div>
                            <h5>PathFinder Restaurant</h5>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <!--/Loader-->

                <!--Sidebar-->
                <?php include 'inc/sidebar.php'; ?>
                <!--/Sidebar-->

                <!--Navbar-->
                <?php include 'inc/navbar.php'; ?>
                <!--/Navbar-->

                <!--Logout-->
                <?php include 'inc/logout.php'; ?>
                <!--/Logout-->

                <!--Small Mode Icon-->
                <?php include 'inc/icon.php'; ?>
                <!--/Small Mode Icon-->

                <?php
                    $qry = mysqli_query($conn, "SELECT * FROM tbl_user") or die(mysqli_error($conn));
                    $count_users = mysqli_num_rows($qry);
                    $qry = mysqli_query($conn, "SELECT * FROM tbl_menu") or die(mysqli_error($conn));
                    $count_menus = mysqli_num_rows($qry);
                    $qry = mysqli_query($conn, "SELECT * FROM tbl_orders") or die(mysqli_error($conn));
                    $count_orders = mysqli_num_rows($qry);
                    $qry = mysqli_query($conn, "SELECT * FROM tbl_subscribers") or die(mysqli_error($conn));
                    $count_subscribers = mysqli_num_rows($qry);
                ?>

                <!--Main Section-->
                <main>
                    <div class="container-fluid">
                        <div class="section-header">
                            <div class="headers">
                                <p><a href="<?php echo ROOT_URL; ?>"><i class="fas fa-home"></i>Home</a> </p>
                            </div>
                        </div>

                        <hr>

                        <div class="cards-container">
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    <div class="card-single s-one">
                                        <div class="top-stat">
                                            <div class="stat">
                                                <i class="fas fa-users"></i>
                                                <p>Reg Users</p>
                                            </div>
                                            <div class="stat-details">
                                                <h1><?php echo htmlentities($count_users); ?></h1>
                                            </div>
                                        </div>
                                        <div class="bottom-stat">
                                            <div class="stat-link text-center">
                                                <a href="user.php" class="btn btn-primary btn-sm">More Details <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card-single s-two">
                                        <div class="top-stat">
                                            <div class="stat">
                                                <i class="fas fa-shopping-bag"></i>
                                                <p>Menus</p>
                                            </div>
                                            <div class="stat-details">
                                                <h1><?php echo htmlentities($count_menus); ?></h1>
                                            </div>
                                        </div>
                                        <div class="bottom-stat">
                                            <div class="stat-link text-center">
                                                <a href="menu.php" class="btn btn-primary btn-sm">More Details <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card-single s-three">
                                        <div class="top-stat">
                                            <div class="stat">
                                                <i class="fas fa-book"></i>
                                                <p>Subscribers</p>
                                            </div>
                                            <div class="stat-details">
                                                <h1><?php echo htmlentities($count_subscribers); ?></h1>
                                            </div>
                                        </div>
                                        <div class="bottom-stat">
                                            <div class="stat-link text-center">
                                                <a href="subscribers.php" class="btn btn-primary btn-sm">More Details <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card-single s-four">
                                        <div class="top-stat">
                                            <div class="stat">
                                                <i class="fas fa-shopping-basket"></i>
                                                <p>Orders</p>
                                            </div>
                                            <div class="stat-details">
                                                <h1><?php echo htmlentities($count_orders); ?></h1>
                                            </div>
                                        </div>
                                        <div class="bottom-stat">
                                            <div class="stat-link text-center">
                                                <a href="orders.php" class="btn btn-primary btn-sm">More Details <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--<div class="row mb-4">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="chart">
                                    <strong><i class="fas fa-chart-pie"></i> Sales (last one week) in Ksh.</strong>
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="chart">
                                    <strong><i class="fad fa-user"></i> New Users</strong>
                                    
                                </div>
                            </div>
                        </div>-->
                    </div>
                </main>
                <!--/Main Section-->

                <script src="assets/js/bootstrap.min.js"></script>
                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/js/main.js"></script>
                <script src="assets/js/Chart.min.js"></script>
                <script src="assets/js/line.chart.js"></script>
            </body>
            </html>
        <?php
    }
    
?>