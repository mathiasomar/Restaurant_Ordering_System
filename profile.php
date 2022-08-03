<?php
    include 'admin/connection.php';
    session_start();

    $msg = "";
    $msgClass = "";

    $username = $_SESSION['username'];
    $customer_id = "";
    $customer_email = "";
    $customer_phone = "";
    $qry = mysqli_query($conn, "SELECT * FROM tbl_customers WHERE cus_name='$username'");
    while ($row = mysqli_fetch_array($qry)) {
        $customer_id = $row['id'];
        $customer_email = $row['cus_email'];
        $customer_phone = $row['cus_phone'];
    }
    
    if (isset($_POST['update_profile'])) {
        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);

        if (!empty($user) && !empty($email) && !empty($phone)) {
            $qry = mysqli_query($conn, "SELECT * FROM tbl_customers WHERE cus_name='$user' && cus_email='$email' && cus_phone='$phone' && id != '$customer_id'") or die(mysqli_error($conn));
            if (mysqli_num_rows($qry) > 0) {
                $msg = "Customer already exists";
                $msgClass = "danger";
            } else {
                mysqli_query($conn, "UPDATE tbl_customers SET cus_name='$user', cus_email='$email', cus_phone='$phone' WHERE cus_name='$username'") or die(mysqli_error($conn));
                $_SESSION['username'] = $user;
                $msg = "Profile Updated Successfully";
                $msgClass = "success";
            }

        } else {
            $msg = "Fill all the fields";
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
    <title>Restaurant || My Profile</title>
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
                <h1>Profiles</h1>
                <p><a href="<?php echo ROOT_URL2; ?>">Home</a> / My Profile</p>
            </div>
        </div>
        <!--/Banner-->

        <!--List Category-->
        <section class="listing">
            <div class="container">
                <div class="section-header mb-5">
                    <div class="header-text">
                        <h5>Manage My Profile</h5>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="menus">
                            <ul>
                                <li class="li_active"><a href="profile.php" class="active_link">My Profile</a></li>
                                <li><a href="my_testimonial.php">My Testimonial</a></li>
                                <li><a href="post_testimonial.php">Post Testimonial</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 mb-4">
                        <div class="frm">
                            <?php if ($msg != ""): ?>
                                <div class="alert text-center alert-<?php echo $msgClass; ?> mb-4"><?php echo $msg; ?></div>
                            <?php endif; ?>
                            <h5 class="mb-3 text-center text-danger"><i class="fas fa-user-edit"></i> Update profile</h5>
                            <form action="" method="post">
                                <div class="form-group mb-4" id="grp4">
                                    <label for="">Username</label>
                                    <input type="text" name="username" id="" placeholder="Username" value="<?php echo htmlentities($username); ?>">
                                </div>
                                <div class="form-group mb-4" id="grp4">
                                    <label for="">Email Address</label>
                                    <input type="email" name="email" id="" placeholder="email@gmail.com" value="<?php echo htmlentities($customer_email); ?>">
                                </div>
                                <div class="form-group mb-4" id="grp4">
                                    <label for="">Phone Number</label>
                                    <input type="tel" name="phone" id="" placeholder="07xxxxxxxx" value="<?php echo htmlentities($customer_phone); ?>">
                                </div>
                                <button type="submit" name="update_profile" class="btn btn-primary w-100">UPDATE</button>
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