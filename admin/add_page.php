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
                <title>Restaurant || Add Page</title>
                <link rel="stylesheet" href="assets/css/all.min.css">
                <link rel="stylesheet" href="assets/css/bootstrap.min.css">
                <link rel="stylesheet" href="assets/css/fontawesome.min.css">
                <link rel="stylesheet" href="assets/css/style.css">
                <link rel="icon" href="assets/images/IMG-20220419-WA0001.jpg">
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

                    if (isset($_POST['add_page'])) {
                        $page_name = mysqli_real_escape_string($conn, $_POST['name']);
                        $page_type = mysqli_real_escape_string($conn, $_POST['type']);
                        $page_details = mysqli_real_escape_string($conn, $_POST['details']);

                        if (!empty($page_name) && !empty($page_type) && !empty($page_details)) {
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_page WHERE page_name='$page_name' && type='$page_type' && text='$page_details'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "Page Already Exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                mysqli_query($conn, "INSERT INTO tbl_page VALUES(NULL, '$page_name', '$page_type', '$page_details')") or die(mysqli_error($conn));
                                $msg = "Page Added Successfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            }
                            
                        } else {
                            $msg = "Input all the fields";
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
                                <p>Add Page</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>form input</p>
                                        <div class="right-btns">
                                            <a href="page.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Page Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" id="" placeholder="Page Name">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Page Type <span class="text-danger">*</span></label>
                                                        <input type="text" name="type" id="" placeholder="Page type">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <label for="">Page Details <span class="text-danger">*</span></label>
                                                        <textarea name="details" id="" rows="4" placeholder="Page Details"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="add_page" class="btn btn-primary btn-sm">ADD</button>
                                            <button type="reset" class="btn btn-success  btn-sm">CLEAR</button>
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