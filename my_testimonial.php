<?php
    include 'admin/connection.php';
    session_start();

    $msg = "";
    $msgClass = "";

    $username = $_SESSION['username'];
    $customer_id = "";
    $qry = mysqli_query($conn, "SELECT * FROM tbl_customers WHERE cus_name='$username'");
    while ($row = mysqli_fetch_array($qry)) {
        $customer_id = $row['id'];
    }

    if (isset($_REQUEST['del'])) {
        $id = $_REQUEST['del'];
        mysqli_query($conn, "DELETE FROM tbl_testimonial WHERE id='$id'") or die(mysqli_error($conn));
        $msg = "Testimonial Deleted";
        $msgClass = "danger";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant || My Testimonials</title>
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
        <div class="banner2">
            <img src="admin/assets/images/banner4.jpg" alt="" class="image-responsive">
            <div class="banner_title">
                <h1>Testimonials</h1>
                <p><a href="<?php echo ROOT_URL2; ?>">Home</a> / My Testimonials</p>
            </div>
        </div>
        <!--/Banner-->

        <!--List Category-->
        <section class="listing">
            <div class="container">
                <div class="section-header mb-5">
                    <div class="header-text">
                        <h5>Vew My Testimonials</h5>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="menus">
                            <ul>
                                <li><a href="profile.php">My Profile</a></li>
                                <li class="li_active"><a href="my_testimonial.php" class="active_link">My Testimonial</a></li>
                                <li><a href="post_testimonial.php">Post Testimonial</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 mb-4">
                        <div class="frm">
                            <?php if ($msg != ""): ?>
                                <div class="alert text-center alert-<?php echo $msgClass; ?> mb-4"><?php echo $msg; ?></div>
                            <?php endif; ?>
                            <?php
                                $qry = mysqli_query($conn, "SELECT * FROM tbl_testimonial WHERE customer_id='$customer_id' ORDER BY post_date DESC") or die(mysqli_error($conn));
                                if (mysqli_num_rows($qry) > 0) {
                                    while ($test = mysqli_fetch_array($qry)) {
                                        ?>
                                            <ul>
                                                <li><strong>Testimonial:</strong><span><?php echo htmlentities($test['testimonial']); ?></span></li>
                                                <li><strong>Posting Date:</strong><span><?php echo htmlentities($test['post_date']); ?></span></li>
                                                <li><strong>Status:</strong>
                                                    <?php if ($test['status'] == 1): ?>
                                                        <span class="badge bg-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Inactive</span>
                                                    <?php endif; ?>
                                                </li>
                                                <li><a href="my_testimonial.php?del=<?php echo htmlentities($test['id']); ?>" class="btn btn-danger btn-sm">REMOVE</a></li>
                                            </ul>
                                        <?php
                                    }
                                } else {
                                    ?>
                                        <div class="alert alert-default text-center">No Posted Testimonial!!!</div>
                                    <?php
                                }
                                
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/List Category-->

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
    <script>
        $(document).ready(function () {
            $('.banner2 .banner_title').css({'opacity':'1', 'transform':'translateY(0)', 'transition-delay':'0.5s'});
        });
    </script>
</body>
</html>