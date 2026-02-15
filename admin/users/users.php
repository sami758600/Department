<?php 
include_once('main_header.php');
require_once("../libraries/functions.class.php");

$fcObj = new DataFunctions();
$tbUsers = TB_USERS;

$regUsers = $fcObj->getTempUsers($tbUsers);
$noOfUsers = sizeof($regUsers);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">
        Pending User Approvals
    </h3>

    <span class="badge bg-warning text-dark fs-6">
        <?php echo $noOfUsers; ?> Pending
    </span>
</div>

<div class="card shadow-sm border-0">
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
                                        <span class="badge bg-light text-dark border">
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
                                <td colspan="5" class="text-center py-4 text-muted">
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

<script>
function toggleAll(source) {
    document.querySelectorAll('input[name="users[]"]')
        .forEach(cb => cb.checked = source.checked);
}
</script>

<?php include_once('footer.php'); ?>
