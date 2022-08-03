<?php
    require_once('config/config.php');
    $status = 1;
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $customer_id = "";
        $count_order = "";
        $qry = mysqli_query($conn, "SELECT * FROM tbl_customers WHERE cus_name='$username'");
        while ($row = mysqli_fetch_array($qry)) {
            $customer_id = $row['id'];
        }
        $count = mysqli_query($conn, "SELECT * FROM tbl_orders WHERE status='$status' && customer='$customer_id'") or die(mysqli_error($conn));
        $count_order = mysqli_num_rows($count);
        /*if (mysqli_num_rows($count) > 0) {
            $count_order = mysqli_num_rows($count);
        } else {
            $count_order = 0;
        }*/
        
    }
?>

<nav class="navbar">
    <div class="container-fluid">
        <div class="left-content">
            <a href="<?php echo ROOT_URL2; ?>" class="navbar-brand"><i class="fas fa-utensils"></i> PathFinder</a>
        </div>

        <div class="right-content">
            <ul class="links">
                <li><a href="<?php echo ROOT_URL2; ?>">Home</a></li>
                <li><a href="menu.php">Menus</a></li>
                <li><a href="pages.php?type=aboutus">About us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if(isset($_SESSION['username'])): ?>
                    <!--<li><a href="logout.php">Welcome, <?php //echo htmlentities($_SESSION['username']); ?></a></li>--> 
                    <li><?php echo htmlentities($_SESSION['username']); ?>
                        <ul>
                            <li><a href="profile.php">My Profile</a></li>
                            <li><a href="my_testimonial.php">My Testimonial</a></li>
                            <li><a href="post_testimonial.php">Post Testimonial</a></li>
                            <li><a href="logout.php">Sign Out</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li id="lgin" onclick="openForm()">Login</li>
                <?php endif; ?>

                <?php if(isset($_SESSION['username'])): ?>
                    <li id="note" title="orders"><a href="order.php"><span class="fas fa-shopping-cart"></span></a> <span class="badge bg-info" id="bg"><?php echo $count_order; ?></span></li>
                <?php else: ?>
                    <li id="note" title="orders"><span class="fas fa-shopping-cart"></span> <span class="badge bg-info smth" id="bg">0</span></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>