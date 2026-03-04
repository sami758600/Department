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
$userClassName = !empty($userClassSection) ? (string)$userClassSection[0]['class_name'] : '';

$userYear = '3';
if (preg_match('/\b(1st|2nd|3rd|4th|I{1,3}|IV|[1-4])\b/i', $userClassName, $yearMatch)) {
    $yearKey = strtolower($yearMatch[1]);
    $yearMap = array(
        '1st' => '1',
        '2nd' => '2',
        '3rd' => '3',
        '4th' => '4',
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        'i' => '1',
        'ii' => '2',
        'iii' => '3',
        'iv' => '4'
    );
    if (isset($yearMap[$yearKey])) {
        $userYear = $yearMap[$yearKey];
    }
}

$academicCalendars = array(
    '1' => array(
        'year_label' => 'B.Tech I Year',
        'sem_1' => array(
            array('1', 'Induction Programme', '11.08.2025', '18.08.2025', '1'),
            array('2', '1st Spell of Instructions (Including Dussehra Recess)', '19.08.2025', '18.10.2025', '9'),
            array('3', 'First Mid Term Examinations', '21.10.2025', '27.10.2025', '1'),
            array('4', '2nd Spell of Instructions', '28.10.2025', '15.12.2025', '7'),
            array('5', 'Second Mid Term Examinations', '16.12.2025', '20.12.2025', '1'),
            array('6', 'End Semester Examinations', '22.12.2025', '03.01.2026', '2'),
            array('7', 'Lab Examinations', '05.01.2026', '09.01.2026', '1')
        ),
        'sem_2' => array(
            array('1', 'Commencement of II Semester class work', '12.01.2026', '-', '-'),
            array('2', '1st Spell of Instructions', '12.01.2026', '07.03.2026', '8'),
            array('3', 'First Mid Term Examinations', '09.03.2026', '14.03.2026', '1'),
            array('4', '2nd Spell of Instructions', '16.03.2026', '08.05.2026', '8'),
            array('5', 'Summer Vacation', '09.05.2026', '31.05.2026', '3'),
            array('6', 'Second Mid Term Examinations', '01.06.2026', '06.06.2026', '1'),
            array('7', 'End Semester Examinations', '08.06.2026', '20.06.2026', '2'),
            array('8', 'Lab Examinations', '22.06.2026', '27.06.2026', '1')
        )
    ),
    '2' => array(
        'year_label' => 'B.Tech II Year',
        'sem_1' => array(
            array('1', 'Commencement of I Semester class work', '23.07.2025', '-', '-'),
            array('2', '1st Spell of Instructions', '23.07.2025', '16.09.2025', '8'),
            array('3', 'First Mid Term Examinations', '17.09.2025', '23.09.2025', '1'),
            array('4', '2nd Spell of Instructions (Including Dussehra Recess)', '24.09.2025', '18.11.2025', '8'),
            array('5', 'Dussehra Recess', '29.09.2025', '04.10.2025', '1'),
            array('6', 'Second Mid Term Examinations', '19.11.2025', '25.11.2025', '1'),
            array('7', 'Preparation Holiday & Lab Examinations', '26.11.2025', '02.12.2025', '1'),
            array('8', 'End Semester Examinations', '03.12.2025', '16.12.2025', '2')
        ),
        'sem_2' => array(
            array('1', 'Commencement of II Semester class work', '19.12.2025', '-', '-'),
            array('2', '1st Spell of Instructions', '19.12.2025', '12.02.2026', '8'),
            array('3', 'First Mid Term Examinations', '13.02.2026', '19.02.2026', '1'),
            array('4', '2nd Spell of Instructions', '20.02.2026', '11.04.2026', '7'),
            array('5', 'Second Mid Term Examinations', '13.04.2026', '18.04.2026', '1'),
            array('6', 'End Semester Examinations', '20.04.2026', '02.05.2026', '2'),
            array('7', 'Lab Examinations', '04.05.2026', '09.05.2026', '1')
        )
    ),
    '3' => array(
        'year_label' => 'B.Tech III Year',
        'sem_1' => array(
            array('1', 'Commencement of I Semester class work', '30.06.2025', '-', '-'),
            array('2', '1st Spell of Instructions', '30.06.2025', '30.08.2025', '9'),
            array('3', 'First Mid Term Examinations', '01.09.2025', '06.09.2025', '1'),
            array('4', '2nd Spell of Instructions [Including Dussehra Recess]', '08.09.2025', '18.11.2025', '9'),
            array('5', 'Dussehra Recess', '29.09.2025', '04.10.2025', '1'),
            array('6', 'Second Mid Term Examinations', '10.11.2025', '15.11.2025', '1'),
            array('7', 'End Semester Examinations', '17.11.2025', '29.11.2025', '2'),
            array('8', 'Lab Examinations', '01.12.2025', '06.12.2025', '1')
        ),
        'sem_2' => array(
            array('1', 'Commencement of II Semester class work', '08.12.2025', '-', '-'),
            array('2', '1st Spell of Instructions', '08.12.2025', '07.02.2026', '9'),
            array('3', 'First Mid Term Examinations', '09.02.2026', '14.02.2026', '1'),
            array('4', '2nd Spell of Instructions', '16.02.2026', '11.04.2026', '8'),
            array('5', 'Second Mid Term Examinations', '13.04.2026', '18.04.2026', '1'),
            array('6', 'End Semester Examinations', '20.04.2026', '02.05.2026', '2'),
            array('7', 'Lab Examinations', '04.05.2026', '09.05.2026', '1')
        )
    )
);

$calendarYear = isset($academicCalendars[$userYear]) ? $userYear : '3';
$calendar = $academicCalendars[$calendarYear];

include_once(INCLUDES_PATH . '/header.php');

$userActivePage = 'academics';
include_once(__DIR__ . '/layout/main_header.php');
?>
            <div class="academic-calendar-wrap" id="academics-section">
                <div class="academic-head">
                    <h3>NARSIMHA REDDY ENGINEERING COLLEGE</h3>
                    <p>UGC-Autonomous Institution | Academic Calendar 2025-26 | <?php echo htmlspecialchars($calendar['year_label']); ?></p>
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
                            <?php foreach ($calendar['sem_1'] as $row) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row[0]); ?></td>
                                    <td><?php echo htmlspecialchars($row[1]); ?></td>
                                    <td><?php echo htmlspecialchars($row[2]); ?></td>
                                    <td><?php echo htmlspecialchars($row[3]); ?></td>
                                    <td><?php echo htmlspecialchars($row[4]); ?></td>
                                </tr>
                            <?php } ?>
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
                            <?php foreach ($calendar['sem_2'] as $row) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row[0]); ?></td>
                                    <td><?php echo htmlspecialchars($row[1]); ?></td>
                                    <td><?php echo htmlspecialchars($row[2]); ?></td>
                                    <td><?php echo htmlspecialchars($row[3]); ?></td>
                                    <td><?php echo htmlspecialchars($row[4]); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
<?php include_once(__DIR__ . '/layout/main_footer.php'); ?>

