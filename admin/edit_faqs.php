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
                <title>Restaurant || Edit FAQs</title>
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

                    $fa_id = $_GET['id'];

                    if (isset($_POST['update_faqs'])) {
                        $category = mysqli_real_escape_string($conn, $_POST['category']);
                        $question = mysqli_real_escape_string($conn, $_POST['question']);
                        $answer = mysqli_real_escape_string($conn, $_POST['answer']);

                        if (!empty($category) && !empty($question) && !empty($answer)) {
                            
                            $qry = mysqli_query($conn, "UPDATE tbl_faqs SET category='$category', question='$question', answer='$answer' WHERE id='$fa_id'") or die(mysqli_error($conn));
                            $msg = "Faqs Updated Successfully";
                            $msgClass = "success";
                            $msgIcon = "check-double";
                            
                            
                        } else {
                            $msg = "Faqs Field must not be Null";
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
                                <p>Edit FAQs</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <p>selected faqs</p>
                                        <div class="right-btns">
                                            <a href="faqs.php" class="btn btn-sm" id="btnrecent"><i class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            $faq_category = "";
                                            $faq_question = "";
                                            $faq_answer = "";
                                            $qry = mysqli_query($conn, "SELECT * FROM tbl_faqs WHERE id='$fa_id'") or die(mysqli_error($conn));
                                            while ($row = mysqli_fetch_array($qry)) {
                                                $faq_category = $row['category'];
                                                $faq_question = $row['question'];
                                                $faq_answer = $row['answer'];
                                            }
                                        ?>
                                        <form action="" method="post">
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Category <span class="text-danger">*</span></label>
                                                        <select name="category" id="">
                                                            <?php
                                                                $qry = mysqli_query($conn, "SELECT * FROM tbl_faqs_category") or die(mysqli_error($conn));
                                                                while ($faqs = mysqli_fetch_array($qry)) {
                                                                    ?>
                                                                        <option value="<?php echo htmlentities($faqs['id']); ?>" <?php if ($faq_category == $faqs['id']) { echo "selected"; } ?>><?php echo htmlentities($faqs['category']); ?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label for="">Question <span class="text-danger">*</span></label>
                                                        <input type="text" name="question" id="" placeholder="Faqs Question" value="<?php echo htmlentities($faq_question); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="grp">
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <label for="">Answer <span class="text-danger">*</span></label>
                                                        <textarea name="answer" id="" rows="10" placeholder="faqs answer">
                                                            <?php echo htmlentities($faq_answer); ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="update_faqs" class="btn btn-primary btn-sm">UPDATE</button>
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