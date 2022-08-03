<?php
    include '../connection.php';
    $menu_id = $_POST['id'];
    
    $qry = mysqli_query($conn, "SELECT * FROM tbl_item WHERE menu_id='$menu_id'") or die(mysqli_error($conn));
    if (mysqli_num_rows($qry) > 0) {
        ?>
            <label for="">Item Name <span class="text-danger">*</span></label>
            <select name="item">
                <?php
                    while ($item = mysqli_fetch_array($qry)) {
                        ?>
                            <option value="<?php echo htmlentities($item['id']); ?>"><?php echo htmlentities($item['item_name']); ?></option>
                        <?php
                    }
                ?>
            </select>
        <?php
    } else {
        ?>
            <label for="">Item Name <span class="text-danger">*</span></label>
            <select name="item" id="itemid" disabled>
                <option value="">No Item in this Menu</option>
            </select>
        <?php
    }

?>