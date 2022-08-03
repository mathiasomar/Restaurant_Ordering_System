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
                <title>Restaurant || Edit Menu</title>
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

                    if (isset($_POST['update_menu'])) {
                        $mname = mysqli_real_escape_string($conn, $_POST['mname']);
                        $punch = mysqli_real_escape_string($conn, $_POST['punch']);
                        $desc = mysqli_real_escape_string($conn, $_POST['desc']);

                        if (!empty($mname) && !empty($punch)) {
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_menu WHERE menu_name='$mname' && id != '$id'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "The menu name already exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                mysqli_query($conn, "UPDATE tbl_menu SET menu_name='$mname', punchline='$punch', description='$desc' WHERE id='$id'") or die(mysqli_error($conn));
                                $msg = "Menu Details Updated Successfully";
                                $msgClass = "success";      
                                $msgIcon = "check-double";
                            }
                            
                        } else {
                            $msg = "Fill the esential fields";
                            $msgClass = "warning";
                            $msgIcon = "exclamation-circle";
                        }
                    }

                    if (isset($_POST['update_menu_image'])) {
                        $image = $_FILES['fimage']['name'];

                        if (!empty($image)) {
                            $qry = mysqli_query($conn, "SELECT menu_image FROM tbl_menu WHERE menu_image='$image' && id != '$id'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "The image selected exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                move_uploaded_file($_FILES['fimage']['tmp_name'], "uploaded_images/".$image);
                                mysqli_query($conn, "UPDATE tbl_menu SET menu_image='$image' WHERE id='$id'");
                                $msg = "Menu Image Updated Successfully";
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
                                <p>Edit Menu</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>selected menu</p>
                                        <div class="right-btns">
                                            <a href="menu.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <?php
                                                $menu_name = "";
                                                $menu_punchline = "";
                                                $menu_desc = "";
                                                $menu_image = "";

                                                $qry = mysqli_query($conn, "SELECT * FROM tbl_menu WHERE id='$id'") or die(mysqli_error($conn));
                                                while ($row = mysqli_fetch_array($qry)) {
                                                    $menu_name = $row['menu_name'];
                                                    $menu_punchline = $row['punchline'];
                                                    $menu_desc = $row['description'];
                                                    $menu_image = $row['menu_image'];
                                                }
                                                
                                            ?>
                                            <div class="col-md-8 mb-4">
                                                <form action="" method="post">
                                                    <div class="form-group" id="grp">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-4">
                                                                <label for="">Menu Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="mname" id="" placeholder="Menu Name" value="<?php echo htmlentities($menu_name); ?>">
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <label for="">Punch Line <span class="text-danger">*</span></label>
                                                                <input type="text" name="punch" id="" placeholder="Punch Line" value="<?php echo htmlentities($menu_punchline); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="grp">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <label for="">Description</label>
                                                                <textarea name="desc" id="" rows="4" placeholder="Description">
                                                                    <?php echo htmlentities($menu_desc); ?>
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="update_menu" class="btn btn-primary btn-sm">UPDATE</button>
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
                                                                <img src="uploaded_images/<?php echo htmlentities($menu_image); ?>" alt="" class="image-responsive">
                                                            </div>
                                                        </div>
                            
                                                        <div class="frm mt-4">
                                                            <form action="" method="post" enctype="multipart/form-data">
                                                                <div class="form-group mb-4">
                                                                    <input type="file" name="fimage" id="" class="form-control">
                                                                </div>
                                                                <button type="submit" name="update_menu_image" class="btn btn-primary btn-sm">UPDATE IMAGE</button>
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