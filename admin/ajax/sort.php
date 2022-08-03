<?php
    include '../connection.php';
    session_start();

    $order = $_POST['order'];
    if ($order == 'desc') {
        $order = 'asc';
    } else {
        $order = 'desc';
    }

    if (isset($_POST['admincolumn'])) {
        $qry = mysqli_query($conn, "SELECT * FROM tbl_user ORDER BY ".$_POST['admincolumn']." ".$_POST['order']."") or die(mysqli_error($conn));
        ?>
            <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                <thead>
                    <tr>
                    <th><button class="column_sort" data-order="<?php echo $order; ?>" id="username" title="click to sort"><span>Username</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                    <th><button class="column_sort" data-order="<?php echo $order; ?>" id="email" title="click to sort"><span>Email</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                    <th><button class="column_sort" data-order="<?php echo $order; ?>" id="phone" title="click to sort"><span>Phone</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                    <th><button class="column_sort" data-order="<?php echo $order; ?>" id="role" title="click to sort"><span>Role</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                    <th><button class="column_sort" data-order="<?php echo $order; ?>" id="status" title="click to sort"><span>Status</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                    <th><button class="column_sort" data-order="<?php echo $order; ?>" id="updatedate" title="click to sort"><span>Last Updated</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($user = mysqli_fetch_array($qry)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlentities($user['username']); ?></td>
                                    <td><?php echo htmlentities($user['email']); ?></td>
                                    <td><?php echo htmlentities($user['phone']); ?></td>
                                    <td><?php echo htmlentities($user['role']); ?></td>
                                    <td>
                                        <?php if ($user['status'] == 1): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($user['updatedate'] == NULL): ?>
                                            Not yet updated
                                        <?php else: ?>
                                            <?php echo htmlentities($user['updatedate']); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit_user.php?id=<?php echo htmlentities($user['id']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                        <?php
                                            if ($user['status'] == 1) {
                                                ?>
                                                    <a href="user.php?deact=<?php echo htmlentities($user['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Deactivate user')">Deactivate</a>
                                                <?php
                                            } else {
                                                ?>
                                                    <a href="user.php?act=<?php echo htmlentities($user['id']); ?>" class="badge bg-primary"  onclick="return confirm('Confirm, Activate user')">Activate</a>
                                                <?php
                                            }
                                            
                                        ?>
                                        <?php
                                            if ($user['email'] !== $_SESSION['useremail']) {
                                                ?>
                                                    <a href="user.php?del=<?php echo htmlentities($user['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Delete user')"><i class="fas fa-trash-alt"></i></a>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }

    if (isset($_POST['menu_column'])) {
        $qry = mysqli_query($conn, "SELECT * FROM tbl_menu ORDER BY ".$_POST['menu_column']." ".$_POST['order']."");
        ?>
            <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                <thead>
                    <tr>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="menu_image" title="click to sort"><span>Menu Image</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="menu_name" title="click to sort"><span>Menu Name</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="punchline" title="click to sort"><span>Punch Line</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="status" title="click to sort"><span>Status</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($menu = mysqli_fetch_array($qry)) {
                            ?>
                                <tr>
                                    <td><img src="uploaded_images/<?php echo htmlentities($menu['menu_image']); ?>" alt=""></td>    
                                    <td><?php echo htmlentities($menu['menu_name']); ?></td>
                                    <td><?php echo htmlentities($menu['punchline']); ?></td>
                                    <td>
                                        <?php if ($menu['status'] == 1): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit_menu.php?id=<?php echo htmlentities($menu['id']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                        <a href="menu.php?del=<?php echo htmlentities($menu['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Delete menu')"><i class="fas fa-trash-alt"></i></a>
                                        <?php if ($menu['status'] == 1): ?>
                                            <a href="menu.php?deact=<?php echo htmlentities($menu['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Deativate Menu')">Deactivate</a>
                                        <?php else: ?>
                                            <a href="menu.php?act=<?php echo htmlentities($menu['id']); ?>" class="badge bg-primary" onclick="return confirm('Confirm, Activate menu')">Activate</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }

    if (isset($_POST['type_column'])) {
        $qry = mysqli_query($conn, "SELECT * FROM tbl_item_type ORDER BY ".$_POST['type_column']." ".$_POST['order']."") or die(mysqli_error($conn));
        ?>
            <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                <thead>
                    <tr>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="item_type" title="click to sort"><span>Item Type</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($type = mysqli_fetch_array($qry)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlentities($type['item_type']); ?></td>
                                    <td>
                                        <a href="edit_type.php?id=<?php echo htmlentities($type['id']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                        <a href="itemtype.php?del=<?php echo htmlentities($type['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Delete Item Type')"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }

    if (isset($_POST['item_column'])) {
        $qry = mysqli_query($conn, "SELECT tbl_menu.menu_name, tbl_item.*, tbl_item_type.item_type FROM tbl_item JOIN tbl_menu ON tbl_menu.id=tbl_item.menu_id JOIN tbl_item_type ON tbl_item_type.id=tbl_item.item_type_id ORDER BY ".$_POST['item_column']." ".$_POST['order']."") or die(mysqli_error($conn));
        ?>
            <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                <thead>
                    <tr>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="menu_name" title="click to sort"><span>Menu Name</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="item_name" title="click to sort"><span>Item Name</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="item_cost" title="click to sort"><span>Item Price</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="item_type" title="click to sort"><span>Item Type</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="item_image" title="click to sort"><span>Item Image</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($item = mysqli_fetch_array($qry)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlentities($item['menu_name']); ?></td>
                                    <td><?php echo htmlentities($item['item_name']); ?></td>
                                    <td><?php echo htmlentities($item['item_cost']); ?></td>
                                    <td><?php echo htmlentities($item['item_type']); ?></td>
                                    <td><img src="uploaded_images/<?php echo htmlentities($item['item_image']); ?>" alt=""></td>
                                    <td>
                                        <?php if ($item['status'] == 1): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit_item.php?id=<?php echo htmlentities($item['id']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                        <a href="item.php?del=<?php echo htmlentities($item['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Delete Item')"><i class="fas fa-trash-alt"></i></a>
                                        <?php if ($item['status'] == 1): ?>
                                            <a href="item.php?deact=<?php echo htmlentities($item['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Deactivate Item')">Deactivate</a>
                                        <?php else: ?>
                                            <a href="item.php?act=<?php echo htmlentities($item['id']); ?>" class="badge bg-primary" onclick="return confirm('Confirm, Activate Item')">Activate</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }

    if (isset($_POST['addon_column'])) {
        $qry =  mysqli_query($conn, "SELECT * FROM tbl_addons ORDER BY ".$_POST['addon_column']." ".$_POST['order']."") or die(mysqli_error($_conn));
        ?>
            <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                <thead>
                    <tr>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="addon_name" title="click to sort"><span>Addon Name</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="price" title="click to sort"><span>Price</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="addon_image" title="click to sort"><span>Addon Image</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($addon = mysqli_fetch_array($qry)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlentities($addon['addon_name']); ?></td>
                                    <td><?php echo htmlentities($addon['price']); ?></td>
                                    <td><img src="uploaded_images/<?php echo htmlentities($addon['addon_image']); ?>" alt=""></td>
                                    <td>
                                        <?php if ($addon['status'] == 1): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit_addon.php?id=<?php echo htmlentities($addon['id']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                        <a href="addons.php?del=<?php echo htmlentities($addon['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Delete Addon')"><i class="fas fa-trash-alt"></i></a>
                                        <?php if($addon['status'] == 1): ?>
                                            <a href="addons.php?deact=<?php echo htmlentities($addon['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Deactivate Addon')">Deactivate</a>
                                        <?php else: ?>
                                            <a href="addons.php?act=<?php echo htmlentities($addon['id']); ?>" class="badge bg-success" onclick="return confirm('Confirm, Activate Addon')">Activate</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }

    if (isset($_POST['offer_column'])) {
        $qry =  mysqli_query($conn, "SELECT * FROM tbl_offer ORDER BY ".$_POST['offer_column']." ".$_POST['order']."") or die(mysqli_error($_conn));
        ?>
            <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                <thead>
                    <tr>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="offer_name" title="click to sort"><span>Offer Name</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="offer_cost" title="click to sort"><span>Offer Price</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="offer_start_date" title="click to sort"><span>Offer Start Date</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="offer_valid_date" title="click to sort"><span>Offer Valid Date</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th>No Of Items</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($offer = mysqli_fetch_array($qry)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlentities($offer['offer_name']); ?></td>
                                    <td><?php echo htmlentities($offer['offer_cost']); ?></td>
                                    <td><?php echo htmlentities($offer['offer_start_date']); ?></td>
                                    <td><?php echo htmlentities($offer['offer_valid_date']); ?></td>
                                    <td>
                                        <?php
                                            $sql = mysqli_query($conn, "SELECT * FROM tbl_offer_items WHERE offer_id=".$offer['id']."") or die(mysqli_error($conn));
                                            echo mysqli_num_rows($sql);
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($offer['status'] == 1): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit_offer.php?id=<?php echo htmlentities($offer['id']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                        <a href="offers.php?del=<?php echo htmlentities($offer['id']); ?>" class="badge bg-danger"><i class="fas fa-trash-alt"></i></a>
                                        <a href="add_offer_item.php?id=<?php echo htmlentities($offer['id']); ?>" class="badge bg-primary"><i class="fas fa-plus"></i></a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }

    if (isset($_POST['page_column'])) {
        $qry =  mysqli_query($conn, "SELECT * FROM tbl_page ORDER BY ".$_POST['page_column']." ".$_POST['order']."") or die(mysqli_error($_conn));
        ?>
            <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                <thead>
                    <tr>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="page_name" title="click to sort"><span>Page Name</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="type" title="click to sort"><span>Page Name</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($page = mysqli_fetch_array($qry)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlentities($page['page_name']); ?></td>
                                    <td><?php echo htmlentities($page['type']); ?></td>
                                    <td>
                                        <a href="edit_page.php?id=<?php echo htmlentities($page['id']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }

    if (isset($_POST['order_column'])) {
        $qry = mysqli_query($conn, "SELECT tbl_orders.*, tbl_customers.cus_name, tbl_customers.cus_phone, tbl_item.item_name, tbl_item.item_cost FROM tbl_orders JOIN tbl_customers ON tbl_orders.customer=tbl_customers.id JOIN tbl_item ON tbl_orders.order_item=tbl_item.id ORDER BY ".$_POST['order_column']." ".$_POST['order']."") or die(mysqli_error($conn));
        ?>
                <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                    <thead>
                        <tr>
                            <th>S No</th>
                            <th><button class="column_sort" data-order="<?php echo $order; ?>" id="order_no" title="click to sort"><span>Order No</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                            <th><button class="column_sort" data-order="<?php echo $order; ?>" id="order_date" title="click to sort"><span>Order Date</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                            <th><button class="column_sort" data-order="<?php echo $order; ?>" id="order_time" title="click to sort"><span>Order Time</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                            <th><button class="column_sort" data-order="<?php echo $order; ?>" id="item_name" title="click to sort"><span>Order Item</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                            <th>Order Cost</th>
                            <th><button class="column_sort" data-order="<?php echo $order; ?>" id="cus_name" title="click to sort"><span>Customer Name</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                            <th><button class="column_sort" data-order="<?php echo $order; ?>" id="order_for" title="click to sort"><span>Order For</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sr = 1;
                            while ($order = mysqli_fetch_array($qry)) {
                                ?>
                                    <tr>
                                        <td><?php echo htmlentities($sr); ?></td>
                                        <td><?php echo htmlentities($order['order_no']); ?></td>
                                        <td><?php echo htmlentities($order['order_date']); ?></td>
                                        <td><?php echo htmlentities($order['order_time']); ?></td>
                                        <td><?php echo htmlentities($order['item_name']); ?></td>
                                        <td>Ksh. <?php echo htmlentities($order['item_cost']); ?></td>
                                        <td><?php echo htmlentities($order['cus_name']); ?></td>
                                        <td><?php echo htmlentities($order['order_for']); ?></td>
                                        <td>
                                            <?php if ($order['status'] == 1): ?>
                                                <span class="badge bg-warning">Pending</span>
                                            <?php elseif ($order['status'] == 2): ?>
                                                <span class="badge bg-primary">Confirmed</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Paid</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="view_order.php?id=<?php echo htmlentities($order['id']); ?>" class="badge bg-primary"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                $sr += 1;
                            }
                        ?>
                    </tbody>
                </table>
        <?php
    }

    if (isset($_POST['fc_column'])) {
        $qry = mysqli_query($conn, "SELECT * FROM tbl_faqs_category ORDER BY ".$_POST['fc_column']." ".$_POST['order']."") or die(mysqli_error($conn));
        ?>
                <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                    <thead>
                        <tr>
                            <th><button class="column_sort" data-order="<?php echo $order; ?>" id="category" title="click to sort"><span>Category</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($cat = mysqli_fetch_array($qry)) {
                                ?>
                                    <tr>
                                        <td><?php echo htmlentities($cat['category']); ?></td>
                                        <td>
                                            <?php if ($cat['status'] == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit_faqs_category.php?id=<?php echo htmlentities($cat['id']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                            <a href="faqs_category.php?del=<?php echo htmlentities($cat['id']); ?>" class="badge bg-danger"><i class="fas fa-trash-alt"></i></a>
                                            <?php if ($cat['status'] == 1): ?>
                                                <a href="faqs_category.php?deact=<?php echo htmlentities($cat['id']); ?>" class="badge bg-danger">Deactivate</a>
                                            <?php else: ?>
                                                <a href="faqs_category.php?act=<?php echo htmlentities($cat['id']); ?>" class="badge bg-primary">Activate</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
        <?php
    }

    if (isset($_POST['faqs_column'])) {
        $qry = mysqli_query($conn, "SELECT tbl_faqs.*, tbl_faqs_category.category FROM tbl_faqs JOIN tbl_faqs_category ON tbl_faqs.category=tbl_faqs_category.id ORDER BY ".$_POST['faqs_column']." ".$_POST['order']."") or die(mysqli_error($conn));
        ?>
                <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                    <thead>
                        <tr>
                            <th><button class="column_sort" data-order="<?php echo $order; ?>" id="tbl_faqs_category.category" title="click to sort"><span>Category</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                            <th>Question</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($faqs = mysqli_fetch_array($qry)) {
                                ?>
                                    <tr>
                                        <td><?php echo htmlentities($faqs['category']); ?></td>
                                        <td><?php echo htmlentities($faqs['question']); ?></td>
                                        <td>
                                            <?php if ($faqs['status'] == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit_faqs.php?id=<?php echo htmlentities($faqs['category']); ?>" class="badge bg-success"><i class="fas fa-edit"></i></a>
                                            <!--<a href="faqs.php?del=<?php //echo htmlentities($faqs['category']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Delete Faqs')"><i class="fas fa-trash-alt"></i></a>-->
                                            <?php if ($faqs['status'] == 1): ?>
                                            <a href="faqs.php?deact=<?php echo htmlentities($faqs['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Deactivate Faqs')">Deactivate</a>
                                            <?php else: ?>
                                                <a href="faqs.php?act=<?php echo htmlentities($faqs['id']); ?>" class="badge bg-primary" onclick="return confirm('Confirm, Activate Faqs')">Activate</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
        <?php
    }

    if (isset($_POST['test_column'])) {
        $qry = mysqli_query($conn, "SELECT tbl_testimonial.*, tbl_customers.cus_name FROM tbl_testimonial JOIN tbl_customers ON tbl_testimonial.customer_id=tbl_customers.id ORDER BY ".$_POST['test_column']." ".$_POST['order']."") or die(mysqli_error($conn));
        ?>
            <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                <thead>
                    <tr>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="cus_name" title="click to sort"><span>Customer</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="testimonial" title="click to sort"><span>Testimonial</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($test = mysqli_fetch_array($qry)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlentities($test['cus_name']); ?></td>
                                    <td><?php echo htmlentities($test['testimonial']); ?></td>
                                    <td>
                                        <?php if ($test['status'] == 1): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($test['status'] == 1): ?>
                                        <a href="testimonial.php?deact=<?php echo htmlentities($test['id']); ?>" class="badge bg-danger" onclick="return confirm('Confirm, Deactivate Testimonial')">Deactivate</a>
                                        <?php else: ?>
                                            <a href="testimonial.php?act=<?php echo htmlentities($test['id']); ?>" class="badge bg-primary" onclick="return confirm('Confirm, Activate Testimonial')">Activate</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }

    if (isset($_POST['query_column'])) {
        $qry = mysqli_query($conn, "SELECT * FROM tbl_contactus_query ORDER BY ".$_POST['query_column']." ".$_POST['order']."") or die(mysqli_error($conn));
        ?>
            <table class="table table-responsive table-striped table-bordered table-hover text-center" id="tbl">
                <thead>
                    <tr>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="email" title="click to sort"><span>Email</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="phone" title="click to sort"><span>Phone</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th>Message</th>
                        <th>Status</th>
                        <th><button class="column_sort" data-order="<?php echo $order; ?>" id="postdate" title="click to sort"><span>Date</span><span><i class="fas fa-exchange-alt" style="transform: rotate(90deg);"></i></span></button></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($query = mysqli_fetch_array($qry)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlentities($query['email']); ?></td>
                                    <td><?php echo htmlentities($query['phone']); ?></td>
                                    <td><?php echo htmlentities($query['message']); ?></td>
                                    <td>
                                        <?php if ($query['status'] == 1): ?>
                                            <span class="badge bg-warning">Pending</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Readed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlentities($query['postdate']); ?></td>
                                    <td>
                                        <?php if ($query['status'] == 1): ?>
                                        <a href="contactus_query.php?read=<?php echo htmlentities($query['id']); ?>" class="badge bg-primary">Read</a>
                                        <?php else: ?>
                                            <i>Marked</i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }
    
?>