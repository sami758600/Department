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
$streams = $fcObj->getStreams(TB_STREAM);
$userClassSection = $fcObj->getClsBySec(TB_SECTION, $user['section']);

$userStreamName = 'N/A';
foreach ($streams as $stream) {
    if ((int)$stream['id'] === (int)$user['stream_id']) {
        $userStreamName = $stream['stream_name'] . ' (' . $stream['stream_code'] . ')';
        break;
    }
}

$userClassId = 0;
$userClassName = 'N/A';
$userSectionName = 'N/A';

if (!empty($userClassSection)) {
    $userClassId = (int)$userClassSection[0]['class_id'];
    $userClassName = $userClassSection[0]['class_name'];
    $userSectionName = $userClassSection[0]['section_name'];
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

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">User Dashboard</h2>
            <p class="text-muted mb-0">Your class details and resources.</p>
        </div>
        <a href="<?php echo BASE_URL; ?>/public/pages/user/profile.php" class="btn btn-warning">Edit My Details</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Stream</h6>
                    <h6 class="mb-0"><?php echo htmlspecialchars($userStreamName); ?></h6>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Class / Section</h6>
                    <h6 class="mb-0"><?php echo htmlspecialchars($userClassName . ' / ' . $userSectionName); ?></h6>
                </div>
            </div>
        </div>
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

<?php include_once(INCLUDES_PATH . '/footer.php'); ?>
