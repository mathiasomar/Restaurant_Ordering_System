<?php
    include 'admin/connection.php';
    session_start();

    $type = $_GET['type'];
    $text = "";
    $page_name = "";
    $qry = mysqli_query($conn, "SELECT * FROM tbl_page WHERE type='$type'") or die(mysqli_error($conn));
    while ($row = mysqli_fetch_array($qry)) {
        $text = $row['text'];
        $page_name = $row['page_name'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant || Page</title>
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
            <img src="admin/assets/images/fc-bg.jpg" alt="" class="image-responsive">
            <div class="banner_title">
                <h1>Pages</h1>
                <p><a href="<?php echo ROOT_URL2; ?>">Home</a> / <?php echo htmlentities($page_name); ?></p>
            </div>
        </div>
        <!--/Banner-->

        <!--Pages Info-->
        <section class="pages_info">
            <div class="container">
            <div class="section-header mb-5">
                    <div class="header-text">
                        <h5><?php echo htmlentities($page_name); ?></h5>
                    </div>
                </div>
                <div class="panel mb-5">
                    <div class="panel-body text-center">
                        <blockquote>
                            <?php echo htmlentities($text); ?>
                        </blockquote>
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