<?php
    session_start();

    if (strlen($_SESSION['useremail']) == 0) {
        header('Location:index.php');
    } else {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Restaurant || Viewing Order Details</title>
                <link rel="stylesheet" href="assets/css/all.min.css">
                <link rel="stylesheet" href="assets/css/bootstrap.min.css">
                <link rel="stylesheet" href="assets/css/fontawesome.min.css">
                <link rel="stylesheet" href="assets/css/style.css">
                <link rel="icon" href="assets/images/restaurant.svg">
            </head>
            <body>
                <!--Sidebar-->
                <?php include 'inc/sidebar.php'; ?>
                <!--/Sidebar-->

                <!--Navbar-->
                <?php include 'inc/navbar.php'; ?>
                <!--/Navbar-->

                <!--Logout-->
                <?php include 'inc/logout.php'; ?>
                <!--/Logout-->

                <!--Small Mode Icon-->
                <?php include 'inc/icon.php'; ?>
                <!--/Small Mode Icon-->

                <?php
                    $order_id = $_GET['id'];

                    $order_no = "";
                    $order_date = "";
                    $order_status = "";
                    $cus_name = "";
                    $cus_phone = "";
                    $item_name = "";
                    $item_cost = "";

                    $qry = mysqli_query($conn, "SELECT tbl_orders.*, tbl_customers.cus_name, tbl_customers.cus_phone, tbl_item.item_name, tbl_item.item_cost FROM tbl_orders JOIN tbl_customers ON tbl_orders.customer=tbl_customers.id JOIN tbl_item ON tbl_orders.order_item=tbl_item.id WHERE tbl_orders.id='$order_id'") or die(mysqli_error($conn));
                    while ($order = mysqli_fetch_array($qry)) {
                        $order_no = $order['order_no'];
                        $order_date = $order['order_date'];
                        $order_status = $order['status'];
                        $cus_name = $order['cus_name'];
                        $cus_phone = $order['cus_phone'];
                        $item_name = $order['item_name'];
                        $item_cost = $order['item_cost'];
                    }
                ?>

                <!--Main Section-->
                <main>
                    <div class="container-fluid">
                        <div class="section-header">
                            <div class="headers">
                                <p><a href="dashboard.html"><i class="fas fa-home"></i>Home</a> </p>
                                <p>/</p>
                                <p>View Order</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>selected order</p>
                                        <div class="right-btns">
                                            <a href="orders.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Order No:</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo htmlentities($order_no); ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Order Date:</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo htmlentities($order_date); ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Order Item:</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo htmlentities($item_name); ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Item Cost:</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>Ksh. <?php echo htmlentities($item_cost); ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Status:</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>
                                                            <?php if ($order_status == 1): ?>
                                                                <span class="text-warning">Pending</span>
                                                            <?php elseif ($order_status == 2): ?>
                                                                <span class="text-primary">Confirmed</span>
                                                            <?php else: ?>
                                                                <span class="text-success">Paid</span>
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Customer Name:</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>Omar Mathias</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Phone:</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>0745711298</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr>

                                        <form action="" class="prntFun">
                                            <button type="submit" class="btn btn-primary btn-sm" onclick="funPrint()"><i class="fas fa-print"></i> Print</button>
                                        </form>

                                        <!--<div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="c-header">
                                                    <h5>Order Item</h5>
                                                </div>
                                                <table class="table table-striped table-bordered table-hover text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Item Name</th>
                                                            <th>Option</th>
                                                            <th>Item Cost</th>
                                                            <th>Item Quantity</th>
                                                            <th>Total Cost</th>
                                                        </tr>
                                                    </thead>
                                                </table>

                                                
                                            </div>

                                            <div class="col-md-12">
                                                <div class="c-header">
                                                    <h5>Order Offers</h5>
                                                </div>
                                                <table class="table table-striped table-bordered table-hover text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Offer Name</th>
                                                            <th>OfferCost</th>
                                                            <th>Offer Quantity</th>
                                                            <th>Total Cost</th>
                                                            <th>No of Products</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!--/Main Section-->

                <script src="assets/js/bootstrap.min.js"></script>
                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/js/main.js"></script>
                <script>
                    function funPrint () {
                        window.print();
                    }
                </script>
            </body>
            </html>
        <?php
    }
    
?>