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

$fcObj = new DataFunctions();

$userData = $fcObj->userCheck(TB_USERS, $_SESSION['userName']);
if (empty($userData)) {
    header('Location: ' . BASE_URL . '/public/pages/authentication/logout.php');
    exit;
}

$user = $userData[0];
$userClassSection = $fcObj->getClsBySec(TB_SECTION, $user['section']);

$userClassId = 0;
$userClassName = 'N/A';
if (!empty($userClassSection)) {
    $userClassId = (int)$userClassSection[0]['class_id'];
    $userClassName = $userClassSection[0]['class_name'];
}

$userSyllabus = array();
$userPapers = array();

if ($userClassId > 0) {
    $userSyllabus = $fcObj->getSyllabusForClass(TB_SYLLABUS, $userClassId);

    $subjects = $fcObj->getSubjectsForClass(TB_SUBJECTS, $userClassId);
    foreach ($subjects as $subject) {
        $papers = $fcObj->getPrePapersForSubj(TB_PREV_PAPERS, $subject['id']);
        if (!empty($papers)) {
            $userPapers[] = array(
                'subject_code' => $subject['sub_code'],
                'papers' => $papers
            );
        }
    }
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
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/academics.php">Academics</a>
                    <a class="user-side-link" href="https://erp.nrcmec.org/">Exam Cell</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php#syllabus-section">Library</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/achievements.php">Upload Achievement</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/profile.php">Account Settings</a>
                    <a class="user-side-link active" href="<?php echo BASE_URL; ?>/public/pages/user/downloads.php">Downloads</a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/authentication/logout.php">Logout</a>
                </nav>
            </aside>
        </div>

        <div class="col-lg-9">
            <div class="user-summary-card user-profile-card">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <h2 class="user-profile-title mb-0">Downloads</h2>
                    <a href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light fw-semibold">My Syllabus</div>
                    <div class="card-body">
                        <div class="fw-semibold mb-2"><?php echo htmlspecialchars($userClassName); ?></div>
                        <div>
                            <?php if (!empty($userSyllabus)) { ?>
                                <a href="<?php echo BASE_URL; ?>/public/uploads/syllabus/<?php echo rawurlencode($userSyllabus[0]['syllabus_name']); ?>" target="_blank">
                                    Download Syllabus
                                </a>
                            <?php } else { ?>
                                <span class="text-muted small">No syllabus uploaded for your class.</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-semibold">My Previous Year Papers</div>
                    <div class="card-body">
                        <div class="fw-semibold mb-2"><?php echo htmlspecialchars($userClassName); ?></div>
                        <?php if (!empty($userPapers)) { ?>
                            <?php foreach ($userPapers as $paperGroup) { ?>
                                <div class="mb-3">
                                    <div class="fw-semibold"><?php echo htmlspecialchars($paperGroup['subject_code']); ?></div>
                                    <?php foreach ($paperGroup['papers'] as $paper) { ?>
                                        <div>
                                            <a href="<?php echo BASE_URL; ?>/public/uploads/previous_papers/<?php echo rawurlencode($paper['paper_file']); ?>" target="_blank">
                                                <?php echo htmlspecialchars($paper['paper_name']); ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <span class="text-muted small">No papers uploaded for your class.</span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once(INCLUDES_PATH . '/footer.php'); ?>
