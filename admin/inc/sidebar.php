<?php 
    require_once('config/config.php'); 
    include 'connection.php';
?>

<div class="sidebar">
        <div class="sidebar-header">
            <h3><a href="<?php echo ROOT_URL; ?>"><i class="fas fa-utensils"></i> <span>PathFinder</span></a></h3>
        </div>

        <!--Sidebar Menus-->
        <div class="sidebar-menu">
            <ul class="menus">
                <li>
                    <a href="<?php echo ROOT_URL; ?>">
                        <span class="fas fa-tachometer-alt"></span>
                        <span>Dashboard</span>
                    </a>
                    <!--<span class="tooltiptext">Dashboard</span>-->
                </li>
                <li>
                    <a href="user.php">
                        <span class="fas fa-user"></span>
                        <span>Users</span>
                    </a>
                    <!--<span class="tooltiptext">Admin</span>-->
                </li>
                <li>
                    <a href="customer.php">
                        <span class="fas fa-users"></span>
                        <span>Customers</span>
                    </a>
                    <span class="tooltiptext">Customers</span>
                </li>
                <li>
                    <a href="menu.php">
                        <span class="fas fa-bars"></span>
                        <span>Menu</span>
                    </a>
                    <!--<span class="tooltiptext">Menu</span>-->
                </li>
                <li>
                    <a href="item.php">
                        <span class="fas fa-utensil-spoon"></span>
                        <span>Items</span>
                    </a>
                    <!--<span class="tooltiptext">Items</span>-->
                </li>
                <li>
                    <a href="addons.php">
                        <span class="fas fa-plus"></span>
                        <span>Add-ons</span>
                    </a>
                    <!--<span class="tooltiptext">Add-ons</span>-->
                </li>
                <!--<li>
                    <a href="opations.php">
                        <span class="fas fa-align-justify"></span>
                        <span>Options</span>
                    </a>
                    <span class="tooltiptext">Options</span>
                </li>-->
                <li>
                    <a href="itemtype.php">
                        <span class="fas fa-list"></span>
                        <span>Item-types</span>
                    </a>
                    <!--<span class="tooltiptext">Item-types</span>-->
                </li>
                <li>
                    <a href="offers.php">
                        <span class="fas fa-box-open"></span>
                        <span>Offers</span>
                    </a>
                    <!--<span class="tooltiptext">Offers</span>-->
                </li>
                <li>
                    <a href="orders.php">
                        <span class="fas fa-shopping-cart"></span>
                        <span>Orders</span>
                    </a>
                    <!--<span class="tooltiptext">Offers</span>-->
                </li>
                <li>
                    <a href="page.php">
                        <span class="fas fa-desktop"></span>
                        <span>Pages</span>
                    </a>
                    <!--<span class="tooltiptext">Offers</span>-->
                </li>
                <div class="sidedrop">
                    <div class="btn-text">
                        <span class="fas fa-question-circle"></span>
                        <span class="span-last">FAQs</span>
                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>
                <div class="sidedrop-cont">
                    <ul>
                        <li><a href="faqs_category.php"><span class="fas fa-ellipsis-h"></span> <span>Faqs Category</span></a></li>
                        <li><a href="faqs.php"><span class="fas fa-circle"></span> <span>FAQs</span></a></li>
                    </ul>
                </div>
                <li>
                    <a href="testimonial.php">
                        <span class="fas fa-message"></span>
                        <span>Manage Testimonial</span>
                    </a>
                    <!--<span class="tooltiptext">Offers</span>-->
                </li>
                <li>
                    <a href="contactus_info.php">
                        <span class="fas fa-phone"></span>
                        <span>Manage ContactUS Info</span>
                    </a>
                    <!--<span class="tooltiptext">Offers</span>-->
                </li>
                <li>
                    <a href="contactus_query.php">
                        <span class="fas fa-sitemap"></span>
                        <span>Manage ContactUS Query</span>
                    </a>
                    <!--<span class="tooltiptext">Offers</span>-->
                </li>
                <li>
                    <a href="subscribers.php">
                        <span class="fas fa-table"></span>
                        <span>Manage Subscribers</span>
                    </a>
                    <!--<span class="tooltiptext">Offers</span>-->
                </li>
                <!--<li>
                    <a href="booking.php">
                        <span class="fas fa-envelope"></span>
                        <span>Reservations</span>
                    </a>
                    <span class="tooltiptext">Reservations</span>
                </li>-->
            </ul>
        </div>
        <!--/Sidebar Menus-->
    </div>