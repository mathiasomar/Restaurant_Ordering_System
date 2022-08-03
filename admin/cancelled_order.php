<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant || Cancelled Orders</title>
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/images/IMG-20220419-WA0001.jpg">
</head>
<body>
    <!--Sidebar-->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><a href="dashboard.html"><i class="fas fa-utensils"></i> <span>PathFinder</span></a></h3>
        </div>

        <!--Sidebar Menus-->
        <div class="sidebar-menu">
            <ul class="menus">
                <li>
                    <a href="dashboard.html">
                        <span class="fas fa-tachometer-alt"></span>
                        <span>Dashboard</span>
                    </a>
                    <!--<span class="tooltiptext">Dashboard</span>-->
                </li>
                <li>
                    <a href="admin.html">
                        <span class="fas fa-user"></span>
                        <span>Admin</span>
                    </a>
                    <!--<span class="tooltiptext">Admin</span>-->
                </li>
                <li>
                    <a href="users.html">
                        <span class="fas fa-users"></span>
                        <span>Customers</span>
                    </a>
                    <span class="tooltiptext">Customers</span>
                </li>
                <li>
                    <a href="category.html">
                        <span class="fas fa-bars"></span>
                        <span>Menu</span>
                    </a>
                    <!--<span class="tooltiptext">Menu</span>-->
                </li>
                <li>
                    <a href="food.html">
                        <span class="fas fa-utensil-spoon"></span>
                        <span>Items</span>
                    </a>
                    <!--<span class="tooltiptext">Items</span>-->
                </li>
                <li>
                    <a href="addons.html">
                        <span class="fas fa-plus"></span>
                        <span>Add-ons</span>
                    </a>
                    <!--<span class="tooltiptext">Add-ons</span>-->
                </li>
                <li>
                    <a href="opations.html">
                        <span class="fas fa-align-justify"></span>
                        <span>Options</span>
                    </a>
                    <!--<span class="tooltiptext">Options</span>-->
                </li>
                <li>
                    <a href="itemtype.html">
                        <span class="fas fa-list"></span>
                        <span>Item-types</span>
                    </a>
                    <!--<span class="tooltiptext">Item-types</span>-->
                </li>
                <li>
                    <a href="offers.html">
                        <span class="fas fa-box-open"></span>
                        <span>Offers</span>
                    </a>
                    <!--<span class="tooltiptext">Offers</span>-->
                </li>
                <div class="sidedrop">
                    <div class="btn-text">
                        <span class="fas fa-cart-plus"></span>
                        <span class="span-last">Orders</span>
                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>
                <div class="sidedrop-cont">
                    <ul>
                        <li><a href="new_order.html"><span class="fas fa-ellipsis-h"></span> <span>New Orders</span></a></li>
                        <li><a href="under_process_order.html"><span class="fas fa-sync-alt fa-pulse"></span> <span>Under Process Orders</span></a></li>
                        <li><a href="cleared_order.html"><span class="fas fa-check"></span> <span>Cleared Orders</span></a></li>
                        <li><a href="cancelled_order.html"><span class="fas fa-times"></span> <span>Cancelled Orders</span></a></li>
                    </ul>
                </div>
                <li>
                    <a href="pages.html">
                        <span class="fas fa-desktop"></span>
                        <span>Pages</span>
                    </a>
                    <!--<span class="tooltiptext">Offers</span>-->
                </li>
                <div class="sidedrop">
                    <div class="btn-text">
                        <span class="fas fa-question"></span>
                        <span class="span-last">FAQs</span>
                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>
                <div class="sidedrop-cont">
                    <ul>
                        <li><a href="faqs_category.html"><span class="fas fa-ellipsis-h"></span> <span>Faqs Category</span></a></li>
                        <li><a href="faqs.html"><span class="fas fa-circle"></span> <span>FAQs</span></a></li>
                    </ul>
                </div>
                <li>
                    <a href="booking.html">
                        <span class="fas fa-envelope"></span>
                        <span>Reservations</span>
                    </a>
                    <!--<span class="tooltiptext">Reservations</span>-->
                </li>
            </ul>
        </div>
        <!--/Sidebar Menus-->
    </div>
    <!--/Sidebar-->

    <!--Navbar-->
    <nav class="navbar">
        <div class="menu-bars" id="bars" onclick="toggleSidebar()">
            <span class="fas fa-bars"></span>
        </div>

        <div class="account-section">
            <div class="info">
                <p>Welcome, Admin <span class="fas fa-angle-down" id="drop"></span></p>
                <div class="notification-alert">
                    <ul>
                        <li>
                            <a href="#"><label for="check"><i class="fas fa-bell"></i></label></a>
                            <span class="badge bg-danger" id="alertNo">10</span>
                            <input type="checkbox" class="dropdown-check" name="" id="check">
                            <ul class="drop-alert">
                                <li>Notification 1</li>
                                <li>Notification 2</li>
                                <li>Notification 3</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!--/Navbar-->

    <!--Logout-->
    <div class="logout-container" id="lg">
        <a href="#"><span class="fas fa-sign-out-alt"></span> <span>Logout</span></a>
    </div>
    <!--/Logout-->

    <!--Small Mode Icon-->
    <div class="icon-container">
        <img src="assets/images/IMG-20220419-WA0001.jpg" alt="">
    </div>
    <!--/Small Mode Icon-->

    <!--Main Section-->
    <main>
        <div class="container-fluid">
            <div class="section-header">
                <div class="headers">
                    <p><a href="dashboard.html"><i class="fas fa-home"></i>Home</a> </p>
                    <p>/</p>
                    <p>View Cancelled Orders</p>
                </div>
            </div>

            <hr>

            <div class="card mb-4">
                <div class="card-header">
                    <p>cancelled orders info</p>
                </div>
                <div class="card-body">
                    <div class="filter-section mt-3">
                        <div class="entry-section">
                            <span>Show</span>
                            <form action="">
                                <select name="entry" id="sec">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                </select>
                            </form>
                            <span>Entry</span>
                        </div>
                        <div class="search-section">
                            <form action="">
                                <div class="form-group" id="grp">
                                    <input type="search" name="search" placeholder="search.....">
                                </div>
                            </form>
                        </div>
                    </div>
        
                    <hr>
        
                    <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Order No</th>
                                <th>Order Date</th>
                                <th>Order Time</th>
                                <th>Order Cost</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>RST456734</td>
                                <td>05.01.2022</td>
                                <td>19:14</td>
                                <td>Ksh. 250</td>
                                <td>Omar Mathias</td>
                                <td>0745711293</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>RST456734</td>
                                <td>05.01.2022</td>
                                <td>19:14</td>
                                <td>Ksh. 250</td>
                                <td>Omar Mathias</td>
                                <td>0745711293</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>RST456734</td>
                                <td>05.01.2022</td>
                                <td>19:14</td>
                                <td>Ksh. 250</td>
                                <td>Omar Mathias</td>
                                <td>0745711293</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>RST456734</td>
                                <td>05.01.2022</td>
                                <td>19:14</td>
                                <td>Ksh. 250</td>
                                <td>Omar Mathias</td>
                                <td>0745711293</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                            </tr>
                        </tbody>
                    </table>
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