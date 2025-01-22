<?php
require_once "./database/db_connection.php";
$zone_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Query to fetch members based on the zone_id
$query = "SELECT * FROM members WHERE zone_id = ? ORDER BY name ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $zone_id);
$stmt->execute();
$result = $stmt->get_result();

// Store results in an array
$members = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
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

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Zone Members</h6>
                        <a href="mark_attendance.php?zone_id=<?php echo $zone_id; ?>" class="btn btn-sm btn-primary">Mark Attendance</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Name</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Residence</th>
                                    <th scope="col">Date of Birth</th>
                                    <th scope="col">Marital Status</th>
                                    <th scope="col">Occupation</th>
                                    <th scope="col">Telephone</th>
                                    <th scope="col">Ministry</th>
                                    <th scope="col">Departments</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($members) > 0) {
                                    foreach ($members as $member) {
                                        echo "<tr>
                                            <td>" . htmlspecialchars($member['name']) . "</td>
                                            <td>" . htmlspecialchars($member['gender']) . "</td>
                                            <td>" . htmlspecialchars($member['residence']) . "</td>
                                            <td>" . htmlspecialchars($member['DoB']) . "</td>
                                            <td>" . htmlspecialchars($member['marital_status']) . "</td>
                                            <td>" . htmlspecialchars($member['ocupation']) . "</td>
                                            <td>" . htmlspecialchars($member['telephone']) . "</td>
                                            <td>" . htmlspecialchars($member['ministry']) . "</td>
                                            <td>" . htmlspecialchars($member['departmnent']) . "</td>
                                            <td>
                                                <a class='btn btn-sm btn-primary' href='edit_member.php?id=" . $member['id'] . "'>Edit</a>
                                                <a class='btn btn-sm btn-danger' href='logic/delete_member.php?id=" . $member['id'] . "'>Delete</a>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='10'>No members found for this zone</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->

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