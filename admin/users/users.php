<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
include_once('../layout/main_header.php');

// require_once("libraries/functions.class.php");
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();
$tbUsers = TB_USERS;

$regUsers = $fcObj->getTempUsers($tbUsers);
$noOfUsers = sizeof($regUsers);
?>

<style type="text/css">
    .pending-users-page .pending-title {
        font-size: 40px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
        margin: 0;
    }

    .pending-users-page .pending-badge {
        border-radius: 12px;
        padding: 8px 14px;
        font-size: 16px !important;
        font-weight: 700;
        background: #facc15 !important;
        color: #111827 !important;
    }

    .pending-users-page .pending-card {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }

    .pending-users-page .table {
        margin-bottom: 0;
    }

    .pending-users-page .table thead th {
        background: #f8fafc;
        color: #1f2937;
        font-size: 17px;
        font-weight: 700;
        border-bottom: 1px solid #d1d5db;
        padding-top: 14px;
        padding-bottom: 14px;
    }

    .pending-users-page .table tbody td {
        font-size: 16px;
        color: #334155;
        border-bottom: 1px solid #e5e7eb;
        padding-top: 13px;
        padding-bottom: 13px;
    }

    .pending-users-page .admission-pill {
        border: 1px solid #d1d5db !important;
        border-radius: 10px;
        background: #f8fafc !important;
        color: #111827 !important;
        font-size: 14px;
        font-weight: 600;
    }

    .pending-users-page .empty-state {
        color: #64748b !important;
        font-size: 18px;
        padding: 26px 10px !important;
    }

    .pending-users-page .btn-success {
        border: 0;
        border-radius: 12px;
        padding: 10px 18px;
        background: linear-gradient(135deg, #059669, #047857);
        font-weight: 700;
        box-shadow: 0 8px 16px rgba(5, 150, 105, 0.2);
    }

    .pending-users-page .btn-outline-danger {
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 700;
    }
</style>

<div class="pending-users-page">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="pending-title">
        Pending User Approvals
    </h3>

    <span class="badge pending-badge">
        <?php echo $noOfUsers; ?> Pending
    </span>
</div>

<div class="card pending-card border-0">
    <div class="card-body">

        <form action="userstatus.php" method="POST">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="40">
                                <input type="checkbox" onclick="toggleAll(this)">
                            </th>
                            <th width="60">#</th>
                            <th>Username</th>
                            <th>Admission ID</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if($noOfUsers > 0){ ?>

                            <?php for($i=0; $i<$noOfUsers; $i++){ ?>

                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               name="users[]"
                                               value="<?php echo $regUsers[$i]['id']; ?>">
                                    </td>

                                    <td><?php echo $i+1; ?></td>

                                    <td class="fw-semibold">
                                        <?php echo $regUsers[$i]['username']; ?>
                                    </td>

                                    <td>
                                        <span class="badge admission-pill">
                                            <?php echo $regUsers[$i]['admission_id']; ?>
                                        </span>
                                    </td>

                                    <td class="text-muted">
                                        <?php echo $regUsers[$i]['mail_id']; ?>
                                    </td>
                                </tr>

                            <?php } ?>

                        <?php } else { ?>

                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted empty-state">
                                    No pending users found
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>

            <?php if($noOfUsers > 0){ ?>

            <div class="mt-4 d-flex gap-3">

                <button type="submit"
                        name="approveusers"
                        class="btn btn-success px-4">
                    <i class="bi bi-check-circle me-1"></i>
                    Approve Selected
                </button>

                <button type="submit"
                        name="deleteusers"
                        formaction="deleteusers.php"
                        class="btn btn-outline-danger px-4">
                    <i class="bi bi-trash me-1"></i>
                    Delete Selected
                </button>

            </div>

            <?php } ?>

        </form>

    </div>
</div>
</div>

<script>
function toggleAll(source) {
    document.querySelectorAll('input[name="users[]"]')
        .forEach(cb => cb.checked = source.checked);
}
</script>

<?php include_once('../layout/footer.php'); ?>
