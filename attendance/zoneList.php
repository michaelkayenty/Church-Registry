<?php
require_once "./database/db_connection.php";

// Fetch all zones from the database
$query_zones = "SELECT z.id, z.name, z.location, a.username as admin_name FROM zone z JOIN admin a ON z.admi_id = a.id ORDER BY z.name ASC";
$result_zones = $conn->query($query_zones);

$zones = [];
if ($result_zones->num_rows > 0) {
    while ($row = $result_zones->fetch_assoc()) {
        $zones[] = $row;
    }
}
?>

<?php require_once "component/header.php"; ?>
<?php require_once "utils/isLoggedIn.php"; ?>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php require_once "component/sidebar.php"; ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php require_once "component/navbar.php"; ?>
            <!-- Navbar End -->

            <!-- Zone List Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Zone List</h6>
                        <a href="add_zone.php" class="btn btn-sm btn-primary">Add New Zone</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Zone Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Zone Leader</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($zones) > 0) {
                                    foreach ($zones as $zone) {
                                        echo "<tr>
                                            <td>" . htmlspecialchars($zone['name']) . "</td>
                                            <td>" . htmlspecialchars($zone['location']) . "</td>
                                            <td>" . htmlspecialchars($zone['admin_name']) . "</td>
                                            <td>
                                                <a class='btn btn-sm btn-primary' href='edit_zone.php?id=" . $zone['id'] . "'>Edit</a>
                                                <a class='btn btn-sm btn-danger' href='logic/delete_zone.php?id=" . $zone['id'] . "'>Delete</a>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No zones found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Zone List End -->

            <!-- Footer Start -->
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <?php require_once "component/script.php"; ?>
</body>

</html>