<?php 
include_once('layout/main_header.php');
require_once("../libraries/functions.class.php");

$fcObj = new DataFunctions();

$totalStudents = $fcObj->getCount("users");
$totalStaff    = $fcObj->getCount("staff");
$totalCourses  = $fcObj->getCount("subjects");
$totalEvents   = $fcObj->getCount("events");
$activities    = $fcObj->getLatestActivities();
$upcomingEvents = $fcObj->getUpcomingEvents(3);
$enrollmentByBatch = $fcObj->getEnrollmentByBatch(4);
?>

<link rel="stylesheet" href="../public/assets/css/admin_dashboard.css?v=3">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest"></script>

<div class="hybrid-wrapper">

  <header class="hybrid-topbar">
    <div class="hybrid-title">
      <h1>AIML Department Dashboard</h1>
      <!-- <p class="hybrid-subtitle">
        Academic Year: 2025-2026 | Semester: II
      </p> -->
    </div>
    <!-- <div class="hybrid-top-actions">
      <input class="hybrid-search" type="text" placeholder="Search..." />
      <button class="hybrid-icon-btn">
        <i data-lucide="bell"></i>
      </button>
      <button class="hybrid-pill">
        <?php echo $_SESSION['adminFirstName'] ?? 'Admin'; ?>
      </button>
    </div> -->
  </header>

  <!-- <section class="hybrid-filters">
    <select>
      <option>Last 7 Days</option>
      <option>Last 30 Days</option>
      <option>This Semester</option>
    </select>
    <select>
      <option>All Departments</option>
      <option>AIML</option>
      <option>Data Science</option>
    </select>
  </section> -->

  <section class="hybrid-summary">
    <div>Total Students: <strong><?php echo $totalStudents; ?></strong></div>
    <div>Total Faculty: <strong><?php echo $totalStaff; ?></strong></div>
    <div>Courses Offered: <strong><?php echo $totalCourses; ?></strong></div>
    <div>Total Events: <strong><?php echo $totalEvents; ?></strong></div>
  </section>

  <section class="hybrid-kpis">
    <?php if (!empty($enrollmentByBatch)) { ?>
      <?php foreach ($enrollmentByBatch as $row) { ?>
        <div class="hybrid-card">
          <h4><?php echo htmlspecialchars($row['batch_name'], ENT_QUOTES, 'UTF-8'); ?> Enrollment</h4>
          <div class="value"><?php echo (int)$row['total']; ?></div>
        </div>
      <?php } ?>
    <?php } else { ?>
      <div class="hybrid-card">
        <h4>Enrollment</h4>
        <div class="value">0</div>
      </div>
    <?php } ?>

  </section>

  <section class="hybrid-showcase">

  <!-- Upcoming Events -->
  <div class="hybrid-card stats-panel">
    <div class="stats-head">Upcoming Events</div>
    <div class="stats-body">
      <p class="stats-subtitle">
        Priority schedule for the next department milestones
      </p>

      <ul class="stats-list">
        <?php if (!empty($upcomingEvents)) { ?>
          <?php foreach ($upcomingEvents as $event) { ?>
            <li>
              <span><?php echo htmlspecialchars($event['event_name'], ENT_QUOTES, 'UTF-8'); ?></span>
              <span class="stats-value"><?php echo date("d M", strtotime($event['event_date'])); ?></span>
            </li>
          <?php } ?>
        <?php } else { ?>
          <li>
            <span>No upcoming events</span>
            <span class="stats-value">-</span>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>

  <!-- Recent Activity -->
  <div class="hybrid-card stats-panel">
    <div class="stats-head">Recent Activity</div>
    <div class="stats-body">
      <p class="stats-subtitle">
        Latest updates from department operations
      </p>

      <ul class="stats-list">
        <?php if(!empty($activities)) { ?>
          <?php foreach($activities as $row) { ?>
            <li>
              <span><?php echo htmlspecialchars($row['title']); ?></span>
              <span class="stats-value">
                <?php echo date("d M", strtotime($row['created_at'])); ?>
              </span>
            </li>
          <?php } ?>
        <?php } else { ?>
          <li>No recent activity</li>
        <?php } ?>
      </ul>
    </div>
  </div>

</section>

</div>

<script>
lucide.createIcons();
</script>

<?php include_once('layout/footer.php'); ?>
