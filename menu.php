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
    <title>Restaurant || Menus</title>
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
            <img src="admin/assets/images/banner2.jpg" alt="" class="image-responsive">
            <div class="banner_title">
                <h1>Menus</h1>
                <p><a href="<?php echo ROOT_URL2; ?>">Home</a> / Menus</p>
            </div>
        </div>
        <!--/Banner-->

        <!--List Category-->
        <section class="listing">
            <div class="container">
                <div class="section-header mb-5">
                    <div class="header-text">
                        <h5>Menus List</h5>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <?php
                    $status = 1;
                        $qry = mysqli_query($conn, "SELECT * FROM tbl_menu WHERE status='$status' ORDER BY id DESC") or die(mysqli_error($conn));
                        while ($menu = mysqli_fetch_array($qry)) {
                            ?>
                                <div class="col-md-3 mb-4">
                                    <div class="list-item">
                                        <img src="admin/uploaded_images/<?php echo htmlentities($menu['menu_image']); ?>" alt="" class="image-responsive">
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