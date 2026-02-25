<?php
if (session_id() == '') {
    session_start();
}

require_once(__DIR__ . '/../../../config.php');
require_once(LIB_PATH . '/functions.class.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user' || !isset($_SESSION['userName'])) {
    header('Location: ' . BASE_URL . '/public/pages/authentication/login.php');
    exit;
}

include_once(INCLUDES_PATH . '/header.php');
?>

<div class="container user-profile-wrap">
    <div class="user-dashboard-shell row g-4">
        <div class="col-lg-3">
            <aside class="user-side-panel">
                <div class="user-side-brand">Department Portal</div>

                <nav class="user-side-nav">
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php">Dashboard</a>
                    <a class="user-side-link active" href="<?php echo BASE_URL; ?>/public/pages/user/academics.php">Academics</a>
                    <a class="user-side-link" href="https://erp.nrcmec.org/">Exam Cell</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php#syllabus-section">Library</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/achievements.php">Upload Achievement</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/profile.php">Account Settings</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/downloads.php">Downloads</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/authentication/logout.php">Logout</a>
                </nav>
            </aside>
        </div>

        <div class="col-lg-9">
            <div class="academic-calendar-wrap" id="academics-section">
                <div class="academic-head">
                    <h3>NARSIMHA REDDY ENGINEERING COLLEGE</h3>
                    <p>UGC-Autonomous Institution | Academic Calendar 2025-26 | B.Tech III Year</p>
                </div>

                <h4 class="academic-sem-title">I SEM</h4>
                <div class="table-responsive academic-table-wrap">
                    <table class="table academic-table mb-0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Description</th>
                                <th>Duration From</th>
                                <th>To</th>
                                <th>Duration (Weeks)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>1</td><td>Commencement of I Semester class work</td><td>30.06.2025</td><td>-</td><td>-</td></tr>
                            <tr><td>2</td><td>1st Spell of Instructions</td><td>30.06.2025</td><td>30.08.2025</td><td>9</td></tr>
                            <tr><td>3</td><td>First Mid Term Examinations</td><td>01.09.2025</td><td>06.09.2025</td><td>1</td></tr>
                            <tr><td>4</td><td>2nd Spell of Instructions [Including Dussehra Recess]</td><td>08.09.2025</td><td>18.11.2025</td><td>9</td></tr>
                            <tr><td>5</td><td>Dussehra Recess</td><td>29.09.2025</td><td>04.10.2025</td><td>1</td></tr>
                            <tr><td>6</td><td>Second Mid Term Examinations</td><td>10.11.2025</td><td>15.11.2025</td><td>1</td></tr>
                            <tr><td>7</td><td>End Semester Examinations</td><td>17.11.2025</td><td>29.11.2025</td><td>2</td></tr>
                            <tr><td>8</td><td>Lab Examinations</td><td>01.12.2025</td><td>06.12.2025</td><td>1</td></tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="academic-sem-title mt-4">II SEM</h4>
                <div class="table-responsive academic-table-wrap">
                    <table class="table academic-table mb-0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Description</th>
                                <th>Duration From</th>
                                <th>To</th>
                                <th>Duration (Weeks)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>1</td><td>Commencement of II Semester class work</td><td>08.12.2025</td><td>-</td><td>-</td></tr>
                            <tr><td>2</td><td>1st Spell of Instructions</td><td>08.12.2025</td><td>07.02.2026</td><td>9</td></tr>
                            <tr><td>3</td><td>First Mid Term Examinations</td><td>09.02.2026</td><td>14.02.2026</td><td>1</td></tr>
                            <tr><td>4</td><td>2nd Spell of Instructions</td><td>16.02.2026</td><td>11.04.2026</td><td>8</td></tr>
                            <tr><td>5</td><td>Second Mid Term Examinations</td><td>13.04.2026</td><td>18.04.2026</td><td>1</td></tr>
                            <tr><td>6</td><td>End Semester Examinations</td><td>20.04.2026</td><td>02.05.2026</td><td>2</td></tr>
                            <tr><td>7</td><td>Lab Examinations</td><td>04.05.2026</td><td>09.05.2026</td><td>1</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once(INCLUDES_PATH . '/footer.php'); ?>
