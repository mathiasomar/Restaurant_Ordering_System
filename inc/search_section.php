<section class="search-section">
    <div class="form-container">
        <form action="search.php" method="POST">
            <div class="form-group" id="grp">
                <input type="text" name="search" id="" placeholder="Search Menus or Foods..." value="<?php if (isset($_POST['search'])) {echo $_POST['search'];} ?>">
                <button type="submit" name="submit" id="btnSrch">search</button>
            </div>
        </form>
    </div>
</section>