<?php
    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        if (!empty($email)) {
            $qry = mysqli_query($conn, "SELECT * FROM tbl_subscribers WHERE email='$email'") or die(mysqli_error($conn));
            if (mysqli_num_rows($qry) > 0) {
                echo "<script>alert('Already Subscribed');</script>";
            } else {
                mysqli_query($conn, "INSERT INTO tbl_subscribers VALUES(NULL, '$email', NULL)") or die(mysqli_error($conn));
            }
            
        } else {
            echo "<script>alert('Enter Email to subscribe');</script>";
        }
    }
?>
<section class="footer">
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="footer-links">
                        <div class="footer-header">
                            <h4>ABOUT US</h4>
                        </div>
                        <ul>
                            <li><a href="pages.php?type=aboutus">
                                <span class="fas fa-angle-right"></span>
                                <span>About Us</span>
                            </a></li>
                            <li><a href="faqs.php">
                                <span class="fas fa-angle-right"></span>
                                <span>FAQs</span>
                            </a></li>
                            <li><a href="pages.php?type=privacy">
                                <span class="fas fa-angle-right"></span>
                                <span>Privacy</span>
                            </a></li>
                            <li><a href="pages.php?type=terms">
                                <span class="fas fa-angle-right"></span>
                                <span>Terms of Service</span>
                            </a></li>
                            <li><a href="admin/admin_signup.php">
                                <span class="fas fa-angle-right"></span>
                                <span>Admin Login</span>
                            </a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="footer-links">
                        <div class="footer-header">
                            <h4>subscribe letter</h4>
                        </div>
                        <form action="" method="post">
                            <div class="form-group" id="grp2">
                                <label for="">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="" placeholder="someone@gmail.com">
                            </div>
                            <button type="submit" name="submit" class="btn mt-4" id="formBtn">Subscribe</button>
                        </form>
                        <br>
                        <?php
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_subscribers") or die(mysqli_error($conn));
                            $count_sub = mysqli_num_rows($qry);
                        ?>
                        <p><span class="text-info"><?php echo htmlentities($count_sub); ?></span> <span>Subscribers</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="bottom-footer-contents">
                <div class="left-cont">
                    <p>&copy; 2022 PathFinder Restaurant. All right reserve</p>
                </div>
                <div class="right-cont">
                    <ul>
                        <li>Connect with us: </li>
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>