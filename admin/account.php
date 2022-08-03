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
                <title>Restaurant || Edit Account</title>
                <link rel="stylesheet" href="assets/css/all.min.css">
                <link rel="stylesheet" href="assets/css/bootstrap.min.css">
                <link rel="stylesheet" href="assets/css/fontawesome.min.css">
                <link rel="stylesheet" href="assets/css/style.css">
                <link rel="icon" href="assets/images/user.png">
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

                    $useremail = $_SESSION['useremail'];

                    if (isset($_POST['update_personal'])) {
                        $u_email = mysqli_real_escape_string($conn, $_POST['email']);
                        $u_phone = mysqli_real_escape_string($conn, $_POST['phone']);
                        $u_name = mysqli_real_escape_string($conn, $_POST['username']);

                        if (!empty($u_email) && !empty($u_phone) && !empty($u_name)) {
                            
                            mysqli_query($conn, "UPDATE tbl_user SET email='$u_email', phone='$u_phone', username='$u_name' WHERE email='$useremail'") or die(mysqli_error($conn));
                            $_SESSION['useremail'] = $u_email;
                            $msg = "Personal Details Updated Successfully";
                            $msgClass = "success";
                            $msgIcon = "check-double";
                            
                            
                        } else {
                            $msg = "Account Field must not be Null";
                            $msgClass = "warning";
                            $msgIcon = "exclamation-circle";
                        }
                        
                    }

                    if (isset($_POST['update_security'])) {
                        $new_pass = mysqli_real_escape_string($conn, $_POST['new_password']);
                        $confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm_password']);

                        if (!empty($new_pass) && !empty($confirm_pass)) {

                            if ($new_pass == $confirm_pass) {
                                $password = md5($new_pass);
                                mysqli_query($conn, "UPDATE tbl_user SET password='$password' WHERE email='$useremail'") or die(mysqli_error($conn));
                                $msg = "Password Updated Successfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            } else {
                                $msg = "New and Confirm Password do not match";
                                $msgClass = "danger";
                                $msgIcon = "times-circle";
                            }
                            
                            
                            
                        } else {
                            $msg = "Account Password Field must not be Null";
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
                                <p>Edit My Account</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <?php
                                $useremail = $_SESSION['useremail'];
                                $username = "";
                                $email = "";
                                $password = "";
                                $phone = "";
                                $qry = mysqli_query($conn, "SELECT * FROM tbl_user WHERE email='$useremail'") or die(mysqli_error($conn));
                                while ($row = mysqli_fetch_array($qry)) {
                                    $username = $row['username'];
                                    $email = $row['email'];
                                    $password = $row['password'];
                                    $phone = $row['phone'];
                                }
                            ?>
                        
                            <div class="col-md-6 mb-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>Personal Details</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <label for=""><i class="fas fa-envelope"></i> Username <span class="text-danger">*</span></label>
                                                        <input type="text" name="username" id="" placeholder="someone@gmail.com" value="<?php echo htmlentities($username); ?>">
                                                    </div>
                                                    <div class="col-md-12 mb-4">
                                                        <label for=""><i class="fas fa-envelope"></i> Email <span class="text-danger">*</span></label>
                                                        <input type="text" name="email" id="" placeholder="someone@gmail.com" value="<?php echo htmlentities($email); ?>">
                                                    </div>
                                                    <div class="col-md-12 mb-4">
                                                        <label for=""><i class="fas fa-phone"></i> Phone Number <span class="text-danger">*</span></label>
                                                        <input type="text" name="phone" id="" placeholder="07xxxxxxxx" value="<?php echo htmlentities($phone); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="update_personal" class="btn btn-primary btn-sm">UPDATE PERSONAL DETAILS</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>Security</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <!--<div class="col-md-12 mb-4">
                                                        <label for=""><i class="fas fa-unlock"></i> Current Password <span class="text-danger">*</span></label>
                                                        <input type="password" name="current" id="" placeholder="************">
                                                    </div>-->
                                                    <div class="col-md-12 mb-4">
                                                        <label for=""><i class="fas fa-lock"></i> New Password <span class="text-danger">*</span></label>
                                                        <input type="password" name="new_password" id="" placeholder="************">
                                                    </div>
                                                    <div class="col-md-12 mb-4">
                                                        <label for=""><i class="fas fa-lock"></i> Confirm Password <span class="text-danger">*</span></label>
                                                        <input type="password" name="confirm_password" id="" placeholder="************">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="update_security" class="btn btn-primary btn-sm">UPDATE PASSWORD</button>
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