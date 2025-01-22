<?php
require_once "./database/db_connection.php";

// Get the zone ID from the query parameter
$zone_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch zone data based on the zone_id
$query_zone = "SELECT * FROM zone WHERE id = ?";
$stmt = $conn->prepare($query_zone);
$stmt->bind_param("i", $zone_id);
$stmt->execute();
$result = $stmt->get_result();
$zone = $result->fetch_assoc();

// Fetch all admins for the dropdown
$query_admins = "SELECT id, username FROM admin";
$result_admins = $conn->query($query_admins);
$admins = [];
if ($result_admins->num_rows > 0) {
    while ($row = $result_admins->fetch_assoc()) {
        $admins[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $admi_id = $_POST['admi_id'];

    // Update the zone
    $update_query = "UPDATE zone SET name = ?, location = ?, admi_id = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssii", $name, $location, $admi_id, $zone_id);

    if ($stmt->execute()) {
        header("Location: zoneList.php");
        exit();
    } else {
        echo "Error updating zone: " . $conn->error;
    }
}
?>

<?php require_once "component/header.php"; ?>
<?php require_once "utils/isLoggedIn.php"; ?>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- (Your existing spinner code here) -->
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php require_once "component/sidebar.php"; ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php require_once "component/navbar.php"; ?>
            <!-- Navbar End -->

            <!-- Edit Zone Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Edit Zone</h6>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Zone Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($zone['name']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($zone['location']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="admi_id" class="form-label">Admin</label>
                                    <select class="form-select" id="admi_id" name="admi_id" required>
                                        <?php
                                        foreach ($admins as $admin) {
                                            echo "<option value='" . $admin['id'] . "'" . ($zone['admi_id'] == $admin['id'] ? ' selected' : '') . ">" . htmlspecialchars($admin['username']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Zone</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Zone Form End -->

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