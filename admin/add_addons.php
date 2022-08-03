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
                <title>Restaurant || Add Add-ons</title>
                <link rel="stylesheet" href="assets/css/all.min.css">
                <link rel="stylesheet" href="assets/css/bootstrap.min.css">
                <link rel="stylesheet" href="assets/css/fontawesome.min.css">
                <link rel="stylesheet" href="assets/css/style.css">
                    
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

                    if (isset($_POST['add_addon'])) {
                        $name = mysqli_real_escape_string($conn, $_POST['name']);
                        $price = mysqli_real_escape_string($conn, $_POST['price']);
                        $desc = mysqli_real_escape_string($conn, $_POST['desc']);
                        $addonimage = $_FILES['addonimage']['name'];

                        if (!empty($name) && !empty($price) && !empty($addonimage)) {
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_addons WHERE addon_name='$name' && price='$price' && addon_image='$addonimage'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "Addon already exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                $status = 1;
                                move_uploaded_file($_FILES['addonimage']['tmp_name'], "uploaded_images/".$addonimage);
                                mysqli_query($conn, "INSERT INTO tbl_addons VALUES(NULL, '$name', '$price', '$desc', '$addonimage', '$status')") or die(mysqli_error($conn));
                                $msg = "Addon Added Sucessfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            }
                            
                        } else {
                            $msg = "Fill all the necessary fields";
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
                                <p>Add Add-ons</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>form input</p>
                                        <div class="right-btns">
                                            <a href="addons.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">addon Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" id="" placeholder="Addon Name">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Price <span class="text-danger">*</span></label>
                                                        <input type="text" name="price" id="" placeholder="Addon Price in Ksh.">
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
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Addon Image <span class="text-danger">*</span></label>
                                                        <input type="file" name="addonimage" id="">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="add_addon" class="btn btn-primary btn-sm">ADD</button>
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