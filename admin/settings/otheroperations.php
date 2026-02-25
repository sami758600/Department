
<?php 
include_once('../layout/main_header.php');
?>

<div class="container-fluid">

    <h3 class="fw-bold mb-4">Core Settings</h3>

    <div class="row g-4">

        <!-- Classes -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-easel fs-1 text-primary mb-3"></i>
                    <h5 class="fw-semibold">Classes</h5>
                    <p class="text-muted small">
                        Manage academic classes
                    </p>
                     <a href="../Class/add_class.php" class="btn btn-outline-primary btn-sm">
                        add
                    </a>&nbsp
                    <a href="../Class/edit_class.php" class="btn btn-outline-primary btn-sm">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Sections -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-diagram-3 fs-1 text-success mb-3"></i>
                    <h5 class="fw-semibold">Sections</h5>
                    <p class="text-muted small">
                        Manage class sections
                    </p>
                    <a href="../Section/add_section.php" class="btn btn-outline-success btn-sm">
                        add
                    </a>&nbsp
                    <a href="../Section/edit_sections.php" class="btn btn-outline-success btn-sm">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Streams -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-git fs-1 text-warning mb-3"></i>
                    <h5 class="fw-semibold">Streams</h5>
                    <p class="text-muted small">
                        Manage specializations
                    </p>
                    <a href="../branch/add_branch.php" class="btn btn-outline-warning btn-sm">
                        add
                    </a>&nbsp
                    <a href="../branch/edit_branch.php" class="btn btn-outline-warning btn-sm">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Subjects -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-journal-bookmark fs-1 text-danger mb-3"></i>
                    <h5 class="fw-semibold">Subjects</h5>
                    <p class="text-muted small">
                        Manage course subjects
                    </p>
                    <a href="../Subject/add_subject.php" class="btn btn-outline-danger btn-sm">
                        add
                    </a>&nbsp
                    <a href="../Subject/edit_subjects.php" class="btn btn-outline-danger btn-sm">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Syllabus -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-file-earmark-text fs-1 text-info mb-3"></i>
                    <h5 class="fw-semibold">Syllabus</h5>
                    <p class="text-muted small">
                        Manage syllabus details
                    </p>
                    <a href="../syllabus/add_syllabus.php" class="btn btn-outline-info btn-sm">
                        add
                    </a>&nbsp
                    <a href="../syllabus/edit_syllabus.php" class="btn btn-outline-info btn-sm">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Highlights -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-star fs-1 text-secondary mb-3"></i>
                    <h5 class="fw-semibold">Highlights</h5>
                    <p class="text-muted small">
                        Manage homepage highlights
                    </p>
                    <a href="../Highlight/add_highlight.php" class="btn btn-outline-secondary btn-sm">
                        add
                    </a>&nbsp
                    <a href="../Highlight/delete_highLight.php" class="btn btn-outline-secondary btn-sm">
                        Manage
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include_once('../layout/footer.php'); ?>
