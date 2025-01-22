<?php
require_once "./database/db_connection.php";

// Fetch zones for filter dropdown
$zoneQuery = "SELECT id, name FROM zone";
$zoneResult = $conn->query($zoneQuery);
$zones = $zoneResult->fetch_all(MYSQLI_ASSOC);

// Fetch titles for filter dropdown
$titles = ['Sunday Service', 'Midweek Service'];


$ministryQuery = "SELECT DISTINCT ministry FROM members WHERE ministry IS NOT NULL";
$ministryResult = $conn->query($ministryQuery);
$ministries = $ministryResult->fetch_all(MYSQLI_ASSOC);

// Handle form submission and filtering
$selected_zone = isset($_POST['zone']) ? intval($_POST['zone']) : 0;
$selected_title = isset($_POST['title']) ? $_POST['title'] : '';
$selected_date = isset($_POST['date']) ? $_POST['date'] : '';
$selected_presence = isset($_POST['presence']) ? $_POST['presence'] : '';
$selected_ministry = isset($_POST['ministry']) ? $_POST['ministry'] : '';

// Base query with JOINs
$query = "SELECT a.*, m.name AS member_name, m.telephone AS member_telephone, m.departmnent AS member_department, m.ministry AS member_ministry, z.name AS zone_name 
          FROM attendace a 
          LEFT JOIN members m ON a.member_id = m.id 
          LEFT JOIN zone z ON a.zone_id = z.id
          WHERE 1=1";
$params = [];
$types = '';

// Apply filters if set
if ($selected_zone > 0) {
    $query .= " AND a.zone_id = ?";
    $params[] = $selected_zone;
    $types .= 'i';
}

if (!empty($selected_title)) {
    $query .= " AND a.title = ?";
    $params[] = $selected_title;
    $types .= 's';
}

if (!empty($selected_date)) {
    $query .= " AND DATE(a.created_at) = ?";
    $params[] = $selected_date;
    $types .= 's';
}

if ($selected_presence !== '') {
    $query .= " AND a.is_present = ?";
    $params[] = $selected_presence;
    $types .= 'i';
}


if (!empty($selected_ministry)) {
    $query .= " AND m.ministry = ?";
    $params[] = $selected_ministry;
    $types .= 's';
}

// Add default ordering and limit if no filters are applied
if (empty($selected_zone) && empty($selected_title) && empty($selected_date) && $selected_presence === '' && empty($selected_department) && empty($selected_ministry)) {
    $query .= " ORDER BY a.id DESC LIMIT 10";
} else {
    // Order by creation date if filters are applied
    $query .= " ORDER BY a.created_at DESC";
}

// Prepare and execute query
$stmt = $conn->prepare($query);
if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$attendances = $result->fetch_all(MYSQLI_ASSOC);
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

            <!-- Dashboard View Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Attendance Dashboard</h6>
                            <form method="post" action="">
                                <div class="mb-3">
                                    <label for="zone" class="form-label">Zone</label>
                                    <select class="form-select" id="zone" name="zone">
                                        <option value="" disabled selected>Select Zone</option>
                                        <?php foreach ($zones as $zone) : ?>
                                            <option value="<?php echo $zone['id']; ?>" <?php echo ($selected_zone == $zone['id']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($zone['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <select class="form-select" id="title" name="title">
                                        <option value="" disabled selected>Select Title</option>
                                        <?php foreach ($titles as $title) : ?>
                                            <option value="<?php echo $title; ?>" <?php echo ($selected_title == $title) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($title); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($selected_date); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="presence" class="form-label">Presence</label>
                                    <select class="form-select" id="presence" name="presence">
                                        <option value="" selected>Any</option>
                                        <option value="1" <?php echo ($selected_presence == '1') ? 'selected' : ''; ?>>Present</option>
                                        <option value="0" <?php echo ($selected_presence == '0') ? 'selected' : ''; ?>>Absent</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="ministry" class="form-label">Ministry</label>
                                    <select class="form-select" id="ministry" name="ministry">
                                        <option value="" disabled selected>Select Ministry</option>
                                        <?php foreach ($ministries as $ministry) : ?>
                                            <option value="<?php echo htmlspecialchars($ministry['ministry']); ?>" <?php echo ($selected_ministry == $ministry['ministry']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($ministry['ministry']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Filter</button>
                                <button type="button" class="btn btn-danger mt-3" id="resetFilters">Reset</button>
                            </form>

                            <!-- Attendance Table Start -->
                            <h6 class="mb-4 mt-4">Attendance Records</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Member Name</th>
                                            <th>Telephone</th>
                                            <th>Zone Name</th>
                                            <th>Title</th>
                                            <th>Presence</th>
                                            <th>Reason</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($attendances) > 0) : ?>
                                            <?php $rowNumber = 1; ?>
                                            <?php foreach ($attendances as $attendance) : ?>
                                                <tr>
                                                    <td><?php echo $rowNumber++; ?></td>
                                                    <td><?php echo htmlspecialchars($attendance['member_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($attendance['member_telephone']); ?></td>
                                                    <td><?php echo htmlspecialchars($attendance['zone_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($attendance['title']); ?></td>
                                                    <td><?php echo $attendance['is_present'] ? 'Present' : 'Absent'; ?></td>
                                                    <td><?php echo htmlspecialchars($attendance['reason']); ?></td>
                                                    <td><?php echo htmlspecialchars($attendance['created_at']); ?></td>
                                                    <td>
                                                        <a href="edit_attendance.php?id=<?php echo $attendance['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="11" class="text-center">No records found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <!-- Attendance Table End -->
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard View End -->

            <!-- Footer Start -->
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <?php require_once "component/script.php"; ?>
    <script>
        document.getElementById('resetFilters').addEventListener('click', function() {
            document.querySelector('form').reset(); // Reset all form fields
            // Optionally, you can manually reset specific select elements if needed
            document.querySelectorAll('select').forEach(function(select) {
                select.selectedIndex = 0;
            });

            // Trigger the form submission
            document.querySelector('form').submit();
        });
    </script>
</body>

</html>