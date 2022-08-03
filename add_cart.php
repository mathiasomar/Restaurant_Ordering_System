<?php
    include 'admin/connection.php';
    session_start();
    $username = $_SESSION['username'];
    $customer_id = "";
    $qry = mysqli_query($conn, "SELECT * FROM tbl_customers WHERE cus_name='$username'");
    while ($row = mysqli_fetch_array($qry)) {
        $customer_id = $row['id'];
    }

    $menu_id = $_GET['id'];
    $item_id = $_GET['item_id'];

    $order_no = 'RTC';
    $order_no .= mt_rand(100000, 999999);
    $status = 1;
    $order_for = 'self';
    $date = date("Y-m-d");
    $time = date("h:i:sa");
    mysqli_query($conn, "INSERT INTO tbl_orders VALUES(NULL, '$order_no', '$date', '$time', '$item_id', '$customer_id', '$order_for', '$status')") or die(mysqli_error($conn));

    header('Location:menu_items.php?id='.$menu_id);
?>