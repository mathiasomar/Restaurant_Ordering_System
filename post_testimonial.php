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
    
    if (isset($_POST['update_profile'])) {
        $test = mysqli_real_escape_string($conn, $_POST['testimonial']);

        if (!empty($test)) {
            $status = 1;
            mysqli_query($conn, "INSERT INTO tbl_testimonial VALUES(NULL, '$customer_id', '$test', '$status', NULL)") or die(mysqli_error($conn));
            $msg = "Testimonial Posted Successfully";
            $msgClass = "success";

        } else {
            $msg = "Fill the testimonial to post";
            $msgClass = "warning";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant || Post Testimonial</title>
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
                <p><a href="<?php echo ROOT_URL2; ?>">Home</a> / Post Testimonial</p>
            </div>
        </div>
        <!--/Banner-->

        <!--List Category-->
        <section class="listing">
            <div class="container">
                <div class="section-header mb-5">
                    <div class="header-text">
                        <h5>Post Testimonial</h5>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="menus">
                            <ul>
                                <li><a href="profile.php">My Profile</a></li>
                                <li><a href="my_testimonial.php">My Testimonial</a></li>
                                <li class="li_active"><a href="post_testimonial.php" class="active_link">Post Testimonial</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 mb-4">
                        <div class="frm">
                            <?php if ($msg != ""): ?>
                                <div class="alert text-center alert-<?php echo $msgClass; ?> mb-4"><?php echo $msg; ?></div>
                            <?php endif; ?>
                            <form action="" method="post">
                                <div class="form-group mb-4" id="grp4">
                                    <label for="">Post Testimonial</label>
                                    <textarea name="testimonial" id="" rows="4"></textarea>
                                </div>
                                <button type="submit" name="update_profile" class="btn btn-primary w-100">POST</button>
                            </form>
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