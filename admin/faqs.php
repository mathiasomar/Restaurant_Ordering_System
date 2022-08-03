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
                <title>Restaurant || Manage FAQs</title>
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
                        $f_id = $_REQUEST['deact'];
                        $status = 2;

                        mysqli_query($conn, "UPDATE tbl_faqs SET status='$status' WHERE id='$f_id'") or die(mysqli_error($conn));
                        $msg = "Faqs Deactivated";
                        $msgClass = "danger";
                        $msgIcon = "exclamation-circle";
                    }

                    if (isset($_REQUEST['act'])) {
                        $f_id = $_REQUEST['act'];
                        $status = 1;

                        mysqli_query($conn, "UPDATE tbl_faqs SET status='$status' WHERE id='$f_id'") or die(mysqli_error($conn));
                        $msg = "Faqs Activated";
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
                                <p>View FAQs</p>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-4">
                            <div class="card-header">
                                <p>FAQs info</p>
                                <div class="right-btns">
                                    <a href="add_faqs.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-plus"></i></a>
                                </div>
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
                                        $qry = mysqli_query($conn, "SELECT tbl_faqs.*, tbl_faqs_category.category FROM tbl_faqs JOIN tbl_faqs_category ON tbl_faqs.category=tbl_faqs_category.id") or die(mysqli_error($conn));
                                        if (mysqli_num_rows($qry) > 0) {
                                            ?>
                                                <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th><button class="column_sort" data-order="desc" id="tbl_faqs_category.category" title="click to sort"><span>Category</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th>Question</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while ($faqs = mysqli_fetch_array($qry)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo htmlentities($faqs['category']); ?></td>
                                                                        <td><?php echo htmlentities($faqs['question']); ?></td>
                                                                        <td>
                                                                            <?php if ($faqs['status'] == 1): ?>
                                                                                <span class="badge bg-success">Active</span>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-danger">Inactive</span>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="edit_faqs.php?id=<?php echo htmlentities($faqs['id']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                                                            <!--<a href="faqs.php?del=<?php //echo htmlentities($faqs['category']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Delete Faqs')"><i class="fas fa-trash-alt"></i></a>-->
                                                                            <?php if ($faqs['status'] == 1): ?>
                                                                            <a href="faqs.php?deact=<?php echo htmlentities($faqs['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Deactivate Faqs')">Deactivate</a>
                                                                            <?php else: ?>
                                                                                <a href="faqs.php?act=<?php echo htmlentities($faqs['id']); ?>" class="badge bg-primary" onclick="return confirm('Confirm, Activate Faqs')">Activate</a>
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
                            var faqs_column = $(this).attr('id');
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
                                data:{faqs_column:faqs_column, order:order},
                                success:function (data) {
                                    $('#tbl').html(data);
                                    $('#'+faqs_column+' span:last-child').html(icon);
                                }
                            })
                        });

                        $(document).on('keyup', '.live_search', function (){
                            var search_faqs = $(this).val();
                            
                            $.ajax({
                                url:"ajax/search.php",
                                method:"POST",
                                data:{search_faqs:search_faqs},
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