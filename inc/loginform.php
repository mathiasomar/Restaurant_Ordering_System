<?php
    if (isset($_POST['register'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pass1 = mysqli_real_escape_string($conn, $_POST['password1']);
        $pass2 = mysqli_real_escape_string($conn, $_POST['password2']);

        if (!empty($username) && !empty($email) && !empty($phone) && !empty($pass1) && !empty($pass2)) {
            if ($pass1 === $pass2) {
                $qry = mysqli_query($conn, "SELECT * FROM tbl_customers WHERE cus_name='$username' || cus_email='$email' || cus_phone='$phone'") or die(mysqli_error($conn));
                if (mysqli_num_rows($qry) > 0) {
                    echo "<script>alert('Username already registered');</script>";
                } else {
                    $password = md5($pass1);
                    mysqli_query($conn, "INSERT INTO tbl_customers VALUES(NULL, '$username', '$email', '$phone', '$password')") or die(mysqli_error($conn));
                    echo "<script>alert('Registered Successfully you can now login');</script>";
                }
                
            } else {
                echo "<script>alert('Password do not match');</script>";
            }
        } else {
            echo "<script>alert('Fill all the fields');</script>";
        }
        
        
    }

    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $password = md5($password);
        $qry = mysqli_query($conn, "SELECT * FROM tbl_customers WHERE cus_name='$username' && password='$password'") or die(mysqli_error($conn));
        if (mysqli_num_rows($qry) > 0) {
            $_SESSION['username'] = $username;
            $current_page = $_SERVER['REQUEST_URI'];
            echo "<script>document.location = '$current_page';</script>";
        } else {
            echo "<script>alert('Invalid credential');</script>";
        }
        
    }
?>

<section class="login-form-container" id="loginSect">
    <div class="close-btn" onclick="closeLoginForm()">
        <i class="fas fa-times"></i>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-cont active_form" id="loginf">
                    <div class="form-header">
                        <div class="account-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h4>Login Here</h4>
                    </div>
                    <form action="" method="post">
                        <div class="form-group" id="grp3">
                            <label for="">Username:</label>
                            <input type="text" name="username" id="" placeholder="username">
                        </div>
                        <div class="form-group" id="grp3">
                            <label for="">Password:</label>
                            <input type="password" name="password" id="" placeholder="************">
                        </div>
                        <button type="submit" name="login" class="btn" id="accBtn">Login</button>
                    </form>
                    <div class="well mt-4 mb-4 text-center">
                        <a href="#" id="recover">Forget Password?</a>
                        <br><br>
                        <a href="#" id="regacc">Don't have an account?</a>
                    </div>
                </div>
                <div class="form-cont" id="reg">
                    <div class="form-header">
                        <div class="account-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h4>Register Here</h4>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group" id="grp3">
                            <label for="">Username:</label>
                            <input type="text" name="username" id="" placeholder="username">
                        </div>
                        <div class="form-group" id="grp3">
                            <label for="">Email Address:</label>
                            <input type="email" name="email" id="" placeholder="someone@gmail.com">
                        </div>
                        <div class="form-group" id="grp3">
                            <label for="">Phone Number:</label>
                            <input type="number" name="phone" id="" placeholder="07xxxxxxxx">
                        </div>
                        <div class="form-group" id="grp3">
                            <label for="">New Password:</label>
                            <input type="password" name="password1" id="" placeholder="************">
                        </div>
                        <div class="form-group" id="grp3">
                            <label for="">Confirm Password:</label>
                            <input type="password" name="password2" id="" placeholder="************">
                        </div>
                        <button type="submit" name="register" class="btn" id="accBtn">Register</button>
                    </form>
                    <div class="well mt-4 mb-4 text-center">
                        <a href="#" id="backlg">Already have an account?</a>
                    </div>
                </div>
                <div class="form-cont" id="recovery">
                    <div class="form-header">
                        <div class="account-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h4>Account Recovery</h4>
                    </div>
                    <form action="">
                        <div class="form-group" id="grp3">
                            <label for="">Username:</label>
                            <input type="text" name="username" id="" placeholder="username">
                        </div>
                        <div class="form-group" id="grp3">
                            <label for="">Email:</label>
                            <input type="email" name="email" id="" placeholder="email@gmail.com">
                        </div>
                        <button type="submit" class="btn" id="accBtn">Submit</button>
                    </form>
                    <div class="well mt-4 mb-4 text-center">
                        <a href="#" id="lginacc">--Back to Login---</Back></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>