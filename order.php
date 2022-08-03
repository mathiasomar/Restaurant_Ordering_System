<?php
    include 'admin/connection.php';
    session_start();

    $username = $_SESSION['username'];
    $customer_id = "";
    $customer_phone = "";
    $qry = mysqli_query($conn, "SELECT * FROM tbl_customers WHERE cus_name='$username'");
    while ($row = mysqli_fetch_array($qry)) {
        $customer_id = $row['id'];
        $customer_phone = $row['cus_phone'];
    }

    if (isset($_REQUEST['con'])) {
        $order_id = $_REQUEST['con'];
        $status = 2;
        mysqli_query($conn, "UPDATE tbl_orders SET status='$status' WHERE id='$order_id' && customer='$customer_id'") or die(mysqli_error($conn));
        header('Location:order.php');
    }

    if (isset($_REQUEST['rem'])) {
        $order_id = $_REQUEST['rem'];
        $status = 1;
        mysqli_query($conn, "UPDATE tbl_orders SET status='$status' WHERE id='$order_id' && customer='$customer_id'") or die(mysqli_error($conn));
        header('Location:order.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant || Orders Items</title>
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
                <h1>Orders</h1>
                <p><a href="<?php echo ROOT_URL2; ?>">Home</a> / Order Items</p>
            </div>
        </div>
        <!--/Banner-->

        <!--List Category-->
        <section class="listing">
            <div class="container">
                <div class="section-header mb-5">
                    <div class="header-text">
                        <h5>Items ordered List</h5>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <?php
                        $total_amount = "";
                        $qry = mysqli_query($conn, "SELECT tbl_orders.*, tbl_item.item_name, tbl_item.item_cost, tbl_item.item_image FROM tbl_orders JOIN tbl_item ON tbl_orders.order_item=tbl_item.id WHERE tbl_orders.customer='$customer_id'") or die(mysqli_error($conn));
                        if (mysqli_num_rows($qry) > 0) {
                            while ($order = mysqli_fetch_array($qry)) {
                                ?>
                                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                        <div class="item_img_c">
                                            <img src="admin/uploaded_images/<?php echo htmlentities($order['item_image']); ?>" class="image-responsive" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                        <div class="item_info_c">
                                            <ul>
                                                <li><strong>Order No:- </strong><?php echo htmlentities($order['order_no']); ?></li>
                                                <li><strong>Item:- </strong><?php echo htmlentities($order['item_name']); ?></li>
                                                <li><strong>Price:- </strong><?php echo htmlentities($order['item_cost']); ?></li>
                                                <li><strong>Ordered On:- </strong><?php echo htmlentities($order['order_date']); ?></li>
                                                <li><strong>Status: </strong>
                                                    <?php if($order['status'] == 1): ?>
                                                        <span class="text-warning">Pending</span>
                                                    <?php elseif($order['status'] == 2): ?>
                                                        <span class="text-success">Confirmed</span>
                                                    <?php else: ?>
                                                        <span class="text-primary">Paid</span>
                                                    <?php endif; ?>
                                                </li>
                                                <li><strong>Order For:- </strong><?php echo htmlentities($order['order_for']); ?></li>
                                            </ul>
                                            <div class="conf_btn mt-4">
                                                <?php if($order['status'] == 1): ?>
                                                    <a href="order.php?con=<?php echo htmlentities($order['id']); ?>" class="btn btn-info btn-sm">Confirm</a>
                                                <?php elseif ($order['status'] == 2): ?>
                                                    <a href="order.php?rem=<?php echo htmlentities($order['id']); ?>" class="btn btn-danger btn-sm">Remove</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                            $status = 2;
                            $qry = mysqli_query($conn, "SELECT tbl_orders.*, SUM(tbl_item.item_cost) AS amount FROM tbl_orders JOIN tbl_item ON tbl_orders.order_item=tbl_item.id WHERE tbl_orders.customer='$customer_id' && tbl_orders.status='$status'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($qry)) {
                                $total_amount = $row['amount'];
                            }
                            ?>
                                <table class="table table-bordered table-stripped">
                                    <tr>
                                        <th colspan="2" class="text-center">Invoice</th>
                                    </tr>
                                    <tr>
                                        <th>Total Cost</th>
                                        <td><?php echo $total_amount; ?></td>
                                    </tr>
                                </table>
                            <?php
                            if (mysqli_num_rows($qry) > 0) {
                                ?>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="fr_container mb-4">
                                                <h4 class="text-success mt-5 mb-4">Lipa na Mpesa <i class="fas fa-money-bill-alt"></i></h4>
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <label for="">Mpesa Phone Number</label>
                                                        <input type="number" name="phone_number" id="" class="form-control mb-3" placeholder="254xxxxxxxxx">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Amount</label>
                                                        <input type="text" name="amount" id="" class="form-control mb-3" value="<?php echo $total_amount; ?>" readonly>
                                                    </div>
                                                    <button type="submit" name="pay" class="btn btn-primary btn-sm mb-4 w-100">PAY <i class="fas fa-check-double"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                            
                        } else {
                            ?>
                                <div class="alert alert-warning text-center">No Orders</div>
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