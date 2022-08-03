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
                <title>Restaurant || Orders</title>
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

                <!--Main Section-->
                <main>
                    <div class="container-fluid">
                        <div class="section-header">
                            <div class="headers">
                                <p><a href="<?php echo ROOT_URL; ?>"><i class="fas fa-home"></i>Home</a> </p>
                                <p>/</p>
                                <p>View Orders</p>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-4">
                            <div class="card-header">
                                <p>orders info</p>
                            </div>
                            <div class="card-body">
                                <div class="filter-section mt-3">
                                    <div class="entry-section">
                                        <span>Show</span>
                                        <form action="">
                                            <select name="entry" id="sec">
                                                <option>5</option>
                                                <option>10</option>
                                                <option>25</option>
                                                <option>50</option>
                                                <option>100</option>
                                            </select>
                                        </form>
                                        <span>Entry</span>
                                    </div>
                                    <div class="search-section">
                                        <form action="">
                                            <div class="form-group" id="grp">
                                                <input type="search" name="search" class="live_search" placeholder="search.....">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                    
                                <hr>
                    
                                <div id="tbl">
                                    <?php
                                        $qry = mysqli_query($conn, "SELECT tbl_orders.*, tbl_customers.cus_name, tbl_customers.cus_phone, tbl_item.item_name, tbl_item.item_cost FROM tbl_orders JOIN tbl_customers ON tbl_orders.customer=tbl_customers.id JOIN tbl_item ON tbl_orders.order_item=tbl_item.id") or die(mysqli_error($conn));
                                        if (mysqli_num_rows($qry) > 0) {
                                            ?>
                                                <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th>S No</th>
                                                            <th><button class="column_sort" data-order="desc" id="order_no" title="click to sort"><span>Order No</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th><button class="column_sort" data-order="desc" id="order_date" title="click to sort"><span>Order Date</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th><button class="column_sort" data-order="desc" id="order_time" title="click to sort"><span>Order Time</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th><button class="column_sort" data-order="desc" id="item_name" title="click to sort"><span>Order Item</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th>Order Cost</th>
                                                            <th><button class="column_sort" data-order="desc" id="cus_name" title="click to sort"><span>Customer Name</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th><button class="column_sort" data-order="desc" id="order_for" title="click to sort"><span>Order For</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $sr = 1;
                                                            while ($order = mysqli_fetch_array($qry)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo htmlentities($sr); ?></td>
                                                                        <td><?php echo htmlentities($order['order_no']); ?></td>
                                                                        <td><?php echo htmlentities($order['order_date']); ?></td>
                                                                        <td><?php echo htmlentities($order['order_time']); ?></td>
                                                                        <td><?php echo htmlentities($order['item_name']); ?></td>
                                                                        <td>Ksh. <?php echo htmlentities($order['item_cost']); ?></td>
                                                                        <td><?php echo htmlentities($order['cus_name']); ?></td>
                                                                        <td><?php echo htmlentities($order['order_for']); ?></td>
                                                                        <td>
                                                                            <?php if ($order['status'] == 1): ?>
                                                                                <span class="badge bg-warning">Pending</span>
                                                                            <?php elseif ($order['status'] == 2): ?>
                                                                                <span class="badge bg-primary">Confirmed</span>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-success">Paid</span>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="view_order.php?id=<?php echo htmlentities($order['id']); ?>" class="badge bg-primary"><i class="fas fa-eye"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                $sr += 1;
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            <?php
                                        } else {
                                            ?>
                                                <div class="alert alert-info text-center">No Data</div>
                                            <?php
                                        }
                                        
                                    ?>
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
                    $(document).ready(function () {
                        $(document).on('click', '.column_sort', function () {
                            var order_column = $(this).attr('id');
                            var order = $(this).data('order');
                            var icon;

                            if (order == 'desc') {
                                icon = "<i class='fas fa-sort-amount-down'></i>";
                            } else {
                                icon = "<i class='fas fa-sort-amount-down-alt'></i>";
                            }

                            $.ajax({
                                url:"ajax/sort.php",
                                method:"POST",
                                data:{order_column:order_column, order:order},
                                success:function (data) {
                                    $('#tbl').html(data);
                                    $('#'+order_column+' span:last-child').html(icon);
                                }
                            })
                        });

                        $(document).on('keyup', '.live_search', function (){
                            var search_order = $(this).val();
                            
                            $.ajax({
                                url:"ajax/search.php",
                                method:"POST",
                                data:{search_order:search_order},
                                success:function (data) {
                                    $('#tbl').html(data);
                                }
                            })
                        });
                    });
                </script>
            </body>
            </html>
        <?php
    }
    
?>