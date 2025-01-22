<?php
require_once "./database/db_connection.php";

// Check if the ID is set in the URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// Get the attendance ID from the URL
$attendance_id = intval($_GET['id']);

// Fetch the current attendance data
$query = "SELECT * FROM attendace WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $attendance_id);
$stmt->execute();
$result = $stmt->get_result();
$attendance = $result->fetch_assoc();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $is_present = isset($_POST['is_present']) ? 1 : 0;
    $reason = $_POST['reason'];

    // Update the attendance record
    $updateQuery = "UPDATE attendace SET title = ?, is_present = ?, reason = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sisi", $title, $is_present, $reason, $attendance_id);
    if ($updateStmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<?php require_once "component/header.php"; ?>
<?php require_once "utils/isLoggedIn.php"; ?>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <?php require_once "component/sidebar.php"; ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php require_once "component/navbar.php"; ?>
            <!-- Navbar End -->

            <!-- Edit Attendance Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Edit Attendance</h6>
                            <form method="post" action="">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <select class="form-select" id="title" name="title" required>
                                        <option value="Sunday Service" <?php echo ($attendance['title'] == 'Sunday Service') ? 'selected' : ''; ?>>Sunday Service</option>
                                        <option value="Midweek Service" <?php echo ($attendance['title'] == 'Midweek Service') ? 'selected' : ''; ?>>Midweek Service</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="is_present" class="form-label">Presence</label>
                                    <input type="checkbox" id="is_present" name="is_present" <?php echo ($attendance['is_present'] == 1) ? 'checked' : ''; ?>>
                                </div>
                                <div class="mb-3">
                                    <label for="reason" class="form-label">Reason</label>
                                    <input type="text" class="form-control" id="reason" name="reason" value="<?php echo htmlspecialchars($attendance['reason']); ?>">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Attendance Form End -->

        </div>
        <!-- Content End -->

        <!-- JavaScript Libraries -->
        <?php require_once "component/script.php"; ?>
    </div>
</body>

</html>