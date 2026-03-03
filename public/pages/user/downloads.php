<?php
if (session_id() == '') {
    session_start();
}

require_once(__DIR__ . '/../../../config.php');
require_once(LIB_PATH . '/functions.class.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user' || !isset($_SESSION['userName'])) {
    header('Location: ' . BASE_URL . '/public/pages/Authentication/login.php');
    exit;
}

$fcObj = new DataFunctions();

$userData = $fcObj->userCheck(TB_USERS, $_SESSION['userName']);
if (empty($userData)) {
    header('Location: ' . BASE_URL . '/public/pages/Authentication/logout.php');
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

<div class="container user-profile-wrap user-layout-wrap">
    <div class="user-dashboard-shell row g-4">
        <div class="col-lg-3">
            <aside class="user-side-panel">
                <div class="user-side-brand">Department Portal</div>

                <nav class="user-side-nav user-side-nav-main">
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/dashboard.php"><i class="bi bi-speedometer2 user-side-link-icon"></i><span>Dashboard</span></a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/academics.php"><i class="bi bi-mortarboard user-side-link-icon"></i><span>Academics</span></a>
                    <a class="user-side-link" href="https://erp.nrcmec.org/"><i class="bi bi-journal-check user-side-link-icon"></i><span>Exam Cell</span></a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/achievements.php"><i class="bi bi-trophy user-side-link-icon"></i><span>Upload Achievement</span></a>
                    <a class="user-side-link" href="<?php echo BASE_URL; ?>/public/pages/user/profile.php"><i class="bi bi-person-gear user-side-link-icon"></i><span>Account Settings</span></a>
                    <a class="user-side-link active" href="<?php echo BASE_URL; ?>/public/pages/user/downloads.php"><i class="bi bi-download user-side-link-icon"></i><span>Downloads</span></a>
                </nav>

                <nav class="user-side-nav user-side-nav-utility">
                    <a class="user-side-link user-side-link-logout" href="<?php echo BASE_URL; ?>/public/pages/Authentication/logout.php"><i class="bi bi-box-arrow-right user-side-link-icon"></i><span>Logout</span></a>
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
                            <?php
                                $userSyllabusFile = !empty($userSyllabus) ? trim((string)$userSyllabus[0]['syllabus_name']) : '';
                                $userSyllabusPath = ROOT_PATH . '/public/uploads/syllabus/' . $userSyllabusFile;
                                $isValidUserSyllabus = preg_match('/^[A-Za-z0-9 ._()\\-]+$/', $userSyllabusFile) === 1;
                            ?>
                            <?php if ($userSyllabusFile !== '' && $isValidUserSyllabus && file_exists($userSyllabusPath)) { ?>
                                <a href="<?php echo BASE_URL; ?>/public/uploads/syllabus/<?php echo rawurlencode($userSyllabusFile); ?>" target="_blank">
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
                                        <?php
                                            $paperFile = trim((string)$paper['paper_file']);
                                            $paperPath = ROOT_PATH . '/public/uploads/previous_papers/' . $paperFile;
                                            $isValidPaper = preg_match('/^[A-Za-z0-9 ._()\\-]+$/', $paperFile) === 1;
                                        ?>
                                        <div>
                                            <?php if ($paperFile !== '' && $isValidPaper && file_exists($paperPath)) { ?>
                                                <a href="<?php echo BASE_URL; ?>/public/uploads/previous_papers/<?php echo rawurlencode($paperFile); ?>" target="_blank">
                                                    <?php echo htmlspecialchars($paper['paper_name']); ?>
                                                </a>
                                            <?php } else { ?>
                                                <span class="text-muted small"><?php echo htmlspecialchars($paper['paper_name']); ?> (file unavailable)</span>
                                            <?php } ?>
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
