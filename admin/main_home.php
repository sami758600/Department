<?php 
include_once('layout/main_header.php');
require_once("../libraries/functions.class.php");

$fcObj = new DataFunctions();

<<<<<<< HEAD
/* Get Messages */
$chairman  = $fcObj->getComment($tbComments, CHAIRMAN);
$principal = $fcObj->getComment($tbComments, PRINCIPAL);
$hod       = $fcObj->getComment($tbComments, HOD);

/* Safe Defaults */
$chairman  = $chairman[0]  ?? [];
$principal = $principal[0] ?? [];
$hod       = $hod[0]       ?? [];

?>

<div class="container-fluid py-4">

    <!-- Page Title -->
    <h2 class="mb-4 fw-bold text-dark">
        AIML Department Dashboard
    </h2>


    <div class="row g-4">

        <!-- Chairman -->
        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body p-4">

                    <h5 class="text-primary fw-semibold mb-3">
                        Chairman Message
                    </h5>

                    <p class="text-muted fst-italic">
                        "<?php echo $chairman['comment'] ?? 'No message available'; ?>"
                    </p>


                    <div class="d-flex align-items-center mt-4 pt-3 border-top">

                        <img src="../images/<?php echo $chairman['image'] ?? 'default.png'; ?>"
                             class="rounded-circle me-3"
                             width="60"
                             height="60"
                             onerror="this.src='../images/default.png'">

                        <div>

                            <div class="fw-semibold text-dark">
                                <?php echo $chairman['name'] ?? 'Not Assigned'; ?>
                            </div>

                            <small class="text-muted">
                                <?php echo $chairman['designation'] ?? ''; ?>
                            </small>

                        </div>

                    </div>

                </div>

=======
/* ===========================
   DASHBOARD COUNTS
=========================== */

// Adjusted to your actual schema
$totalStudents = $fcObj->getCount("users");      // students
$totalStaff    = $fcObj->getCount("staff");      // staff table
$totalCourses  = $fcObj->getCount("subjects");   // courses = subjects
$totalEvents   = $fcObj->getCount("events");     // events

/* ===========================
   RECENT ACTIVITIES
=========================== */

$activities = $fcObj->getLatestActivities();  // default table = activities
?>

<div class="container-fluid">

    <h3 class="mb-4 fw-bold">Dashboard Overview</h3>

    <!-- ======================
         STAT CARDS
    ======================= -->

    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <h6 class="text-muted">Total Students</h6>
                <h2 class="fw-bold"><?php echo $totalStudents; ?></h2>
>>>>>>> 5d924bc317a00fca7bcccfec1422715c7529250a
            </div>

        </div>
<<<<<<< HEAD


        <!-- Principal -->
        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body p-4">

                    <h5 class="text-success fw-semibold mb-3">
                        Principal Message
                    </h5>

                    <p class="text-muted fst-italic">
                        "<?php echo $principal['comment'] ?? 'No message available'; ?>"
                    </p>


                    <div class="d-flex align-items-center mt-4 pt-3 border-top">

                        <img src="../images/<?php echo $principal['image'] ?? 'default.png'; ?>"
                             class="rounded-circle me-3"
                             width="60"
                             height="60"
                             onerror="this.src='../images/default.png'">

                        <div>

                            <div class="fw-semibold text-dark">
                                <?php echo $principal['name'] ?? 'Not Assigned'; ?>
                            </div>

                            <small class="text-muted">
                                <?php echo $principal['designation'] ?? ''; ?>
                            </small>

                        </div>

                    </div>

                </div>

=======

        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <h6 class="text-muted">Active Courses</h6>
                <h2 class="fw-bold"><?php echo $totalCourses; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <h6 class="text-muted">Staff Members</h6>
                <h2 class="fw-bold"><?php echo $totalStaff; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <h6 class="text-muted">Upcoming Events</h6>
                <h2 class="fw-bold"><?php echo $totalEvents; ?></h2>
            </div>
        </div>

    </div>

    <!-- ======================
         CHART + ACTIVITY
    ======================= -->

    <div class="row g-4">

        <!-- Chart Section -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-semibold mb-3">Student Attendance Overview</h5>
                <canvas id="attendanceChart" height="100"></canvas>
>>>>>>> 5d924bc317a00fca7bcccfec1422715c7529250a
            </div>

        </div>

<<<<<<< HEAD

        <!-- HOD -->
        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body p-4">

                    <h5 class="text-danger fw-semibold mb-3">
                        HOD Message
                    </h5>

                    <p class="text-muted fst-italic">
                        "<?php echo $hod['comment'] ?? 'No message available'; ?>"
                    </p>


                    <div class="d-flex align-items-center mt-4 pt-3 border-top">

                        <img src="../images/<?php echo $hod['image'] ?? 'default.png'; ?>"
                             class="rounded-circle me-3"
                             width="60"
                             height="60"
                             onerror="this.src='../images/default.png'">

                        <div>

                            <div class="fw-semibold text-dark">
                                <?php echo $hod['name'] ?? 'Not Assigned'; ?>
                            </div>

                            <small class="text-muted">
                                <?php echo $hod['designation'] ?? ''; ?>
                            </small>

                        </div>

                    </div>

                </div>
=======
        <!-- Recent Activities -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-semibold mb-3">Recent Activities</h5>

                <?php if(!empty($activities)) { ?>

                    <?php foreach($activities as $row) { ?>
                        <div class="mb-3">
                            <div class="fw-semibold">
                                <?php echo htmlspecialchars($row['title']); ?>
                            </div>
                            <small class="text-muted">
                                <?php echo date("d M Y, h:i A", strtotime($row['created_at'])); ?>
                            </small>
                        </div>
                        <hr>
                    <?php } ?>

                <?php } else { ?>
                    <p class="text-muted">No recent activity.</p>
                <?php } ?>
>>>>>>> 5d924bc317a00fca7bcccfec1422715c7529250a

            </div>

        </div>

    </div>

</div>


<!-- ======================
     CHART JS
======================= -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('attendanceChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Students',
            data: [120, 190, 300, 250, 220, 310], // dummy data
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});
</script>

<?php include_once('layout/footer.php'); ?>
