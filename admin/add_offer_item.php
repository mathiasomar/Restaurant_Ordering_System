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
                <title>Restaurant || Add Offer Items</title>
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

                    $offer_id = $_GET['id'];

                    if (isset($_POST['add_offer_item'])) {
                        $menu = mysqli_real_escape_string($conn, $_POST['menu']);
                        $item = mysqli_real_escape_string($conn, $_POST['item']);
                        $qty = mysqli_real_escape_string($conn, $_POST['qty']);

                        if (!empty($menu) && !empty($item) && !empty($qty)) {
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_offer_items WHERE menu_id='$menu' && item_id='$item'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "Offer Item already exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                mysqli_query($conn, "INSERT INTO tbl_offer_items VALUES(NULL, '$offer_id', '$menu', '$item', '$qty', NULL)") or die(mysqli_error($conn));
                                $msg = "Offer Item Added Successfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            }
                            
                        } else {
                            $msg = "Fill all the fields";
                            $msgClass = "warning";
                            $msgIcon = "exclamation-circle";
                        }
                        
                    }

                    if (isset($_POST['del_offer_item'])) {
                        $menu = mysqli_real_escape_string($conn, $_POST['menu']);
                        $item = mysqli_real_escape_string($conn, $_POST['item']);
                        if (!empty($menu) && !empty($item)) {
                            mysqli_query($conn, "DELETE FROM tbl_offer_items WHERE menu_id='$menu' && item_id='$item'") or die(mysqli_error($conn));
                            $msg = "Item Offer Deleted";
                            $msgClass = "danger";
                            $msgIcon = "trash-alt";
                        } else {
                            $msg = "Select Menu or Item to delete the item";
                            $msgClass = "warning";
                            $msgIcon = "exclamation-circle";
                        }
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
                                <p>Add Offer Items</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>selected items</p>
                                        <div class="right-btns">
                                            <a href="offers.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-4 mb-4">
                                                        <label for="">Menu Name <span class="text-danger">*</span></label>
                                                        <select name="menu" id="menuid">
                                                            <option value="">select</option>
                                                            <?php
                                                                $qry = mysqli_query($conn, "SELECT * FROM tbl_menu") or die(mysqli_error($conn));
                                                                while ($menu = mysqli_fetch_array($qry)) {
                                                                    ?>
                                                                        <option value="<?php echo htmlentities($menu['id']); ?>"><?php echo htmlentities($menu['menu_name']); ?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-4" id="showitem">
                                                        <label for="">Item Name <span class="text-danger">*</span></label>
                                                        <select name="item" id="itemid" disabled>
                                                            <option value="">select menu to view items</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <label for="">Quantity <span class="text-danger">*</span></label>
                                                        <input type="text" name="qty" id="">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="add_offer_item" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                                            <button type="submit" name="del_offer_item" class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></button>
                                        </form>

                                        <table class="table table-responsive table-striped table-bordered table-hover text-center mt-5" id="tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Menu Name</th>
                                                    <th>Item Name</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $qry = mysqli_query($conn, "SELECT tbl_offer_items.*, tbl_menu.menu_name, tbl_item.item_name FROM tbl_offer_items JOIN tbl_menu ON tbl_menu.id=tbl_offer_items.menu_id JOIN tbl_item ON tbl_item.id=tbl_offer_items.item_id WHERE tbl_offer_items.offer_id='$offer_id'") or die(mysqli_error($conn));
                                                    $count = 1;
                                                    while ($row = mysqli_fetch_array($qry)) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count; ?></td>
                                                                <td><?php echo htmlentities($row['menu_name']); ?></td>
                                                                <td><?php echo htmlentities($row['item_name']); ?></td>
                                                                <td><?php echo htmlentities($row['quantity']); ?></td>
                                                            </tr>
                                                        <?php
                                                        $count += 1;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
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
                    $(document).ready(function () {
                        $(document).on('change', '#menuid', function () {
                            var id = $(this).val();
                            
                            $.ajax({
                                url:"ajax/view_item_on_menu_change.php",
                                method:"POST",
                                data:{id:id},
                                success:function (data){
                                    $('#showitem').html(data);
                                }
                            })
                        })
                    });
                </script>
            </body>
            </html>
        <?php
    }
    
?>