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
                <title>Restaurant || Add Menu</title>
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
                    
                    if (isset($_POST['add_menu'])) {
                        $mname = mysqli_real_escape_string($conn, $_POST['mname']);
                        $punch = mysqli_real_escape_string($conn, $_POST['punch']);
                        $desc = mysqli_real_escape_string($conn, $_POST['desc']);
                        $image = $_FILES['menuimage']['name'];

                        if (!empty($mname) && !empty($punch) && !empty($image)) {
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_menu WHERE menu_name='$mname' && punchline='$punch' && menu_image='$image'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "Menu already exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                move_uploaded_file($_FILES['menuimage']['tmp_name'], "uploaded_images/".$image);
                                $status = 1;
                                mysqli_query($conn, "INSERT INTO tbl_menu VALUES(NULL, '$mname', '$punch', '$desc', '$image', '$status', NULL, NULL)") or die(mysqli_error($conn));
                                $msg = "Menu Added Successfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            }
                            
                        } else {
                            $msg = "Fill all the required fields";
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
                                <p>Add Menu</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>form input</p>
                                        <div class="right-btns">
                                            <a href="menu.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Menu Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="mname" id="" placeholder="Menu Name">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Punch Line <span class="text-danger">*</span></label>
                                                        <input type="text" name="punch" id="" placeholder="Punch Line">
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
                                                        <label for="">Menu Image <span class="text-danger">*</span></label>
                                                        <input type="file" name="menuimage" id="">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="add_menu" class="btn btn-primary btn-sm">ADD</button>
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