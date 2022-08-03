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
                <title>Restaurant || Edit Type</title>
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

                    if (isset($_POST['update_type'])) {
                        $type = mysqli_real_escape_string($conn, $_POST['type']);

                        if (!empty($type)) {
                            $qry = mysqli_query($conn, "SELECT item_type FROM tbl_item_type WHERE item_type='$type' && id != '$id'") or die(mysqli_error($conn));
                            if (mysqli_num_rows($qry) > 0) {
                                $msg = "Item Type already exists";
                                $msgClass = "danger";
                                $msgIcon = "exclamation-triangle";
                            } else {
                                mysqli_query($conn, "UPDATE tbl_item_type SET item_type='$type' WHERE id='$id'") or die(mysqli_fetch_array($conn));
                                $msg = "Item Type Updated Successfully";
                                $msgClass = "success";
                                $msgIcon = "check-double";
                            }
                            
                        } else {
                            $msg = "Fill item type";
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
                                <p>Edit Item Type</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card md-4">
                                    <div class="card-header">
                                        <p>selected type</p>
                                        <div class="right-btns">
                                            <a href="itemtype.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <?php
                                                        $item_type = "";

                                                        $qry = mysqli_query($conn, "SELECT item_type FROM tbl_item_type WHERE id='$id'") or die(mysqli_error($conn));
                                                        while ($row = mysqli_fetch_array($qry)) {
                                                            $item_type = $row['item_type'];
                                                        }
                                                    ?>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Item Type <span class="text-danger">*</span></label>
                                                        <input type="text" name="type" id="" placeholder="Item Type" value="<?php echo htmlentities($item_type); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm" name="update_type">ADD</button>
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