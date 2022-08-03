<?php 
    include 'connection.php';
    session_start();

    if (isset($_POST['admin_login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($password);
        $role = 'Admin';
        $status = 1;

        $qry = mysqli_query($conn, "SELECT * FROM tbl_user WHERE email='$email' && password='$password' && role='$role' && status='$status'") or die(mysqli_error($conn));
        if (mysqli_num_rows($qry) > 0) {
            echo "<script>alert('Success..');</script>";
            $_SESSION['useremail'] = $email;
            ?>
                <script>
                    document.location = 'dashboard.php';
                </script>
            <?php
        } else {
            echo "<script>alert('Sorry! Invalid Credentials');</script>";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant ..::.. Admin Login</title>
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login-style.css">
    <link rel="icon" href="assets/images/restaurant.svg">
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-4">
                <div class="frm-header">
                    <h2>Admin | Login</h2>
                </div>
                <div class="frm-container mt-4">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="someone@gmail.com">
                            <label for="floatingInput">Email Address <span>*</span></label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="*********">
                            <label for="floatingPassword">Password <span>*</span></label>
                        </div>
                        <button type="submit" name="admin_login" class="btn btn-success" id="btnlg"><i class="fas fa-unlock"></i> Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <footer>
        <div class="left-content">
            <p>&copy; 2022 Copyright</p>
        </div>
        <div class="right-content">
            <p><i class="fas fa-pizza-slice"></i> Restaurant Management System</p>
        </div>
    </footer>
    <!--/Footer-->
</body>
</html>