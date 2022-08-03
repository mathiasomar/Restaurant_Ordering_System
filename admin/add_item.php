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
                <title>Restaurant || Add Food</title>
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

                    if (isset($_POST['add_item'])) {
                        $menu = mysqli_real_escape_string($conn, $_POST['menu']);
                        $itemname = mysqli_real_escape_string($conn, $_POST['itemname']);
                        $price = mysqli_real_escape_string($conn, $_POST['price']);
                        $type = mysqli_real_escape_string($conn, $_POST['type']);
                        $popular = mysqli_real_escape_string($conn, $_POST['popular']);
                        $itemimage = $_FILES['itemimage']['name'];
                        $desc = mysqli_real_escape_string($conn, $_POST['desc']);

                        if (!empty($menu) && !empty($itemname) && !empty($price) && !empty($type) && !empty($popular) && !empty($itemimage)) {
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_item WHERE menu_id='$menu' && item_name='$itemname' && item_type_id='$type'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "Item already exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                move_uploaded_file($_FILES['itemimage']['tmp_name'], "uploaded_images/".$itemimage);
                                $status = 1;
                                mysqli_query($conn, "INSERT INTO tbl_item VALUES(NULL, '$itemname', '$menu', '$price', '$type', '$itemimage', '$desc', '$status', '$popular')") or die(mysqli_error($conn));
                                $msg = "Item Added Successfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            }
                        } else {
                            $msg = "Fill in essentail fields";
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
                                <p>Add Item</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>form input</p>
                                        <div class="right-btns">
                                            <a href="item.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Menu Name <span class="text-danger">*</span></label>
                                                        <select name="menu" id="">
                                                            <option value="">Select Menu</option>
                                                            <?php
                                                                $qry = mysqli_query($conn, "SELECT id, menu_name FROM tbl_menu") or die(mysqli_error($conn));
                                                                while ($menu = mysqli_fetch_array($qry)) {
                                                                    ?>
                                                                        <option value="<?php echo htmlentities($menu['id']); ?>"><?php echo htmlentities($menu['menu_name']); ?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Item Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="itemname" id="" placeholder="Item Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Item Price <span class="text-danger">*</span></label>
                                                        <input type="text" name="price" id="" placeholder="Item Price in Ksh.">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Item Type <span class="text-danger">*</span></label>
                                                        <select name="type" id="">
                                                            <option value="">Select Type</option>
                                                            <?php
                                                                $qry = mysqli_query($conn, "SELECT id, item_type FROM tbl_item_type") or die(mysqli_error($conn));
                                                                while ($type = mysqli_fetch_array($qry)) {
                                                                    ?>
                                                                        <option value="<?php echo htmlentities($type['id']); ?>"><?php echo htmlentities($type['item_type']); ?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Is it popular item <span class="text-danger">*</span></label>
                                                        <select name="popular" id="">
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Item Image <span class="text-danger">*</span></label>
                                                        <input type="file" name="itemimage" id="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <label for="">Description</label>
                                                        <textarea name="desc" id="" rows="4" placeholder="Description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="add_item" class="btn btn-primary btn-sm">ADD</button>
                                            <button type="reset" class="btn btn-success  btn-sm">CLEAR</button>
                                        </form>
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
            </body>
            </html>
        <?php
    }
    
?>