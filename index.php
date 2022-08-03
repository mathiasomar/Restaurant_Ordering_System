<?php
    include 'admin/connection.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant || Home</title>
    <link rel="icon" href="assets/images/IMG-20220419-WA0001.jpg">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!--Navbar-->
    <?php include 'inc/navbar.php'; ?>
    <!--/Navbar-->

    <!--Main Section-->
    <main>
        <!--Banner-->
        <div class="banner">
            <div class="banner-headers" id="bheader">
                <h1>Pathfinder Restaurant - the quality food</h1>
                <p>We deliver quality. Try us and then buy us!</p>
            </div>
            <a href="pages.php?type=aboutus" class="btn btn-primary">Explore <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        <!--/Banner-->

        <!--Search Section-->
        <?php include 'inc/search_section.php'; ?>
        <!--/Search Section-->

        <!--List Category-->
        <section class="listing">
            <div class="container">
                <div class="section-header mb-5">
                    <div class="header-text">
                        <h5>Recent Menus</h5>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <?php
                        $qry = mysqli_query($conn, "SELECT * FROM tbl_menu ORDER BY id DESC LIMIT 4") or die(mysqli_error($conn));
                        while ($menu = mysqli_fetch_array($qry)) {
                            ?>
                                <div class="col-md-3 mb-4">
                                    <div class="list-item">
                                        <img src="admin/uploaded_images/<?php echo htmlentities($menu['menu_image']); ?>" alt="">
                                        <div class="list-c">
                                            <button class="descbtn">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="list-desc">
                                                <div class="list-desc-text">
                                                    <p><?php echo htmlentities($menu['description']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-heading">
                                        <a href="menu_items.php?id=<?php echo htmlentities($menu['id']); ?>"><?php echo htmlentities($menu['menu_name']); ?></a>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                </div>

                <div class="row justify-content-center mt-4 mb-4">
                    <div class="col-md-3">
                        <a href="menu.php" class="btn btn-primary btn-sm">More <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <!--/List Category-->

        <!--Testimonial-->
        <section class="testimonial">
            <div class="container">
                <div class="section-header mb-5">
                    <div class="header-text">
                        <h5>Our Satisfied Customers</h5>
                    </div>
                </div>

                <div class="testimonial-container">
                    <div class="row">
                        <?php
                            $status = 1;
                            $qry = mysqli_query($conn, "SELECT tbl_testimonial.*, tbl_customers.cus_name FROM tbl_testimonial JOIN tbl_customers ON tbl_testimonial.customer_id=tbl_customers.id WHERE tbl_testimonial.status='$status'") or die(mysqli_error($conn));
                            while ($test = mysqli_fetch_array($qry)) {
                                ?>
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <div class="testimonial-msg">
                                            <div class="testimonial-msg-header">
                                                <strong><i class="fas fa-user-circle"></i> <?php echo htmlentities($test['cus_name']); ?></strong>
                                            </div>
                                            <hr>
                                            <div class="testimonial-msg-text">
                                                <p><span><i class="fas fa-quote-left"></i></span>
                                                <?php echo htmlentities($test['testimonial']); ?>
                                                <span><i class="fas fa-quote-right"></i></span></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!--/Testimonial-->

        <!--Footer-->
        <?php include 'inc/footer.php'; ?>
        <!--/Footer-->

        <!--LoginForm-->
        <?php include 'inc/loginform.php'; ?>
        <!--/LoginForm-->
    </main>
    <!--/Main Section-->

    <!--To Top Button-->
    <div class="top-btn" id="top">
        <i class="fas fa-caret-up"></i>
    </div>
    <!--/To Top Button-->

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/mainjs.js"></script>
    <script src="assets/js/click.js"></script>
</body>
</html>