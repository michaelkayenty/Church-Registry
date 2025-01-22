<?php require_once "./database/db_connection.php"; ?>
<?php require_once "component/header.php"; ?>
<?php require_once "utils/isLoggedIn.php"; ?>

<?php
// Fetch all zones from the database
$query = "SELECT * FROM zone";
$result = $conn->query($query);
$zones = $result->fetch_all(MYSQLI_ASSOC);
?>


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
                            <h6 class="mb-4">Add New Member</h6>
                            <form method="post" action="logic/add_member.php">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="" selected disabled>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="residence" class="form-label">Residence</label>
                                    <input type="text" class="form-control" id="residence" name="residence" placeholder="Enter Residence">
                                </div>
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob">
                                </div>
                                <div class="mb-3">
                                    <label for="marital_status" class="form-label">Marital Status</label>
                                    <select class="form-select" id="marital_status" name="marital_status">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Enter Occupation">
                                </div>
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Enter Telephone Number">
                                </div>
                                <div class="mb-3">
                                    <label for="zone" class="form-label">Zone</label>
                                    <select class="form-select" id="zone" name="zone">
                                        <option value="" selected disabled>Select Zone</option>
                                        <?php foreach ($zones as $zone) : ?>
                                            <option value="<?php echo $zone['id']; ?>"><?php echo htmlspecialchars($zone['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Ministries Dropdown -->
                                <div class="mb-3">
                                    <label for="ministry" class="form-label">Ministry</label>
                                    <select class="form-select" id="ministry" name="ministry">
                                        <option value="" selected disabled>Select Ministry</option>
                                        <option value="Pastoral">Pastoral</option>
                                        <option value="Teaching">Teaching</option>
                                        <option value="Evangelism">Evangelism</option>
                                        <option value="Prophetic">Prophetic</option>
                                        <option value="Apostel">Apostel</option>
                                    </select>
                                </div>

                                <!-- Departments Checkboxes -->
                                <div class="mb-3">
                                    <label class="form-label">Departments</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="protocol" name="departments[]" value="Protocol/Ushers">
                                        <label class="form-check-label" for="protocol">Protocol/Ushers</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="choir" name="departments[]" value="Choir/Instrumentalist">
                                        <label class="form-check-label" for="choir">Choir/Instrumentalist</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sound" name="departments[]" value="Sound Engineers">
                                        <label class="form-check-label" for="sound">Sound Engineers</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="media" name="departments[]" value="Media">
                                        <label class="form-check-label" for="media">Media</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intercessors" name="departments[]" value="Intercessors">
                                        <label class="form-check-label" for="intercessors">Intercessors</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="administration" name="departments[]" value="Administration">
                                        <label class="form-check-label" for="administration">Administration</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="counsellors" name="departments[]" value="Counsellors">
                                        <label class="form-check-label" for="counsellors">Counsellors</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cleaners" name="departments[]" value="Cleaners">
                                        <label class="form-check-label" for="cleaners">Cleaners</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Member</button>
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