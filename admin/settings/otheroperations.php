
<?php
include_once('../layout/main_header.php');

$options = array(
    'classes' => array('title' => 'Classes', 'icon' => 'bi-easel', 'desc' => 'Create and maintain class-level academic records.'),
    'sections' => array('title' => 'Sections', 'icon' => 'bi-diagram-3', 'desc' => 'Organize section mapping under each class.'),
    'streams' => array('title' => 'Streams', 'icon' => 'bi-git', 'desc' => 'Control branch/stream nomenclature and structure.'),
    'batches' => array('title' => 'Batch / Year', 'icon' => 'bi-calendar3', 'desc' => 'Manage academic year batches and sequencing.'),
    'subjects' => array('title' => 'Subjects', 'icon' => 'bi-journal-bookmark', 'desc' => 'Map subjects per class with clear maintenance flow.'),
    'syllabus' => array('title' => 'Syllabus', 'icon' => 'bi-file-earmark-text', 'desc' => 'Maintain syllabus entries for each academic segment.'),
    'highlights' => array('title' => 'Highlights', 'icon' => 'bi-star', 'desc' => 'Publish and update homepage highlight content.'),
    'events' => array('title' => 'Events', 'icon' => 'bi-calendar-event', 'desc' => 'Configure event masters and timelines.'),
    'event_candidates' => array('title' => 'Registered Candidates', 'icon' => 'bi-people', 'desc' => 'Review and manage all event registrations.'),
    'event_results' => array('title' => 'Event Results', 'icon' => 'bi-trophy', 'desc' => 'Publish and track event result announcements.'),
    'support_contact' => array('title' => 'Support Contact', 'icon' => 'bi-headset', 'desc' => 'Email, WhatsApp and SMTP settings for support desk.')
);
?>

<style type="text/css">
    .core-settings-page .page-hero {
        border: 1px solid #cfdced;
        border-radius: 18px;
        padding: 18px 22px;
        background:
            linear-gradient(140deg, rgba(37, 99, 235, 0.07), rgba(15, 118, 110, 0.05)),
            #f8fbff;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 16px;
    }

    .core-settings-page .page-title {
        margin: 0;
        font-size: 31px;
        letter-spacing: -0.6px;
        font-weight: 800;
        color: #0f172a;
    }

    .core-settings-page .page-subtitle {
        margin: 8px 0 0;
        color: #556a84;
        font-size: 14px;
    }

    .core-settings-page .settings-list {
        display: grid;
        gap: 10px;
    }

    .core-settings-page .setting-link {
        text-decoration: none;
        color: inherit;
    }

    .core-settings-page .setting-row {
        border: 1px solid #d7dde6;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 6px 14px rgba(15, 23, 42, 0.05);
        padding: 12px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    }

    .core-settings-page .setting-row:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
        border-color: #bfd0e8;
    }

    .core-settings-page .setting-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #ecf4ff;
        border: 1px solid #c8daf3;
        color: #1a4f8e;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }

    .core-settings-page .setting-title {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
    }

    .core-settings-page .setting-desc {
        margin: 0;
        color: #64748b;
        font-size: 12px;
    }
</style>

<div class="container-fluid core-settings-page">
    <div class="page-hero">
        <h3 class="page-title">Department Settings</h3>
        <p class="page-subtitle">Click any module to open complete data view with actions.</p>
    </div>

    <div class="settings-list">
        <?php foreach ($options as $key => $item) { ?>
            <a class="setting-link" href="department_option.php?option=<?php echo urlencode($key); ?>">
                <div class="setting-row">
                    <span class="setting-icon">
                        <i class="bi <?php echo htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
                    </span>
                    <div>
                        <h5 class="setting-title"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h5>
                        <p class="setting-desc"><?php echo htmlspecialchars($item['desc'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
</div>

<?php include_once('../layout/footer.php'); ?>
