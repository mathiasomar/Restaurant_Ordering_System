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
    <title>Restaurant || Adds_on</title>
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
            <img src="admin/assets/images/banner3.jpg" alt="" class="image-responsive">
            <div class="banner_title">
                <h1>Addons</h1>
                <p><a href="<?php echo ROOT_URL2; ?>">Home</a> / Addons</p>
            </div>
        </div>
        <!--/Banner-->

        <!--List Category-->
        <section class="listing">
            <div class="container">
                <div class="section-header mb-5">
                    <div class="header-text">
                        <h5>Addons List</h5>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <?php
                        $qry = mysqli_query($conn, "SELECT * FROM tbl_addons ORDER BY id DESC") or die(mysqli_error($conn));
                        if (mysqli_num_rows($qry) > 0) {
                            while ($addon = mysqli_fetch_array($qry)) {
                                ?>
                                    <div class="col-md-3 mb-4">
                                        <div class="item_header">
                                            <h5><?php echo htmlentities($addon['addon_name']); ?></h5>
                                        </div>
                                        <div class="list-item">
                                            <img src="admin/uploaded_images/<?php echo htmlentities($addon['addon_image']); ?>" alt="" class="image-responsive">
                                            <div class="list-c">
                                                <button class="descbtn">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="list-desc">
                                                    <div class="list-desc-text">
                                                        <p><?php echo htmlentities($addon['description']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-heading2 mt-4">
                                            <?php if (isset($_SESSION['username'])): ?>
                                                <a href="menu_items.php?add=<?php echo htmlentities($addon['id']); ?>" class="btn btn-primary btn-sm extend"><i class="fas fa-add"></i> <span>add to cart</span></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php
                            }
                        } else {
                            ?>
                                <div class="alert alert-info text-center">No items on <?php echo htmlentities($menu_name); ?> Menu</div>
                                <a href="menu.php" class="btn btn-primary btn-sm">Back to Menus</a>
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