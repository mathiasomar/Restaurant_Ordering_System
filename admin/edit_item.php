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
                <title>Restaurant || Edit Item</title>
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

                    $id = $_GET['id'];

                    if (isset($_POST['update_item'])) {
                        $menu = mysqli_real_escape_string($conn, $_POST['menu']);
                        $itemname = mysqli_real_escape_string($conn, $_POST['itemname']);
                        $price = mysqli_real_escape_string($conn, $_POST['price']);
                        $type = mysqli_real_escape_string($conn, $_POST['type']);
                        $popular = mysqli_real_escape_string($conn, $_POST['popular']);
                        $desc = mysqli_real_escape_string($conn, $_POST['desc']);

                        if (!empty($menu) && !empty($itemname) && !empty($price) && !empty($type) && !empty($popular)) {
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_item WHERE (item_name='$itemname' && menu_id='$menu' && item_cost='$price') && id != '$id'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "The item already exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                mysqli_query($conn, "UPDATE tbl_item SET item_name='$itemname', menu_id='$menu', item_cost='$price', item_type_id='$type', is_most_selling_item='$popular', description='$desc' WHERE id='$id'") or die(mysqli_error($conn));
                                $msg = "Item Details Updated Successfully";
                                $msgClass = "success";      
                                $msgIcon = "check-double";
                            }
                            
                        } else {
                            $msg = "Fill the esential fields";
                            $msgClass = "warning";
                            $msgIcon = "exclamation-circle";
                        }
                    }

                    if (isset($_POST['update_item_image'])) {
                        $image = $_FILES['fimage']['name'];

                        if (!empty($image)) {
                            $qry = mysqli_query($conn, "SELECT item_image FROM tbl_item WHERE item_image='$image' && id != '$id'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "The image selected exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                move_uploaded_file($_FILES['fimage']['tmp_name'], "uploaded_images/".$image);
                                mysqli_query($conn, "UPDATE tbl_item SET item_image='$image' WHERE id='$id'");
                                $msg = "Item Image Updated Successfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            }
                            
                        } else {
                            $msg = "Please select an image";
                            $msgClass = "danger";
                            $msgIcon = "exclamation-triangle";
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
                                <p>Edit Item</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>selected item</p>
                                        <div class="right-btns">
                                            <a href="item.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <?php
                                                $menu_name = "";
                                                $item_name = "";
                                                $item_cost = "";
                                                $item_type = "";
                                                $item_image ="";
                                                $item_desc = "";
                                                $popular = "";

                                                $qry = mysqli_query($conn, "SELECT tbl_menu.menu_name, tbl_item_type.item_type, tbl_item.* FROM tbl_item JOIN tbl_menu ON tbl_menu.id=tbl_item.menu_id JOIN tbl_item_type ON tbl_item_type.id=tbl_item.item_type_id WHERE tbl_item.id='$id'") or die(mysqli_error($conn));
                                                while ($row = mysqli_fetch_array($qry)) {
                                                    $menu_name = $row['menu_name'];
                                                    $item_name = $row['item_name'];
                                                    $item_cost = $row['item_cost'];
                                                    $item_type = $row['item_type'];
                                                    $item_image = $row['item_image'];
                                                    $item_desc = $row['description'];
                                                    $popular = $row['is_most_selling_item'];
                                                }
                                                
                                            ?>
                                            <div class="col-md-8 mb-4">
                                            <form action="" method="post">
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
                                                                            <option value="<?php echo htmlentities($menu['id']); ?>" <?php if ($menu_name == $menu['menu_name']) { echo "selected"; } ?>><?php echo htmlentities($menu['menu_name']); ?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <label for="">Item Name <span class="text-danger">*</span></label>
                                                            <input type="text" name="itemname" id="" placeholder="Item Name" value="<?php echo htmlentities($item_name); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="grp">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-4">
                                                            <label for="">Item Price <span class="text-danger">*</span></label>
                                                            <input type="text" name="price" id="" placeholder="Item Price in Ksh." value="<?php echo htmlentities($item_cost); ?>">
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <label for="">Item Type <span class="text-danger">*</span></label>
                                                            <select name="type" id="">
                                                                <option value="">Select Type</option>
                                                                <?php
                                                                    $qry = mysqli_query($conn, "SELECT id, item_type FROM tbl_item_type") or die(mysqli_error($conn));
                                                                    while ($type = mysqli_fetch_array($qry)) {
                                                                        ?>
                                                                            <option value="<?php echo htmlentities($type['id']); ?>" <?php if ($item_type == $type['item_type']) { echo "selected"; } ?>><?php echo htmlentities($type['item_type']); ?></option>
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
                                                                <option <?php if ($popular == 'Yes') { echo "selected"; } ?>>Yes</option>
                                                                <option <?php if ($popular == 'No') { echo "selected"; } ?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="grp">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <label for="">Description</label>
                                                            <textarea name="desc" id="" rows="4" placeholder="Description">
                                                                <?php echo htmlentities($item_desc); ?>
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" name="update_item" class="btn btn-primary btn-sm">UPDATE</button>
                                                <button type="reset" class="btn btn-success  btn-sm">CLEAR</button>
                                            </form>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <p>Change Menu Image &nbsp;<i class="fas fa-image"></i></p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="f-image">
                                                            <div class="image-container">
                                                                <img src="uploaded_images/<?php echo htmlentities($item_image); ?>" alt="" class="image-responsive">
                                                            </div>
                                                        </div>
                            
                                                        <div class="frm mt-4">
                                                            <form action="" method="post" enctype="multipart/form-data">
                                                                <div class="form-group mb-4">
                                                                    <input type="file" name="fimage" id="" class="form-control">
                                                                </div>
                                                                <button type="submit" name="update_item_image" class="btn btn-primary btn-sm">UPDATE IMAGE</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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