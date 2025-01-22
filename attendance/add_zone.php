<?php
require_once "./database/db_connection.php";

// Fetch all admins for the dropdown
$query = "SELECT id, username FROM admin";
$result = $conn->query($query);

$admins = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
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

            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add New Zone</h6>
                            <form method="post" action="logic/add_zone.php">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Zone Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Zone Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required>
                                </div>
                                <div class="mb-3">
                                    <label for="admi_id" class="form-label">Zone Leader</label>
                                    <select class="form-select" id="admi_id" name="admi_id" required>
                                        <option value="" selected disabled>Select Zone Leader</option>
                                        <?php foreach ($admins as $admin) : ?>
                                            <option value="<?php echo $admin['id']; ?>"><?php echo $admin['username']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Zone</button>
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