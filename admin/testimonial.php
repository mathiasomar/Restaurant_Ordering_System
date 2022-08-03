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
                <title>Restaurant || Manage Testimonial</title>
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
                    $msg = "";
                    $msgClass = "";
                    $msgIcon = "";

                    if (isset($_REQUEST['deact'])) {
                        $test_id = $_REQUEST['deact'];
                        $status = 2;

                        mysqli_query($conn, "UPDATE tbl_testimonial SET status='$status' WHERE id='$test_id'") or die(mysqli_error($conn));
                        $msg = "Testimonial Deactivated";
                        $msgClass = "danger";
                        $msgIcon = "exclamation-circle";
                    }

                    if (isset($_REQUEST['act'])) {
                        $test_id = $_REQUEST['act'];
                        $status = 1;

                        mysqli_query($conn, "UPDATE tbl_testimonial SET status='$status' WHERE id='$test_id'") or die(mysqli_error($conn));
                        $msg = "Testimonial Activated";
                        $msgClass = "success";
                        $msgIcon = "check-double";
                    }

                    /*if (isset($_REQUEST['del'])) {
                        $f_id = $_REQUEST['del'];

                        mysqli_query($conn, "DELETE FROM tbl_faqs WHERE id='$f_id'") or die(mysqli_error($conn));
                        $msg = "Faqs Deleted";
                        $msgClass = "danger";
                        $msgIcon = "exclamation-triangle";
                    }*/
                ?>

                <!--Alert-->
                <?php if ($msg != ""): ?>
                <div class="pop-alert" id="popAlert">
                    <span class="text-<?php echo htmlentities($msgClass); ?>"><i class="fas fa-<?php echo htmlentities($msgIcon); ?>"></i> <?php echo htmlentities($msg); ?></span>
                </div>
                <?php include 'inc/alertjs.php'; ?>
                <?php endif; ?>
                <!--/Alert-->

                <!--Main Section-->
                <main>
                    <div class="container-fluid">
                        <div class="section-header">
                            <div class="headers">
                                <p><a href="<?php echo ROOT_URL; ?>"><i class="fas fa-home"></i>Home</a> </p>
                                <p>/</p>
                                <p>View Testimonial</p>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-4">
                            <div class="card-header">
                                <p>Testimonial info</p>
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
                                        $qry = mysqli_query($conn, "SELECT tbl_testimonial.*, tbl_customers.cus_name FROM tbl_testimonial JOIN tbl_customers ON tbl_testimonial.customer_id=tbl_customers.id ORDER BY id asc") or die(mysqli_error($conn));
                                        if (mysqli_num_rows($qry) > 0) {
                                            ?>
                                                <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th><button class="column_sort" data-order="desc" id="cus_name" title="click to sort"><span>Customer</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th><button class="column_sort" data-order="desc" id="testimonial" title="click to sort"><span>Testimonial</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while ($test = mysqli_fetch_array($qry)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo htmlentities($test['cus_name']); ?></td>
                                                                        <td><?php echo htmlentities($test['testimonial']); ?></td>
                                                                        <td>
                                                                            <?php if ($test['status'] == 1): ?>
                                                                                <span class="badge bg-success">Active</span>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-danger">Inactive</span>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($test['status'] == 1): ?>
                                                                            <a href="testimonial.php?deact=<?php echo htmlentities($test['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Deactivate Testimonial')">Deactivate</a>
                                                                            <?php else: ?>
                                                                                <a href="testimonial.php?act=<?php echo htmlentities($test['id']); ?>" class="badge bg-primary" onclick="return confirm('Confirm, Activate Testimonial')">Activate</a>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
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
                            var test_column = $(this).attr('id');
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
                                data:{test_column:test_column, order:order},
                                success:function (data) {
                                    $('#tbl').html(data);
                                    $('#'+test_column+' span:last-child').html(icon);
                                }
                            })
                        });

                        $(document).on('keyup', '.live_search', function (){
                            var search_test = $(this).val();
                            
                            $.ajax({
                                url:"ajax/search.php",
                                method:"POST",
                                data:{search_test:search_test},
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