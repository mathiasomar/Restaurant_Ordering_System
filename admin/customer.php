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
                <title>Restaurant || Customers</title>
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

                <!--Main Section-->
                <main>
                    <div class="container-fluid">
                        <div class="section-header">
                            <div class="headers">
                                <p><a href="dashboard.html"><i class="fas fa-home"></i>Home</a> </p>
                                <p>/</p>
                                <p>View Customers</p>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-4">
                            <div class="card-header">
                                <p>customers info</p>
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
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Customer</td>
                                            <td>customer@gmail.com</td>
                                            <td>0712345678</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <a href="view_customer.html" class="badge bg-primary"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="badge bg-success">Activate</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Customer</td>
                                            <td>customer@gmail.com</td>
                                            <td>0712345678</td>
                                            <td><span class="badge bg-danger">Inactive</span></td>
                                            <td>
                                                <a href="view_customer.html" class="badge bg-primary"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="badge bg-danger">Deactivate</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Customer</td>
                                            <td>customer@gmail.com</td>
                                            <td>0712345678</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <a href="view_customer.html" class="badge bg-primary"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="badge bg-success">Activate</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Customer</td>
                                            <td>customer@gmail.com</td>
                                            <td>0712345678</td>
                                            <td><span class="badge bg-danger">Inactive</span></td>
                                            <td>
                                                <a href="view_customer.html" class="badge bg-primary"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="badge bg-danger">Deactivate</a>
                                            </td>
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
        <?php
    }
    
?>