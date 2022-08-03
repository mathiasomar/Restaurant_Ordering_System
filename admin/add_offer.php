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
                <title>Restaurant || Add Offer</title>
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

                    if (isset($_POST['add_offer'])) {
                        $offer_name = mysqli_real_escape_string($conn, $_POST['name']);
                        $offer_price = mysqli_real_escape_string($conn, $_POST['price']);
                        $startdate = mysqli_real_escape_string($conn, $_POST['startdate']);
                        $validdate = mysqli_real_escape_string($conn, $_POST['validdate']);
                        $offer_image = $_FILES['offerimage']['name'];
                        $condition = mysqli_real_escape_string($conn, $_POST['condition']);

                        if (!empty($offer_name) && !empty($startdate) && !empty($validdate) && !empty($condition)) {
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_offer WHERE offer_name='$offer_name' && offer_cost='$offer_price' && offer_start_date='$startdate' && offer_valid_date='$validdate'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "Offer already exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                $status = 1;
                                move_uploaded_file($_FILES['offerimage']['tmp_name'], "uploaded_images/".$offer_image);
                                mysqli_query($conn, "INSERT INTO tbl_offer VALUES(NULL, '$offer_name', '$offer_price', '$startdate', '$validdate', '$condition', '$offer_image', '$status', NULL)") or die(mysqli_error($conn));
                                $msg = "Offer Added Successfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            }
                            
                        } else {
                            $msg = "Input all the fields";
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
                                <p>Add Offer</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>form input</p>
                                        <div class="right-btns">
                                            <a href="offers.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Offer Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" id="" placeholder="Offer Name">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Offer Price <span class="text-danger">*</span></label>
                                                        <input type="text" name="price" id="" placeholder="Offer Price">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Offer Start Date <span class="text-danger">*</span></label>
                                                        <input type="date" name="startdate" id="" placeholder="Offer Name">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Offer Valid Date <span class="text-danger">*</span></label>
                                                        <input type="date" name="validdate" id="" placeholder="Offer Price">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                <div class="col-md-6 mb-4">
                                                        <label for="">Offer Image <span class="text-danger">*</span></label>
                                                        <input type="file" name="offerimage" id="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <label for="">Offer Conditions <span class="text-danger">*</span></label>
                                                        <textarea name="condition" id="" rows="4" placeholder="Offer Conditions"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="add_offer" class="btn btn-primary btn-sm">ADD</button>
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