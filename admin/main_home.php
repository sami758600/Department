<?php 
include_once('layout/main_header.php');
require_once("../libraries/functions.class.php");

$fcObj = new DataFunctions();

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
            </div>
        </div>

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
            </div>
        </div>

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
