<?php
require_once "./database/db_connection.php";

$member_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Query to fetch member data based on the member_id
$query = "SELECT * FROM members WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the member data
$member = $result->fetch_assoc();
$zoneQuery = "SELECT id, name FROM zone";
$zoneResult = $conn->query($zoneQuery);
$zones = $zoneResult->fetch_all(MYSQLI_ASSOC);

// Ministries options
$ministries = ['Pastoral', 'Teaching', 'Evangelism', 'Prophetic', 'Apostel'];

// Departments options
$departments = [
    'Protocol/ Ushers',
    'Choir/Instrumentalist',
    'Sound Engineers',
    'Media',
    'Intercessors',
    'Administration',
    'Counsellors',
    'Cleaners'
];

// Convert departments string to array for checkbox comparison
$memberDepartments = explode(", ", $member['departmnent']);
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

            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Edit Member</h6>
                            <form method="post" action="logic/update_member.php">
                                <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($member['name']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="Male" <?php echo ($member['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="Female" <?php echo ($member['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="residence" class="form-label">Residence</label>
                                    <input type="text" class="form-control" id="residence" name="residence" value="<?php echo htmlspecialchars($member['residence']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($member['DoB']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="marital_status" class="form-label">Marital Status</label>
                                    <select class="form-select" id="marital_status" name="marital_status">
                                        <option value="Married" <?php echo ($member['marital_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                                        <option value="Single" <?php echo ($member['marital_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo htmlspecialchars($member['ocupation']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($member['telephone']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="zone" class="form-label">Zone</label>
                                    <select class="form-select" id="zone" name="zone">
                                        <option value="" disabled>Select Zone</option>
                                        <?php foreach ($zones as $zone) : ?>
                                            <option value="<?php echo $zone['id']; ?>" <?php echo ($member['zone_id'] == $zone['id']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($zone['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="ministry" class="form-label">Ministry</label>
                                    <select class="form-select" id="ministry" name="ministry">
                                        <option value="" disabled>Select Ministry</option>
                                        <?php foreach ($ministries as $ministry) : ?>
                                            <option value="<?php echo $ministry; ?>" <?php echo ($member['ministry'] == $ministry) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($ministry); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Departments</label>
                                    <?php foreach ($departments as $department) : ?>
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="departments[]"
                                                value="<?php echo $department; ?>"
                                                <?php echo in_array($department, $memberDepartments) ? 'checked' : ''; ?>>
                                            <label class="form-check-label">
                                                <?php echo htmlspecialchars($department); ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form End -->

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