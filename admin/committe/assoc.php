<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
include_once('../layout/main_header.php');

// require_once("libraries/functions.class.php");
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbComtCtg = TB_COMT_CATEG;
$tbComt    = TB_COMMITTEE;

$ComtCateg = $fcObj->getComiteCatg($tbComtCtg);
$categoryCnt = sizeof($ComtCateg);

$CmtMemDet = array();

for ($i = 0; $i < $categoryCnt; $i++) {
    $categoryId = $ComtCateg[$i]['id'];
    $CmtMemDet[$i] = $fcObj->getCmtMembers($tbComt, $categoryId);
}
?>

<style type="text/css">
    :root {
        --cm-text: #1f2937;
        --cm-subtext: #4b5563;
        --cm-accent: #0f766e;
        --cm-accent-soft: #ccfbf1;
        --cm-bg: #f8fafc;
        --cm-card: #ffffff;
        --cm-border: #d1d5db;
    }

    .committee-page-title {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.4px;
        color: var(--cm-text);
        margin-bottom: 10px;
    }

    body {
        background: linear-gradient(135deg, #e8eef5 0%, #dfe8f2 100%) !important;
    }

    .content-area {
        background:
            radial-gradient(circle at 12% 10%, rgba(15, 118, 110, 0.08), transparent 36%),
            radial-gradient(circle at 92% 18%, rgba(59, 130, 246, 0.08), transparent 32%),
            linear-gradient(180deg, #eef2f7 0%, #e6ebf3 100%) !important;
        min-height: calc(100vh - 80px);
        border-radius: 16px 0 0 0;
    }

    .committee-subtitle {
        color: var(--cm-subtext);
        font-size: 14px;
        margin-bottom: 18px;
    }

    .committee-shell {
        border-radius: 20px;
        border: 1px solid var(--cm-border);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(2px);
        overflow: hidden;
    }

    .committee-body {
        padding: 24px;
    }

    .committee-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(280px, 1fr));
        gap: 16px;
    }

    .committee-category {
        border: 1px solid #dbe2ea;
        background: linear-gradient(180deg, #f7fafc 0%, #edf2f7 100%);
        border-radius: 16px;
        padding: 14px;
        margin-bottom: 0;
    }

    .committee-category-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 12px;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 10px;
    }

    .committee-category-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #0b5e56;
        line-height: 1.2;
    }

    .committee-member-count {
        font-size: 12px;
        font-weight: 700;
        color: #0f766e;
        background: var(--cm-accent-soft);
        padding: 4px 10px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .committee-member-card {
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
        transition: transform .2s ease, box-shadow .2s ease;
        background: var(--cm-card);
    }

    .committee-member-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 28px rgba(15, 23, 42, 0.12);
    }

    .committee-member-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #ccfbf1;
    }

    .committee-empty {
        color: var(--cm-subtext);
        font-size: 14px;
        font-weight: 600;
        padding: 14px 12px;
        border-radius: 12px;
        border: 1px dashed #cbd5e1;
        background: #f9fafb;
    }

    .committee-add-btn {
        padding: 13px 22px;
        border: 0;
        border-radius: 13px;
        background: linear-gradient(135deg, #0f766e, #115e59);
        color: #ffffff;
        font-weight: 700;
        box-shadow: 0 8px 16px rgba(15, 118, 110, 0.28);
    }

    .committee-add-btn:hover {
        filter: brightness(1.06);
        color: #ffffff;
    }

    @media (max-width: 992px) {
        .committee-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .committee-page-title {
            font-size: 22px;
        }

        .committee-body {
            padding: 16px;
        }

        .committee-category-title {
            font-size: 17px;
        }
    }
</style>

<h3 class="committee-page-title">AIML Association Committee</h3>
<p class="committee-subtitle">Manage office bearers and members category-wise.</p>

<div class="card committee-shell border-0">
    <div class="committee-body">

        <?php if ($categoryCnt > 0) { ?>
            <div class="committee-grid">

            <?php for ($j = 0; $j < $categoryCnt; $j++) { ?>
                <?php $memberCount = !empty($CmtMemDet[$j]) ? sizeof($CmtMemDet[$j]) : 0; ?>

                <div class="committee-category">
                    <div class="committee-category-head">
                        <h5 class="committee-category-title">
                            <?php echo $ComtCateg[$j]['category_name']; ?>
                        </h5>
                        <span class="committee-member-count"><?php echo $memberCount; ?> Members</span>
                    </div>

                    <div class="row g-4">

                        <?php if (!empty($CmtMemDet[$j])) { ?>

                            <?php foreach ($CmtMemDet[$j] as $member) { ?>
                                <?php
                                    $memberName = trim((string)($member['member_name'] ?? ''));
                                    $memberAbout = (string)($member['member_about'] ?? '');
                                    $memberImage = trim((string)($member['member_image'] ?? ''));
                                    $imagePath = BASE_URL.'/public/assets/images/users/'.rawurlencode($memberImage !== '' ? $memberImage : 'default.png');
                                ?>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card committee-member-card border-0 text-center h-100">

                                        <div class="card-body">

                                            <img 
                                                src="<?php echo $imagePath; ?>"
                                                class="committee-member-img mb-3"
                                                alt="<?php echo htmlspecialchars($memberName); ?>"
                                            >

                                            <h6 class="fw-semibold mb-1">
                                                <?php echo htmlspecialchars($memberName !== '' ? $memberName : 'Member'); ?>
                                            </h6>

                                            <p class="text-muted small mb-1">
                                                <?php echo htmlspecialchars($memberAbout); ?>
                                            </p>

                                        </div>

                                    </div>
                                </div>

                            <?php } ?>

                        <?php } else { ?>

                            <div class="col-12 committee-empty">
                                No members assigned for this category.
                            </div>

                        <?php } ?>

                    </div>
                </div>

            <?php } ?>
            </div>

        <?php } else { ?>

            <p class="text-muted">No committee categories found.</p>

        <?php } ?>

        <div class="mt-5">
            <a href="addmem.php" class="btn committee-add-btn">
                <i class="bi bi-plus-circle me-1"></i>
                Add Committee Member
            </a>
        </div>

    </div>
</div>

<?php include_once('../layout/footer.php'); ?>
