<?php
    include 'admin/connection.php';
    session_start();

    $search_result = $_POST['search'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant || Search Results</title>
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
                <h1>Search result for "<?php echo $search_result; ?>"</h1>
            </div>
        </div>
        <!--/Banner-->

        <!--Search Section-->
        <?php include 'inc/search_section.php'; ?>
        <!--/Search Section-->

        <!--List Category-->
        <section class="listing">
            <div class="container">
                <div class="row justify-content-center">
                    <?php
                        $status = 1;
                        $qry = mysqli_query($conn, "SELECT tbl_item.*, tbl_menu.menu_name FROM tbl_item JOIN tbl_menu ON tbl_item.menu_id=tbl_menu.id WHERE tbl_item.item_name LIKE '%$search_result%' || tbl_menu.menu_name LIKE '%$search_result%'") or die(mysqli_error($conn));
                        if (mysqli_num_rows($qry) > 0) {
                            while ($item = mysqli_fetch_array($qry)) {
                                ?>
                                    <div class="col-md-3 mb-4">
                                        <div class="item_header">
                                            <h5><?php echo htmlentities($item['item_name']); ?></h5>
                                        </div>
                                        <div class="list-item">
                                            <img src="admin/uploaded_images/<?php echo htmlentities($item['item_image']); ?>" alt="" class="image-responsive">
                                            <div class="list-c">
                                                <button class="descbtn">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="list-desc">
                                                    <div class="list-desc-text">
                                                        <p><?php echo htmlentities($item['description']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-heading2 mt-4">
                                            <?php if (isset($_SESSION['username'])): ?>
                                                <!--<a href="order.php?item_id=<?php echo htmlentities($item['id']); ?>" class="btn btn-success btn-sm extend"><i class="fas fa-shopping-basket"></i> <span>Order</span></a>-->
                                                <a href="add_cart.php?id=<?php echo htmlentities($menu_id); ?>&item_id=<?php echo htmlentities($item['id']); ?>" class="btn btn-success btn-sm extend"><i class="fas fa-plus"></i> <span>Add cart</span></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php
                            }
                        } else {
                            ?>
                                <div class="alert alert-info text-center">No search result for <?php echo htmlentities($search_result); ?> Menu</div>
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