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
                <title>Restaurant || Edit Page</title>
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

                    $page_id = $_GET['id'];

                    if (isset($_POST['update_page'])) {
                        $p_name = mysqli_real_escape_string($conn, $_POST['name']);
                        $p_type = mysqli_real_escape_string($conn, $_POST['type']);
                        $p_details = mysqli_real_escape_string($conn, $_POST['details']);

                        if (!empty($p_name) && !empty($p_type) && !empty($p_details)) {
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_page WHERE page_name='$p_name' && type='$p_type' && text='$p_details' && id != '$page_id'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "Page Already exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                $qry = mysqli_query($conn, "UPDATE tbl_page SET page_name='$p_name', type='$p_type', text='$p_details' WHERE id='$page_id'") or die(mysqli_error($conn));
                                $msg = "Page Updated Successfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            }
                            
                            
                        } else {
                            $msg = "Page fields must not be Null";
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
                                <p>Edit Page</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>selected page</p>
                                        <div class="right-btns">
                                            <a href="page.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            $page_name = "";
                                            $page_type = "";
                                            $page_details = "";
                        
                                            $qry = mysqli_query($conn, "SELECT * FROM tbl_page WHERE id='$page_id'") or die(mysqli_error($conn));
                                            while ($page = mysqli_fetch_array($qry)) {
                                                $page_name = $page['page_name'];
                                                $page_type =$page['type'];
                                                $page_details = $page['text'];
                                            }
                                        ?>
                                        <form action="" method="post">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Page Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" id="" placeholder="Page Name" value="<?php echo htmlentities($page_name); ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Page Type <span class="text-danger">*</span></label>
                                                        <input type="text" name="type" id="" placeholder="Page type" value="<?php echo htmlentities($page_type); ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <label for="">Page Details <span class="text-danger">*</span></label>
                                                        <textarea name="details" id="" rows="4" placeholder="Page Details">
                                                            <?php echo htmlentities($page_type); ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="update_page" class="btn btn-primary btn-sm">UPDATE</button>
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