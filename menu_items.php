<?php
    include 'admin/connection.php';
    session_start();

    $menu_id = $_GET['id'];
    $menu_name = "";
    $qry = mysqli_query($conn, "SELECT * FROM tbl_menu WHERE id='$menu_id'") or die(mysqli_error($conn));
    while ($row = mysqli_fetch_array($qry)) {
        $menu_name = $row['menu_name'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant || Menus Items</title>
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
                <h1>Menus</h1>
                <p><a href="<?php echo ROOT_URL2; ?>">Home</a> / Menu Items</p>
            </div>
        </div>
        <!--/Banner-->

        <!--List Category-->
        <section class="listing">
            <div class="container">
                <div class="section-header mb-5">
                    <div class="header-text">
                        <h5><?php echo htmlentities($menu_name); ?> Items List</h5>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <?php
                        $status = 1;
                        $qry = mysqli_query($conn, "SELECT * FROM tbl_item WHERE menu_id='$menu_id' && status='$status' ORDER BY id DESC") or die(mysqli_error($conn));
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
                                                <button class="btn btn-info btn-sm" onclick="openPopUp()"><i class="fas fa-plus"></i> Order</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!--Order Popup-->
                                    <div class="sec-popup" id="popupSec">
                                        <div class="close-btn2">
                                            <i class="fas fa-times-circle" onclick="closePopUp()"></i>
                                        </div>
                                        <div class="popup-link">
                                            <ul>
                                                <li><a href="add_cart.php?id=<?php echo htmlentities($menu_id); ?>&item_id=<?php echo htmlentities($item['id']); ?>">Order</a></li>
                                                <li><a href="#" id="lnk">Order for friend</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--Order Popup-->
                                    <div class="sec-popup" id="popupSec2">
                                        <div class="close-btn2">
                                            <i class="fas fa-times-circle" onclick="closePopUp()"></i>
                                        </div>
                                        <div class="popup-link">
                                            <form action="order_for_friend.php?id=<?php echo htmlentities($menu_id); ?>&item_id=<?php echo htmlentities($item['id']); ?>" method="post">
                                                <div class="form-group mb-4">
                                                    <input type="text" name="fname" class="form-control" placeholder="Friend Full Name">
                                                </div>
                                                <button type="submit" name="submit_order" class="btn btn-primary w-100">Order</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!--/Order Popup-->
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

        var popSec = document.getElementById('popupSec');
        var popSec2 = document.getElementById('popupSec2');
        function openPopUp() {
            popSec.classList.add('popupOn');
        }

        function closePopUp() {
            popSec.classList.remove('popupOn');
            popSec2.classList.remove('popupOn');
        }

        var link = document.getElementById('lnk');
        link.onclick = function () {
            popSec.classList.remove('popupOn');
            popSec2.classList.add('popupOn');
        }
    </script>
</body>
</html>