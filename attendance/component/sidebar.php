<?php
require_once './database/db_connection.php';
$query = "SELECT id, name FROM zone ORDER BY name ASC";
$result = $conn->query($query);

// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"></i>LIB TEMP</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img src="img/user.jpg" class="rounded-circle" alt="" style="width: 40px; height: 40px;" />
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">
                    <?php
                    if (isset($_SESSION['admin_name'])) {
                        echo $_SESSION['admin_name'];
                    } else {
                        echo "user";
                    }
                    ?>
                </h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a href="add_zone.php" class="nav-item nav-link <?php echo $current_page == 'add_zone.php' ? 'active' : ''; ?>">
                <i class="fa fa-keyboard me-2"></i>Create Zone
            </a>
            <a href="zoneList.php" class="nav-item nav-link <?php echo $current_page == 'zoneList.php' ? 'active' : ''; ?>">
                <i class="fa fa-table me-2"></i>Manage Zone
            </a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php echo in_array($current_page, ['zone.php']) ? 'active' : ''; ?>" data-bs-toggle="dropdown">
                    <i class="fa fa-laptop me-2"></i>Zones
                </a>
                <div class="dropdown-menu bg-transparent border-0">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<a href="zone.php?id=' . $row["id"] . '" class="dropdown-item">' . htmlspecialchars($row["name"]) . '</a>';
                        }
                    } else {
                        echo '<a href="#" class="dropdown-item">No zones available</a>';
                    }
                    ?>
                </div>
            </div>
            <a href="add_member.php" class="nav-item nav-link <?php echo $current_page == 'add_member.php' ? 'active' : ''; ?>">
                <i class="fa fa-th me-2"></i>Add Member
            </a>


        </div>
</div>
</nav>
</div>