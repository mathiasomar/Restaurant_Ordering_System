<?php
    include 'admin/connection.php';
    session_start();

    $msg = "";
    $msgClass = "";

    if (isset($_POST['send_msg'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $message = mysqli_real_escape_string($conn, $_POST['msg']);

        if (!empty($email) && !empty($phone) && !empty($message)) {
            $status = 1;
            mysqli_query($conn, "INSERT INTO tbl_contactus_query VALUES(NULL, '$email', '$phone', '$message', '$status', NULL)") or die(mysqli_error($conn));
            $msg = "Message sent successfully";
            $msgClass = "success";
        } else {
            $msg = "fill all the fields";
            $msgClass = "danger";
        }
        
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant || Contact Us</title>
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
            <img src="admin/assets/images/fbg.jpg" alt="" class="image-responsive">
            <div class="banner_title">
                <h1>Contact Us</h1>
                <p><a href="<?php echo ROOT_URL2; ?>">Home</a> / Contact Us</p>
            </div>
        </div>
        <!--/Banner-->

        <!--Pages Info-->
        <section class="pages_info">
            <div class="container">
            <div class="section-header mb-5">
                    <div class="header-text">
                        <h5>Contact Us</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-sm-12 mb-4">
                        <div class="frm">
                            <?php if ($msg != ""): ?>
                                <p class="text-center text-<?php echo $msgClass; ?>">
                                    <?php echo $msg; ?>
                                </p>
                            <?php endif; ?>
                            <div class="well text-center">
                                <h6>Send as direct message</h6>
                            </div>
                            <form action="" method="post">
                                <div class="form-group mb-4" id="grp4">
                                    <label for="">Email Address</label>
                                    <input type="email" name="email" id="" placeholder="someone@gmail.com">
                                </div>
                                <div class="form-group mb-4" id="grp4">
                                    <label for="">Phone Number</label>
                                    <input type="number" name="phone" id="" placeholder="07xxxxxxxx">
                                </div>
                                <div class="form-group mb-4" id="grp4">
                                    <label for="">Message</label>
                                    <textarea name="msg" id="" rows="4" placeholder="Message"></textarea>
                                </div>
                                <button type="submit" name="send_msg" class="btn btn-primary w-100">Send <i class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="well text-center">
                            <h6>You can also contact us through</h6>
                        </div>
                        <ul class="cnt">
                            <?php
                                $rest_email = "";
                                $rest_call = "";
                                $rest_ig = "";
                                $rest_whatsapp = "";
                                $qry = mysqli_query($conn, "SELECT * FROM tbl_contactus_info") or die(mysqli_error($conn));
                                while ($contact = mysqli_fetch_array($qry)) {
                                    $rest_email = $contact['email'];
                                    $rest_call = $contact['call_number'];
                                    $rest_ig = $contact['instagram'];
                                    $rest_whatsapp = $contact['whatsapp'];
                                }
                            ?>
                            <li>
                                <a href="mailto:<?php echo htmlentities($rest_email); ?>"><span class="fas fa-envelope"></span><span><?php echo htmlentities($rest_email); ?></span></a>
                            </li>
                            <li>
                                <a href="tel:<?php echo htmlentities($rest_call); ?>"><span class="fas fa-phone"></span><span><?php echo htmlentities($rest_call); ?></span></a>
                            </li>
                            <li>
                                <a href="https://instagram.com/<?php echo htmlentities($rest_ig); ?>"><span class="fab fa-instagram"></span><span><?php echo htmlentities($rest_ig); ?></span></a>
                            </li>
                            <li>
                                <a href="https://whatsapp.com/dl/<?php echo htmlentities($rest_whatsapp); ?>"><span class="fab fa-whatsapp"></span><span><?php echo htmlentities($rest_whatsapp); ?></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--/Pages Info-->

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