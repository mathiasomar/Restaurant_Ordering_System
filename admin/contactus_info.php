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
                <title>Restaurant || Edit Contact Us Info</title>
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

                    if (isset($_POST['update_info'])) {
                        $email = mysqli_real_escape_string($conn, $_POST['email']);
                        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                        $instagram = mysqli_real_escape_string($conn, $_POST['instagram']);
                        $whatsapp = mysqli_real_escape_string($conn, $_POST['whatsapp']);

                        if (!empty($email) && !empty($phone) && !empty($instagram) && !empty($whatsapp)) {
                            
                            $qry = mysqli_query($conn, "UPDATE tbl_contactus_info SET email='$email', call_number='$phone', instagram='$instagram', whatsapp='$whatsapp'") or die(mysqli_error($conn));
                            $msg = "Contact Us Info Updated Successfully";
                            $msgClass = "success";
                            $msgIcon = "check-double";
                            
                            
                        } else {
                            $msg = "Contuct Us Info Field must not be Null";
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
                                <p>Edit Contact Us Info</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>Contact Us Info</p>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            $cont_email = "";
                                            $cont_phone = "";
                                            $cont_ig = "";
                                            $cont_whatsapp = "";
                                            $qry = mysqli_query($conn, "SELECT * FROM tbl_contactus_info") or die(mysqli_error($conn));
                                            while ($row = mysqli_fetch_array($qry)) {
                                                $cont_email = $row['email'];
                                                $cont_phone = $row['call_number'];
                                                $cont_ig = $row['instagram'];
                                                $cont_whatsapp = $row['whatsapp'];
                                            }
                                        ?>
                                        <form action="" method="post">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for=""><i class="fas fa-envelope"></i> Email <span class="text-danger">*</span></label>
                                                        <input type="email" name="email" id="" placeholder="someone@gmail.com" value="<?php echo htmlentities($cont_email); ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for=""><i class="fas fa-phone"></i> Phone Number <span class="text-danger">*</span></label>
                                                        <input type="number" name="phone" id="" placeholder="07xxxxxxxx" value="<?php echo htmlentities($cont_phone); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for=""><i class="fab fa-instagram"></i> Instagram <span class="text-danger">*</span></label>
                                                        <input type="text" name="instagram" id="" placeholder="ig_username" value="<?php echo htmlentities($cont_ig); ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for=""><i class="fab fa-whatsapp"></i> Whatsapp <span class="text-danger">*</span></label>
                                                        <input type="number" name="whatsapp" id="" placeholder="07xxxxxxxx" value="<?php echo htmlentities($cont_whatsapp); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="update_info" class="btn btn-primary btn-sm">UPDATE</button>
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