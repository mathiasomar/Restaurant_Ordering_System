<nav class="navbar">
    <div class="menu-bars" id="bars" onclick="toggleSidebar()">
        <span class="fas fa-bars"></span>
    </div>

    <div class="account-section">
        <div class="info">
            <?php if (isset($_SESSION['useremail'])): ?>
            <p>Welcome, <?php echo htmlentities($_SESSION['useremail']); ?> <span class="fas fa-angle-down" id="drop"></span></p>
            <?php else: ?>
            <p>Login</p>    
            <?php endif; ?>
            <div class="notification-alert">
                <ul>
                    <li>
                        <a href="#"><label for="check"><i class="fas fa-bell"></i></label></a>
                        <span class="badge bg-danger" id="alertNo">10</span>
                        <input type="checkbox" class="dropdown-check" name="" id="check">
                        <ul class="drop-alert">
                            <li>Notification 1</li>
                            <li>Notification 2</li>
                            <li>Notification 3</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>