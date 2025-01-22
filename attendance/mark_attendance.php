<?php
require_once "./database/db_connection.php";

$zone_id = isset($_GET['zone_id']) ? intval($_GET['zone_id']) : 0;

// Fetch the zone name (optional)
$zone_query = "SELECT name FROM zone WHERE id = ?";
$zone_stmt = $conn->prepare($zone_query);
$zone_stmt->bind_param("i", $zone_id);
$zone_stmt->execute();
$zone_result = $zone_stmt->get_result();
$zone_name = $zone_result->num_rows > 0 ? $zone_result->fetch_assoc()['name'] : '';

// Fetch members for the selected zone
$members = [];
if ($zone_id > 0) {
    $query = "SELECT * FROM members WHERE zone_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $zone_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $attendance = $_POST['attendance']; // Array of member_id => is_present
    $reasons = $_POST['reason']; // Array of member_id => reason

    if ($zone_id > 0 && !empty($title) && !empty($date)) {
        // Prepare the SQL statement for inserting attendance records
        $query = "INSERT INTO attendace (is_present, zone_id, member_id, title, reason) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        foreach ($members as $member) {
            $member_id = $member['id'];
            // Check if member ID is in the attendance array to determine presence
            $is_present = isset($attendance[$member_id]) ? 1 : 0;
            // Get the reason if not present
            $reason = isset($reasons[$member_id]) ? $reasons[$member_id] : '';

            // Bind parameters and execute the query
            $stmt->bind_param("iiiss", $is_present, $zone_id, $member_id, $title, $reason);
            $stmt->execute();
        }

        // Redirect after successful submission
        header('Location: mark_attendance.php?zone_id=' . $zone_id . '&success=1');
        exit();
    } else {
        // Handle errors: You might want to display a message to the user
        echo "<p class='text-danger'>Please make sure all fields are filled out correctly.</p>";
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

            <!-- Attendance Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Mark Attendance for Zone: <?php echo htmlspecialchars($zone_name); ?></h6>
                            <form method="post" action="">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <select class="form-select" id="title" name="title" required>
                                        <option value="" selected disabled>Select Program</option>
                                        <option value="Sunday Service">Sunday Service</option>
                                        <option value="Midweek Service">Midweek Service</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>

                                <?php if (count($members) > 0) : ?>
                                    <h6 class="mb-4">Members</h6>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Present</th>
                                                <th>Reason (if absent)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($members as $member) : ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($member['name']); ?></td>
                                                    <td>
                                                        <!-- Checkbox for presence -->
                                                        <input class="form-check-input" type="checkbox" name="attendance[<?php echo $member['id']; ?>]" id="member<?php echo $member['id']; ?>" value="1">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="reason[<?php echo $member['id']; ?>]" id="reason<?php echo $member['id']; ?>" placeholder="Reason for absence">
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else : ?>
                                    <p>No members found for this zone.</p>
                                <?php endif; ?>

                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Attendance Form End -->

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