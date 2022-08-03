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
                <title>Restaurant || Add User</title>
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

                    if (isset($_POST['add_user'])) {
                        $username = mysqli_real_escape_string($conn, $_POST['username']);
                        $email = mysqli_real_escape_string($conn, $_POST['email']);
                        $role = mysqli_real_escape_string($conn, $_POST['role']);
                        $password = mysqli_real_escape_string($conn, $_POST['password']);
                        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                        $status = 1;

                        if (!empty($username) && !empty($email) && !empty($role) && !empty($password)) {
                            if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
                                $qry = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username='$username' || email='$email'") or die(mysqli_error($conn));
                                if (mysqli_num_rows($qry) > 0) {
                                    $msg = "Username or Email already exist";
                                    $msgClass = "danger";
                                    $msgIcon = "exclamation-triangle";
                                } else {
                                    $password = md5($password);
                                    mysqli_query($conn, "INSERT INTO tbl_user VALUES(NULL, '$username', '$email',  '$password',  '$phone', '$role', '$status')") or die(mysqli_error($conn));
                                    $msg = "User Added Successfully";
                                    $msgClass = "success";
                                    $msgIcon = "check-double";
                                }
                                
                            } else {
                                $msg = "Invalid email format";
                                $msgClass = "warning";
                                $msgIcon = "exclamation-circle";
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
                                <p>Add User</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>form input</p>
                                        <div class="right-btns">
                                            <a href="user.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Username <span class="text-danger">*</span></label>
                                                        <input type="text" name="username" id="" placeholder="Username">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Email <span class="text-danger">*</span></label>
                                                        <input type="email" name="email" id="" placeholder="someone@gmail.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Role <span class="text-danger">*</span></label>
                                                        <select name="role" id="">
                                                            <option value="">select</option>
                                                            <option>Admin</option>
                                                            <option>Kitchen Manager</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Password <span class="text-danger">*</span></label>
                                                        <input type="password" name="password" id="" placeholder="*********">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Phone Number <span class="text-danger">*</span></label>
                                                        <input type="number" name="phone" id="" placeholder="07XXXXXXXX">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm" name="add_user">ADD</button>
                                            <button type="reset" class="btn btn-success btn-sm">CLEAR</button>
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