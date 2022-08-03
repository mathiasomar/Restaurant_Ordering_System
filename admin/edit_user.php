<?php
    session_start();

    if (strlen($_SESSION['useremail']) == 0) {
        header('Location:index.php');
    } else {
        include 'connection.php';

        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Restaurant || Edit Admin</title>
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

                    if (isset($_POST['update_user'])) {
                        $uname = mysqli_real_escape_string($conn, $_POST['username']);
                        $uemail = mysqli_real_escape_string($conn, $_POST['email']);
                        $urole = mysqli_real_escape_string($conn, $_POST['role']);
                        $upass = mysqli_real_escape_string($conn, $_POST['password']);
                        $uphone = mysqli_real_escape_string($conn, $_POST['phone']);

                        if (!empty($uname) && !empty($uemail) && !empty($upass)) {
                            if (filter_var($uemail, FILTER_VALIDATE_EMAIL) == true) {
                                $qry = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id != '$id' && (username='$uname' || email='$uemail')") or die(mysqli_error($conn));
                                if (mysqli_num_rows($qry) > 0) {
                                    $msg = "Username or Email already taken";
                                    $msgClass = "danger";
                                    $msgIcon = "exclamation-triangle";
                                } else {
                                    $upass = md5($upass);
                                    mysqli_query($conn, "UPDATE tbl_user SET username='$uname', email='$uemail', role='$urole', password='$upass', phone='$uphone' WHERE id='$id'") or die(mysqli_error($conn));
                                    $msg = "User details updated successfully";
                                    $msgClass = "success";
                                    $msgIcon = "check-double";
                                }
                                
                            } else {
                                $msg = "Invalid Email Format";
                                $msgClass = "warning";
                                $msgIcon = "exclamation-circle";
                            }
                            
                        } else {
                            $msg = "Fill the required fileds";
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
                                <p>Edit User</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>selected user</p>
                                        <div class="right-btns">
                                            <a href="user.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <?php
                                                        $username = "";
                                                        $email = "";
                                                        $role = "";
                                                        $password = "";
                                                        $phone = "";

                                                        $qry = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id='$id'") or die(mysqli_error($conn));
                                                        while ($row = mysqli_fetch_array($qry)) {
                                                            $username = $row['username'];
                                                            $email = $row['email'];
                                                            $role = $row['role'];
                                                            $password = $row['password'];
                                                            $phone = $row['phone'];
                                                        }
                                                    ?>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Username <span class="text-danger">*</span></label>
                                                        <input type="text" name="username" id="" placeholder="Email Address" value="<?php echo htmlentities($username); ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Email <span class="text-danger">*</span></label>
                                                        <input type="email" name="email" id="" placeholder="someone@gmail.com" value="<?php echo htmlentities($email); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Role <span class="text-danger">*</span></label>
                                                        <select name="role" id="">
                                                            <option value="">select</option>
                                                            <option <?php if ($role == 'Admin') {echo 'selected';} ?>>Admin</option>
                                                            <option <?php if ($role == 'Kitchen Manager') {echo 'selected';} ?>>Kitchen Manager</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Password <span class="text-danger">*</span></label>
                                                        <input type="password" name="password" id="" placeholder="*********" value="<?php echo htmlentities($password); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Phone Number <span class="text-danger">*</span></label>
                                                        <input type="number" name="phone" id="" placeholder="07XXXXXXXX" value="<?php echo htmlentities($phone); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="update_user" class="btn btn-primary btn-sm">UPDATE</button>
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