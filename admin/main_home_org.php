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

<style type="text/css">
    .dashboard-page {
        background:
            radial-gradient(circle at 10% 0%, rgba(30, 58, 138, 0.06), transparent 38%),
            radial-gradient(circle at 95% 5%, rgba(2, 132, 199, 0.05), transparent 28%);
        border-radius: 14px;
        padding: 2px 4px 12px;
    }

    .dashboard-page .dash-title {
        font-size: 42px;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: #0f172a;
        margin-bottom: 16px;
    }

    .dashboard-page .stat-card {
        border: 1px solid #dbe2ea;
        border-radius: 14px;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .dashboard-page .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 28px rgba(15, 23, 42, 0.1);
    }

    .dashboard-page .stat-label {
        font-size: 18px;
        color: #475569;
        font-weight: 600;
    }

    .dashboard-page .stat-value {
        font-size: 48px;
        line-height: 1;
        color: #0f172a;
        margin-top: 6px;
    }

    .dashboard-page .panel-card {
        border: 1px solid #dbe2ea;
        border-radius: 14px;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
        background: #ffffff;
    }

    .dashboard-page .panel-title {
        font-size: 34px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 12px;
    }

    .dashboard-page .activity-item {
        padding: 10px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .dashboard-page .activity-item:last-child {
        border-bottom: 0;
    }

    .dashboard-page .activity-title {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 2px;
    }

    .dashboard-page .activity-time {
        font-size: 16px;
        color: #64748b;
    }
</style>

<div class="container-fluid dashboard-page">

    <h3 class="dash-title">Dashboard Overview</h3>

    <!-- ======================
         STAT CARDS
    ======================= -->

    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card stat-card border-0 p-3">
                <h6 class="stat-label">Total Students</h6>
                <h2 class="fw-bold stat-value"><?php echo $totalStudents; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card border-0 p-3">
                <h6 class="stat-label">Active Courses</h6>
                <h2 class="fw-bold stat-value"><?php echo $totalCourses; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card border-0 p-3">
                <h6 class="stat-label">Staff Members</h6>
                <h2 class="fw-bold stat-value"><?php echo $totalStaff; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card border-0 p-3">
                <h6 class="stat-label">Upcoming Events</h6>
                <h2 class="fw-bold stat-value"><?php echo $totalEvents; ?></h2>
            </div>
        </div>

    </div>

    <!-- ======================
         CHART + ACTIVITY
    ======================= -->

    <div class="row g-4">

        <!-- Chart Section -->
        <div class="col-lg-8">
            <div class="card panel-card border-0 p-4">
                <h5 class="panel-title">Student Attendance Overview</h5>
                <canvas id="attendanceChart" height="100"></canvas>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="col-lg-4">
            <div class="card panel-card border-0 p-4">
                <h5 class="panel-title">Recent Activities</h5>

                <?php if(!empty($activities)) { ?>

                    <?php foreach($activities as $row) { ?>
                        <div class="activity-item">
                            <div class="activity-title">
                                <?php echo htmlspecialchars($row['title']); ?>
                            </div>
                            <small class="activity-time">
                                <?php echo date("d M Y, h:i A", strtotime($row['created_at'])); ?>
                            </small>
                        </div>
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
            backgroundColor: 'rgba(30, 64, 175, 0.65)',
            borderRadius: 8,
            borderSkipped: false
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                grid: { color: '#e5e7eb' },
                ticks: { color: '#475569' }
            },
            x: {
                grid: { color: '#f1f5f9' },
                ticks: { color: '#475569' }
            }
        }
    }
});
</script>

<?php include_once('layout/footer.php'); ?>
