
<?php 
include_once('../layout/main_header.php');
?>

<style type="text/css">
    .core-settings-page .page-title {
        font-size: 24px;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: #0f172a;
        margin-bottom: 16px;
    }

    .core-settings-page .settings-card {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
        transition: transform .2s ease, box-shadow .2s ease;
        background: #ffffff;
    }

    .core-settings-page .settings-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 24px rgba(15, 23, 42, 0.08);
    }

    .core-settings-page .settings-icon {
        font-size: 2.2rem;
    }

    .core-settings-page .settings-title {
        font-size: 22px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .core-settings-page .settings-desc {
        color: #64748b;
        font-size: 18px;
        margin-bottom: 16px;
    }

    .core-settings-page .btn-action {
        border-radius: 10px;
        padding: 8px 14px;
        font-weight: 700;
        font-size: 16px;
    }
</style>

<div class="container-fluid core-settings-page">

    <h3 class="page-title">Core Settings</h3>

    <div class="row g-4">

        <!-- Classes -->
        <div class="col-md-4">
            <div class="card settings-card border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-easel settings-icon text-primary mb-3"></i>
                    <h5 class="settings-title">Classes</h5>
                    <p class="settings-desc">
                        Manage academic classes
                    </p>
                     <a href="../Class/add_class.php" class="btn btn-outline-primary btn-action">
                        add
                    </a>&nbsp
                    <a href="../Class/edit_class.php" class="btn btn-outline-primary btn-action">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Sections -->
        <div class="col-md-4">
            <div class="card settings-card border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-diagram-3 settings-icon text-success mb-3"></i>
                    <h5 class="settings-title">Sections</h5>
                    <p class="settings-desc">
                        Manage class sections
                    </p>
                    <a href="../Section/add_section.php" class="btn btn-outline-success btn-action">
                        add
                    </a>&nbsp
                    <a href="../Section/edit_sections.php" class="btn btn-outline-success btn-action">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Streams -->
        <div class="col-md-4">
            <div class="card settings-card border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-git settings-icon text-warning mb-3"></i>
                    <h5 class="settings-title">Streams</h5>
                    <p class="settings-desc">
                        Manage specializations
                    </p>
                    <a href="../branch/add_branch.php" class="btn btn-outline-warning btn-action">
                        add
                    </a>&nbsp
                    <a href="../branch/edit_branch.php" class="btn btn-outline-warning btn-action">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Subjects -->
        <div class="col-md-4">
            <div class="card settings-card border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-journal-bookmark settings-icon text-danger mb-3"></i>
                    <h5 class="settings-title">Subjects</h5>
                    <p class="settings-desc">
                        Manage course subjects
                    </p>
                    <a href="../Subject/add_subject.php" class="btn btn-outline-danger btn-action">
                        add
                    </a>&nbsp
                    <a href="../Subject/edit_subjects.php" class="btn btn-outline-danger btn-action">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Syllabus -->
        <div class="col-md-4">
            <div class="card settings-card border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-file-earmark-text settings-icon text-info mb-3"></i>
                    <h5 class="settings-title">Syllabus</h5>
                    <p class="settings-desc">
                        Manage syllabus details
                    </p>
                    <a href="../syllabus/add_syllabus.php" class="btn btn-outline-info btn-action">
                        add
                    </a>&nbsp
                    <a href="../syllabus/edit_syllabus.php" class="btn btn-outline-info btn-action">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Highlights -->
        <div class="col-md-4">
            <div class="card settings-card border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-star settings-icon text-secondary mb-3"></i>
                    <h5 class="settings-title">Highlights</h5>
                    <p class="settings-desc">
                        Manage homepage highlights
                    </p>
                    <a href="../Highlight/add_highlight.php" class="btn btn-outline-secondary btn-action">
                        add
                    </a>&nbsp
                    <a href="../Highlight/delete_highLight.php" class="btn btn-outline-secondary btn-action">
                        Manage
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include_once('../layout/footer.php'); ?>
