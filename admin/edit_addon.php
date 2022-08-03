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
                <title>Restaurant || Edit Add-ons</title>
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

                    if (isset($_POST['update_addon'])) {
                        $aname = mysqli_real_escape_string($conn, $_POST['name']);
                        $aprice = mysqli_real_escape_string($conn, $_POST['price']);
                        $adesc = mysqli_real_escape_string($conn, $_POST['desc']);
                        
                        if (!empty($aname) && !empty($aprice)) {
                            $qry = mysqli_query($conn, "UPDATE tbl_addons SET addon_name='$aname', price='$aprice', description='$adesc' WHERE id='$id'")
                            $msg = "Addon Updated Successfully";
                            $msgClass = "success";
                            $msgIcon = "check-double";
                        } else {
                            $msg = "Addon Name and Price must not be Null";
                            $msgClass = "warning";
                            $msgIcon = "exclamation-circle";
                        }
                        
                    }

                    if (isset($_POST['update_image'])) {
                        $aimg = $_FILES['fimage']['name'];

                        if (!empty($aimg)) {
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_addons WHERE addon_image='$aimg' && id != '$id'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "Image already Taken";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                move_uploaded_file($_FILES['fimage']['tmp_name'], "uploaded_images/".$aimg);
                                mysqli_query($conn, "UPDATE tbl_addons SET addon_image='$aimg' WHERE id='$id'") or die(mysqli_error($conn));
                                $msg = "Addon Image Updated Successfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            }
                            
                        } else {
                            $msg = "No image selected";
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
                                <p>Edit Add-ons</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>selected addon</p>
                                        <div class="right-btns">
                                            <a href="addons.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <?php
                                                $aname = "";
                                                $aprice = "";
                                                $adesc = "";
                                                $aimg = "";

                                                $qry = mysqli_query($conn, "SELECT * FROM tbl_addons WHERE id='$id'") or die(mysqli_error($conn));
                                                while ($row = mysqli_fetch_array($qry)) {
                                                    $aname = $row['addon_name'];
                                                    $aprice = $row['price'];
                                                    $adesc = $row['description'];
                                                    $aimg = $row['addon_image'];
                                                }
                                            ?>
                                            <div class="col-md-8 mb-4">
                                                <form action="" method="post">
                                                    <div class="form-group" id="grp">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-4">
                                                                <label for="">addon Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="name" id="" placeholder="Addon Name" value="<?php echo htmlentities($aname); ?>">
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <label for="">Price <span class="text-danger">*</span></label>
                                                                <input type="text" name="price" id="" placeholder="Addon Price in Ksh." value="<?php echo htmlentities($aprice); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="grp">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <label for="">Description</label>
                                                                <textarea name="desc" id="" rows="4" placeholder="Description">
                                                                    <?php echo htmlentities($adesc); ?>
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="update_addon" class="btn btn-primary btn-sm">UPDATE</button>
                                                    <button type="reset" class="btn btn-success  btn-sm">CLEAR</button>
                                                </form>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <p>Change Item Image &nbsp;<i class="fas fa-image"></i></p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="f-image">
                                                            <div class="image-container">
                                                                <img src="uploaded_images/<?php echo htmlentities($aimg); ?>" alt="" class="image-responsive">
                                                            </div>
                                                        </div>
                            
                                                        <div class="frm mt-4">
                                                            <form action="" method="post" enctype="multipart/form-data">
                                                                <div class="form-group mb-4">
                                                                    <input type="file" name="fimage" id="" class="form-control">
                                                                </div>
                                                                <button type="submit" name="update_image" class="btn btn-primary btn-sm">UPDATE IMAGE</button>
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