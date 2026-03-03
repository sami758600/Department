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

    .committee-header {
        padding: 22px 24px;
        border: 1px solid #cad8e8;
        border-radius: 18px;
        background:
            linear-gradient(135deg, rgba(15, 118, 110, 0.07), rgba(14, 116, 144, 0.03)),
            #f8fbff;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 18px;
    }

    .committee-page-title {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: var(--cm-text);
        margin: 0 0 8px;
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
        font-size: 16px;
        margin: 0;
    }

    .committee-stats {
        margin-top: 14px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .committee-stat-pill {
        border: 1px solid #c6d8ee;
        border-radius: 999px;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 700;
        color: #1f3f63;
        background: #eef5fc;
    }

    .committee-shell {
        border-radius: 20px;
        border: 1px solid var(--cm-border);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        background: rgba(255, 255, 255, 0.88);
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
        background: linear-gradient(180deg, #f9fcff 0%, #edf3fa 100%);
        border-radius: 16px;
        padding: 16px;
        margin-bottom: 0;
        display: flex;
        flex-direction: column;
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
        position: relative;
        overflow: hidden;
    }

    .committee-member-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #0f766e, #2563eb);
        opacity: 0.9;
    }

    .committee-member-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 28px rgba(15, 23, 42, 0.12);
    }

    .committee-members-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 14px;
    }

    .committee-member-card .card-body {
        display: flex;
        align-items: center;
        gap: 14px;
        text-align: left;
        min-height: 140px;
    }

    .committee-member-media {
        flex-shrink: 0;
    }

    .committee-member-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #ccfbf1;
    }

    .committee-member-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid #ccfbf1;
        background: linear-gradient(135deg, #0f766e, #155e75);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 800;
    }

    .committee-member-meta {
        font-size: 13px;
        color: #5b6574;
        line-height: 1.45;
        min-height: 38px;
        margin-bottom: 0;
        overflow-wrap: anywhere;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .committee-empty {
        color: var(--cm-subtext);
        font-size: 14px;
        font-weight: 600;
        padding: 14px 12px;
        border-radius: 12px;
        border: 1px dashed #cbd5e1;
        background: #f9fafb;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .committee-empty::before {
        content: "\f52a";
        font-family: "bootstrap-icons";
        font-size: 16px;
        color: #6c7f95;
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
            font-size: 26px;
        }

        .committee-body {
            padding: 16px;
        }

        .committee-category-title {
            font-size: 17px;
        }

        .committee-member-card .card-body {
            flex-direction: column;
            text-align: center;
            min-height: 0;
        }
    }
</style>

<?php
$totalMembers = 0;
for ($i = 0; $i < $categoryCnt; $i++) {
    $totalMembers += !empty($CmtMemDet[$i]) ? count($CmtMemDet[$i]) : 0;
}
?>

<div class="committee-header">
    <h3 class="committee-page-title">AIML Association Committee</h3>
    <p class="committee-subtitle">Manage office bearers and members category-wise.</p>
    <div class="committee-stats">
        <span class="committee-stat-pill">
            <i class="bi bi-diagram-3 me-1"></i>
            <?php echo (int)$categoryCnt; ?> Categories
        </span>
        <span class="committee-stat-pill">
            <i class="bi bi-people me-1"></i>
            <?php echo (int)$totalMembers; ?> Total Members
        </span>
    </div>
</div>

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

                    <div class="committee-members-grid">

                        <?php if (!empty($CmtMemDet[$j])) { ?>

                            <?php foreach ($CmtMemDet[$j] as $member) { ?>
                                <?php
                                    $memberName = trim((string)($member['member_name'] ?? ''));
                                    $memberAbout = (string)($member['member_about'] ?? '');
                                    $memberImage = trim((string)($member['member_image'] ?? ''));
                                    $imagePath = BASE_URL.'/public/assets/images/users/'.rawurlencode($memberImage !== '' ? $memberImage : 'default.png');
                                    $initial = strtoupper(substr($memberName !== '' ? $memberName : 'M', 0, 1));
                                ?>

                                <div>
                                    <div class="card committee-member-card border-0 h-100">

                                        <div class="card-body">
                                            <div class="committee-member-media">
                                                <img 
                                                    src="<?php echo $imagePath; ?>"
                                                    class="committee-member-img"
                                                    alt="<?php echo htmlspecialchars($memberName); ?>"
                                                    onerror="this.style.display='none';this.nextElementSibling.style.display='inline-flex';"
                                                >
                                                <span class="committee-member-avatar" style="display:none;"><?php echo htmlspecialchars($initial, ENT_QUOTES, 'UTF-8'); ?></span>
                                            </div>

                                            <div class="committee-member-content">
                                                <h6 class="fw-semibold mb-1">
                                                    <?php echo htmlspecialchars($memberName !== '' ? $memberName : 'Member'); ?>
                                                </h6>

                                                <p class="committee-member-meta">
                                                    <?php echo htmlspecialchars($memberAbout !== '' ? $memberAbout : 'No profile details available.'); ?>
                                                </p>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            <?php } ?>

                        <?php } else { ?>

                            <div class="committee-empty">
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
