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
                <title>Restaurant || Manage Users</title>
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

                    if (isset($_REQUEST['del'])) {
                        $userid = $_REQUEST['del'];
                        mysqli_query($conn, "DELETE FROM tbl_user WHERE id='$userid'") or die(mysqli_error($conn));
                        $msg = "User Deleted successfully";
                        $msgClass = "danger";
                        $msgIcon = "exclamation-circle";
                    }

                    if (isset($_REQUEST['deact'])) {
                        $userid = $_REQUEST['deact'];
                        $status = 2;
                        mysqli_query($conn, "UPDATE tbl_user SET status='$status' WHERE id='$userid'") or die(mysqli_error($conn));
                        $msg = "User Deactivated";
                        $msgClass = "warning";
                        $msgIcon = "exclamation";
                    }

                    if (isset($_REQUEST['act'])) {
                        $userid = $_REQUEST['act'];
                        $status = 1;
                        mysqli_query($conn, "UPDATE tbl_user SET status='$status' WHERE id='$userid'") or die(mysqli_error($conn));
                        $msg = "User Activated";
                        $msgClass = "success";
                        $msgIcon = "check-double";
                    }
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
                                <p>View Users</p>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-4">
                            <div class="card-header">
                                <p>users info</p>
                                <div class="right-btns">
                                    <a href="add_user.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-plus"></i></a>
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

                                <?php
                                    $qry = mysqli_query($conn, "SELECT * FROM tbl_user ORDER BY id ASC") or die(mysqli_error($conn));
                                    if (mysqli_num_rows($qry) > 0) {
                                        ?>
                                            <div id="tbl">
                                                <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th><button class="column_sort" data-order="desc" id="username" title="click to sort"><span>Username</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th><button class="column_sort" data-order="desc" id="email" title="click to sort"><span>Email</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th><button class="column_sort" data-order="desc" id="phone" title="click to sort"><span>Phone</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th><button class="column_sort" data-order="desc" id="role" title="click to sort"><span>Role</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th><button class="column_sort" data-order="desc" id="status" title="click to sort"><span>Status</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th><button class="column_sort" data-order="desc" id="updatedate" title="click to sort"><span>Last Updated</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while ($user = mysqli_fetch_array($qry)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo htmlentities($user['username']); ?></td>
                                                                        <td><?php echo htmlentities($user['email']); ?></td>
                                                                        <td><?php echo htmlentities($user['phone']); ?></td>
                                                                        <td><?php echo htmlentities($user['role']); ?></td>
                                                                        <td>
                                                                            <?php if ($user['status'] == 1): ?>
                                                                                <span class="badge bg-success">Active</span>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-danger">Inactive</span>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($user['updatedate'] == NULL): ?>
                                                                                Not yet updated
                                                                            <?php else: ?>
                                                                                <?php echo htmlentities($user['updatedate']); ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="edit_user.php?id=<?php echo htmlentities($user['id']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                                                            <?php
                                                                                if ($user['status'] == 1) {
                                                                                    ?>
                                                                                        <a href="user.php?deact=<?php echo htmlentities($user['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Deactivate user')">Deactivate</a>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                        <a href="user.php?act=<?php echo htmlentities($user['id']); ?>" class="badge bg-primary"  onclick="return confirm('Confirm, Activate user')">Activate</a>
                                                                                    <?php
                                                                                }
                                                                                
                                                                            ?>
                                                                            <?php
                                                                                if ($user['email'] !== $_SESSION['useremail']) {
                                                                                    ?>
                                                                                        <a href="user.php?del=<?php echo htmlentities($user['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Delete user')"><i class="fas fa-trash-alt"></i></a>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php
                                    } else {
                                        echo "<div class='alert alert-info text-center'>No User Data</div>";
                                    }
                                    
                                ?>
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
                            var admincolumn = $(this).attr('id');
                            var order = $(this).data('order');
                            var icon;

                            if (order == 'desc') {
                                icon = "<i class='fas fa-sort-amount-down'></i>";
                            } else {
                                icon = "<i class='fas fa-sort-amount-down-alt'></i>";
                            }

                            $.ajax({
                                url: "ajax/sort.php",
                                method: "POST",
                                data: {admincolumn:admincolumn, order:order},
                                success:function (data) {
                                    $('#tbl').html(data);
                                    $('#'+admincolumn+' span:last-child').html(icon);
                                }
                            });
                        });

                        $(document).on('keyup', '.live_search', function () {
                            var search_admin = $(this).val();
                            
                            $.ajax({
                                url:"ajax/search.php",
                                method:"POST",
                                data:{search_admin:search_admin},
                                success:function (data) {
                                    $('#tbl').html(data);
                                }
                            });
                        });
                    });
                </script>
            </body>
            </html>
        <?php
    }
    
?>