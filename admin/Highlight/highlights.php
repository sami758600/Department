<?php require_once(__DIR__ . '/../../config.php');

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();
$tbHighLights = TB_HIGHLIGHTS;

$aimlHighlights = $fcObj->getHighLights($tbHighLights, AIML);
$deptHighlights = $fcObj->getHighLights($tbHighLights, DEPARTMENT);

include_once('../layout/main_header.php');
include_once('../layout/core_forms_style.php');
?>
<style type="text/css">
    #content_left {
        display: none;
    }

    #content.single-panel-layout {
        grid-template-columns: minmax(320px, 840px);
        justify-content: center;
        gap: 0;
    }

    #content.single-panel-layout .post {
        display: none;
    }

    #content.single-panel-layout #content_right {
        grid-column: 1;
        width: 100%;
    }

    .highlights-hero {
        width: 100%;
        max-width: 840px;
        border: 1px solid #cfdced;
        border-radius: 18px;
        padding: 18px 22px;
        background:
            linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
            #f8fbff;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 16px;
    }

    .highlights-title {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
    }

    .highlights-subtitle {
        margin: 8px 0 0;
        font-size: 15px;
        color: #556a84;
    }

    #content.single-panel-layout #content_right .comteeMem.highlights-card {
        width: 100%;
        max-width: 840px;
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
        padding: 24px;
    }

    .highlights-section + .highlights-section {
        margin-top: 16px;
    }

    .highlights-section .committeeTitle {
        grid-template-columns: minmax(240px, 1fr) auto;
    }

    .highlights-section .committeeTitle .eventCandName:last-child {
        text-align: right;
    }

    .highlights-list-row {
        display: grid;
        grid-template-columns: minmax(240px, 1fr) auto;
        align-items: center;
        gap: 12px;
        margin-top: 10px;
        padding: 12px 14px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    .highlights-list-row .highlight-text {
        font-size: 20px;
        line-height: 1.45;
        color: #0f172a;
        word-break: break-word;
    }

    .highlights-list-row .highlight-actions {
        display: flex;
        justify-content: flex-end;
    }

    .highlights-list-row .highlight-actions .button,
    .highlights-footer-actions .button {
        border: 0;
        border-radius: 12px;
        padding: 10px 18px;
        background: linear-gradient(135deg, #102a48, #123b66);
        font-size: 16px;
        font-weight: 700;
        box-shadow: 0 8px 18px rgba(16, 42, 72, 0.2);
    }

    .highlights-list-row .highlight-actions .button:hover,
    .highlights-footer-actions .button:hover {
        filter: brightness(1.06);
    }

    .highlights-empty {
        margin-top: 10px;
        padding: 12px 14px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px dashed #d1dbe7;
        color: #5d728d;
        font-size: 14px;
    }

    .highlights-footer-actions {
        margin-top: 16px;
    }

    .highlights-footer-actions .button {
        padding: 11px 22px;
        font-size: 18px;
        box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
    }

    @media (max-width: 768px) {
        .highlights-section .committeeTitle,
        .highlights-list-row {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .highlights-section .committeeTitle .eventCandName:last-child,
        .highlights-list-row .highlight-actions {
            text-align: left;
            justify-content: flex-start;
        }
    }
</style>
<div id="page">
    <div id="content" class="single-panel-layout">
        <div class="post">
            <span class="alignCenter">
                <h4>AIML Department </h4>
            </span>
            <p></p>
        </div>
        <!-- <div id='content_left' class='content_left'>
            <?php include_once('../layout/other_leftnav.php'); ?>
        </div> -->
        <div id='content_right' class='content_right'>
            <div class="highlights-hero">
                <h3 class="highlights-title">AIML Department</h3>
                <p class="highlights-subtitle">Manage AIML and Department highlights.</p>
            </div>

            <div class="comteeMem highlights-card">
                <div class="highlights-section">
                    <div class="committeeTitle">
                        <div class='eventCandName'>AIML Highlights</div>
                        <div class='eventCandName'>Action</div>
                    </div>
                    <?php if (!empty($aimlHighlights)) { ?>
                        <?php foreach ($aimlHighlights as $row) { ?>
                            <div class="highlights-list-row">
                                <div class='highlight-text'><?php echo htmlspecialchars($row['high_light'], ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class='highlight-actions'>
                                    <a href="delete_highLight.php?highlight=<?php echo $row['id']; ?>" onclick="return confirm('Do You Want To Continue To Delete');">
                                        <input type="button" class="button" value="Delete" />
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="highlights-empty">No AIML highlights available.</div>
                    <?php } ?>
                </div>

                <div class="highlights-section">
                    <div class="committeeTitle">
                        <div class='eventCandName'>Department Highlights</div>
                        <div class='eventCandName'>Action</div>
                    </div>
                    <?php if (!empty($deptHighlights)) { ?>
                        <?php foreach ($deptHighlights as $row) { ?>
                            <div class="highlights-list-row">
                                <div class='highlight-text'><?php echo htmlspecialchars($row['high_light'], ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class='highlight-actions'>
                                    <a href="delete_highLight.php?highlight=<?php echo $row['id']; ?>" onclick="return confirm('Do You Want To Continue To Delete');">
                                        <input type="button" class="button" value="Delete" />
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="highlights-empty">No Department highlights available.</div>
                    <?php } ?>
                </div>

                <div class="highlights-footer-actions">
                    <a href="add_highlight.php">
                        <input type="button" class="button" value="Add Highlight" />
                    </a>
                </div>
            </div>
        </div>
        <br class="clearfix" />
    </div>
    <?php include_once('../layout/sidebar.php'); ?>
    <br class="clearfix" />
</div>
</div>
<?php include_once('../layout/footer.php'); ?>
