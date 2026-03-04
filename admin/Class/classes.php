<?php require_once(__DIR__ . '/../../config.php');

require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();
$tbClass = TB_CLASS;

$classes = $fcObj->getClasses($tbClass);
$classesCnt = sizeof($classes);

include_once('../layout/main_header.php');
include_once('../layout/core_forms_style.php');
?>
<style type="text/css">
    #content_left {
        display: none;
    }

    #content {
        grid-template-columns: 1fr;
        gap: 0;
    }

    #page {
        max-width: none;
    }

    .class-list-hero {
        border: 1px solid #cfdced;
        border-radius: 18px;
        padding: 18px 22px;
        background:
            linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
            #f8fbff;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 16px;
    }

    .class-list-title {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
    }

    .class-list-subtitle {
        margin: 8px 0 0;
        font-size: 15px;
        color: #556a84;
    }

    .class-list-card {
        background: #ffffff;
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
        padding: 16px;
    }

    .class-list-head,
    .class-list-row {
        display: grid;
        grid-template-columns: minmax(220px, 1fr) 210px;
        align-items: center;
        gap: 12px;
    }

    .class-list-head {
        border: 1px solid #dbe6f3;
        border-radius: 12px;
        background: #f7faff;
        padding: 12px 14px;
        font-size: 14px;
        font-weight: 800;
        color: #19436f;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 10px;
    }

    .class-list-row {
        border: 1px solid #e0e8f2;
        border-radius: 12px;
        padding: 11px 14px;
        background: #ffffff;
        margin-bottom: 10px;
    }

    .class-list-row:last-child {
        margin-bottom: 0;
    }

    .class-name {
        font-size: 22px;
        font-weight: 600;
        color: #1f324b;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .class-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        flex-wrap: wrap;
    }

    .class-btn {
        border: 0;
        border-radius: 11px;
        padding: 8px 14px;
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 74px;
    }

    .class-btn-edit {
        background: linear-gradient(135deg, #1e3a8a, #1d4ed8);
    }

    .class-btn-delete {
        background: linear-gradient(135deg, #b91c1c, #dc2626);
    }

    .class-empty {
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        background: #f8fafc;
        color: #64748b;
        font-weight: 600;
        padding: 16px;
        text-align: center;
    }

    .class-footer {
        margin-top: 14px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .class-add-btn {
        border: 0;
        border-radius: 12px;
        padding: 11px 20px;
        background: linear-gradient(135deg, #102a48, #123b66);
        color: #fff;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
    }

    .section-add-btn {
        background: linear-gradient(135deg, #0f766e, #059669);
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.24);
    }

    .section-manage-btn {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        box-shadow: 0 10px 20px rgba(75, 85, 99, 0.24);
    }

    @media (max-width: 768px) {
        .class-list-title {
            font-size: 26px;
        }

        .class-list-head {
            display: none;
        }

        .class-list-row {
            grid-template-columns: 1fr;
        }

        .class-actions {
            justify-content: flex-start;
        }
    }
</style>
<div id="page">
    <div id="content">
        <div class="post">
            <span class="alignCenter"></span>
            <p></p>
        </div>

        <div id='content_left' class='content_left'></div>
        
        <div id='content_right' class='content_right'>
            <div class="class-list-hero">
                <h3 class="class-list-title">Manage Classes</h3>
                <p class="class-list-subtitle">Align, edit, and maintain class records in one place.</p>
            </div>

            <div class="class-list-card">
                <div class="class-list-head">
                    <div>Class Name</div>
                    <div style="text-align:right;">Actions</div>
                </div>

                <?php if ($classesCnt > 0) { ?>
                    <?php for ($j = 0; $j < $classesCnt; $j++) { ?>
                    <div class="class-list-row">
                        <div class="class-name">
                            <?php echo htmlspecialchars((string)$classes[$j]['class_name'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <div class="class-actions">
                            <a class="class-btn class-btn-edit" href="edit_class.php?class=<?php echo (int)$classes[$j]['id']; ?>">
                                Edit
                            </a>
                            <a class="class-btn class-btn-delete" href="delete_class.php?class=<?php echo (int)$classes[$j]['id']; ?>" onclick="return confirm('Do You Want To Continue To Delete');">
                                Delete
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="class-empty">No classes found.</div>
                <?php } ?>

                <div class="class-footer">
                    <a class="class-add-btn" href="add_class.php">
                        <i class="bi bi-plus-circle"></i>
                        Add Class
                    </a>
                    <a class="class-add-btn section-add-btn" href="../Section/add_section.php">
                        <i class="bi bi-plus-square"></i>
                        Add Section
                    </a>
                    <a class="class-add-btn section-manage-btn" href="../Section/sections.php">
                        <i class="bi bi-list-task"></i>
                        Manage Sections
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
