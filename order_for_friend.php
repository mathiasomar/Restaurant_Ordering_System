<?php
    include 'admin/connection.php';
    session_start();

    if (isset($_POST['submit_order'])) {
        $friend = mysqli_real_escape_string($conn, $_POST['fname']);
        $username = $_SESSION['username'];
        $customer_id = "";
        $qry = mysqli_query($conn, "SELECT * FROM tbl_customers WHERE cus_name='$username'");
        while ($row = mysqli_fetch_array($qry)) {
            $customer_id = $row['id'];
        }

        $menu_id = $_GET['id'];
        $item_id = $_GET['item_id'];
        $order_for = 'self';

        date_default_timezone_set("Africa/Nairobi");
        $date = date("Y-m-d");
        $time = date("h:i:sa");
        $str_date = $date;

        $qry2 = mysqli_query($conn, "SELECT * FROM tbl_orders WHERE customer='$customer_id' && order_for != '$order_for'") or die(mysqli_error($conn));
        if (mysqli_num_rows($qry2) == 1) {
            ?>
                <script>
                    alert("Sorry you have ordered the maximum number of friend for today");
                </script>
            <?php
        } else {
            $order_no = 'RTC';
            $order_no .= mt_rand(100000, 999999);
            $status = 1;
            mysqli_query($conn, "INSERT INTO tbl_orders VALUES(NULL, '$order_no', '$date', '$time', '$item_id', '$customer_id', '$friend', '$status')") or die(mysqli_error($conn));

            header('Location:menu_items.php?id='.$menu_id);
        }
        

        $order_no = 'RTC';
        $order_no .= mt_rand(100000, 999999);
        $status = 1;
        mysqli_query($conn, "INSERT INTO tbl_orders VALUES(NULL, '$order_no', '$date', '$time', '$item_id', '$customer_id', '$friend', '$status')") or die(mysqli_error($conn));

        header('Location:menu_items.php?id='.$menu_id);
    }
?>