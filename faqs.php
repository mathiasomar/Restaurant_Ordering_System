<?php
    include 'admin/connection.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant || FAQs</title>
    <link rel="icon" href="assets/images/IMG-20220419-WA0001.jpg">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!--Navbar-->
    <?php include 'inc/navbar.php'; ?>
    <!--/Navbar-->

    <!--Main Section-->
    <main>
        <!--Banner-->
        <div class="banner2">
            <img src="admin/assets/images/fbg.jpg" alt="" class="image-responsive">
            <div class="banner_title">
                <h1>FAQs</h1>
                <p><a href="<?php echo ROOT_URL2; ?>">Home</a> / FAQs</p>
            </div>
        </div>
        <!--/Banner-->

        <!--Pages Info-->
        <section class="pages_info">
            <div class="container">
            <div class="section-header mb-5">
                    <div class="header-text">
                        <h5>FAQs</h5>
                    </div>
                </div>
                <div class="panel mb-5">
                    <div class="panel-body text-center">
                        <?php
                            $status = 1;
                            $qry = mysqli_query($conn, "SELECT * FROM tbl_faqs_category WHERE status='$status'") or die(mysqli_error($conn));
                            while ($cat = mysqli_fetch_array($qry)) {
                                ?>
                                    <div class="faqs_title mt-4">
                                        <div class="q_text"><?php echo htmlentities($cat['category']); ?></div>
                                        <div class="q_dropdown_btn">
                                            <span class="fas fa-angle-right"></span>
                                        </div>
                                    </div>
                                    <div class="faqs_q">
                                    <?php
                                        $status = 1;
                                        $qry2 = mysqli_query($conn, "SELECT * FROM tbl_faqs WHERE status='$status' && category=".$cat['id']."");
                                        while ($row = mysqli_fetch_array($qry2)) {
                                            ?>
                                                <div class="faqs_question">
                                                    <strong><?php echo htmlentities($row['question']); ?></strong>
                                                    <hr>
                                                    <p>- <?php echo htmlentities($row['answer']); ?></p>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!--/Pages Info-->

        <!--Footer-->
        <?php include 'inc/footer.php'; ?>
        <!--/Footer-->

        <!--LoginForm-->
        <?php include 'inc/loginform.php'; ?>
        <!--/LoginForm-->
    </main>
    <!--/Main Section-->

    <!--To Top Button-->
    <div class="top-btn" id="top">
        <i class="fas fa-caret-up"></i>
    </div>
    <!--/To Top Button-->

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/mainjs.js"></script>
    <script src="assets/js/click.js"></script>
    <script>
        $(document).ready(function () {
            $('.banner2 .banner_title').css({'opacity':'1', 'transform':'translateY(0)', 'transition-delay':'0.5s'});
        });

        var fqsbtn = document.getElementsByClassName('faqs_title');
        for (var j=0; j<fqsbtn.length; j++) {
            fqsbtn[j].addEventListener('click', function () {
                this.classList.toggle('qtactive');
                this.nextElementSibling.classList.toggle('qqactive');
            })
        }

        /*$(document).ready(function () {
            $(document).on('click', '.faqs_title', function () {
                $('.faqs_q').slideToggle('slow');
            });
        });*/
    </script>
</body>
</html>