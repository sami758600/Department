<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
  
require_once(LIB_PATH . '/functions.class.php');
require_once(LIB_PATH . '/security.php');

$fcObj = new DataFunctions();

$tbEvent   = TB_EVENTS;
$tbGallery = TB_GALLERY;

$msg = "";
$eventId = "";
$imgName = "";
$imgDesc = "";

/* ---------- ADD GALLERY ---------- */
if (isset($_POST['addNewGallery'])) {
    if (!app_validate_csrf_token($_POST['csrf_token'] ?? '')) {
        $msg = "Your session expired. Please try again.";
    } else {

    $eventIdValue = isset($_POST['eventId']) ? trim((string)$_POST['eventId']) : '';
    $eventId  = (int)$eventIdValue;
    $imgName  = trim($_POST['imageName']);
    $imgDesc  = trim($_POST['imgDesc']);

    if ($eventIdValue === '' || $imgName == "" || $_FILES['galleryImage']['error'] != 0) {
        $msg = "All fields are required.";
    } else {
        $baseName = preg_replace('/[^a-zA-Z0-9_-]/', '', strtolower(str_replace(' ', '_', $imgName)));
        if ($baseName === '' || $baseName === null) {
            $baseName = 'gallery_image';
        }
        $uploadError = '';
        $fileName = app_store_uploaded_image($_FILES['galleryImage'], __DIR__, $baseName, $uploadError, 4 * 1024 * 1024);
        $uploadPath = $fileName !== '' ? (__DIR__ . '/' . $fileName) : '';

        if ($fileName !== '') {

            $varArray = [
                'event_id'    => $eventId,
                'image_name'  => $imgName,
                'image_desc'  => $imgDesc,
                'image'       => $fileName
            ];

            $addGallery = $fcObj->addGallery($tbGallery, $varArray);

            if ($addGallery) {
                header("Location: gallery.php");
                exit;
            } else {
                if (file_exists($uploadPath)) {
                    @unlink($uploadPath);
                }
                $msg = "Database error. Please try again.";
            }

        } else {
            $msg = $uploadError;
        }
    }
    }
}

include_once('../layout/main_header.php');

$events = $fcObj->getEventDetails($tbEvent);
?>

<style type="text/css">
    .add-gallery-page .page-hero {
        border: 1px solid #cfdced;
        border-radius: 18px;
        padding: 18px 22px;
        background:
            linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
            #f8fbff;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 18px;
    }

    .add-gallery-page .page-title {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
        margin: 0;
    }

    .add-gallery-page .page-subtitle {
        margin: 8px 0 0;
        color: #556a84;
        font-size: 15px;
    }

    .add-gallery-page .gallery-form-card {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
        background: #ffffff;
    }

    .add-gallery-page .gallery-form-card .card-body {
        padding: 22px;
    }

    .add-gallery-page .form-label {
        font-size: 16px;
        font-weight: 700;
        color: #1f324b;
        margin-bottom: 8px;
    }

    .add-gallery-page .form-control,
    .add-gallery-page .form-select {
        border: 1px solid #c8d8ea;
        border-radius: 12px;
        min-height: 52px;
        background: #f6faff;
        font-size: 16px;
    }

    .add-gallery-page textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .add-gallery-page .form-control:focus,
    .add-gallery-page .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        background: #ffffff;
    }

    .add-gallery-page .btn-primary {
        border: 0;
        border-radius: 12px;
        padding: 11px 20px;
        background: linear-gradient(135deg, #102a48, #123b66);
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
    }

    .add-gallery-page .btn-secondary {
        border-radius: 12px;
        padding: 11px 20px;
        font-weight: 600;
    }

    .add-gallery-page .upload-hint {
        margin-top: 8px;
        color: #6b7f98;
        font-size: 13px;
    }

    .add-gallery-page .action-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .add-gallery-page .page-title {
            font-size: 26px;
        }
    }
</style>

<div class="container-fluid add-gallery-page">

    <div class="page-hero">
        <h3 class="page-title">Add New Gallery Image</h3>
        <p class="page-subtitle">Attach event photos with clear names and optional description.</p>
    </div>

    <div class="card gallery-form-card border-0">
        <div class="card-body">

            <?php if ($msg != "") { ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php } ?>

            <form action="add_gallery.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(app_get_csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">

                <div class="mb-3">
                    <label class="form-label">Select Event</label>
                    <select name="eventId" class="form-select" required>
                        <option value="">SELECT</option>
                        <option value="0" <?php if ($eventId === "0") echo "selected"; ?>>OTHER</option>
                        <option value="-1" <?php if ($eventId === "-1") echo "selected"; ?>>Press News</option>
                        <?php foreach ($events as $event) { ?>
                            <?php $optVal = (string)$event['id']; ?>
                            <option value="<?php echo htmlspecialchars($optVal, ENT_QUOTES, 'UTF-8'); ?>" <?php if ($eventId === $optVal) echo "selected"; ?>>
                                <?php echo htmlspecialchars((string)$event['event_name'], ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Name</label>
                    <input type="text" name="imageName" class="form-control" value="<?php echo htmlspecialchars($imgName, ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Description</label>
                    <textarea name="imgDesc" class="form-control"><?php echo htmlspecialchars($imgDesc, ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="galleryImage" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>
                    <div class="upload-hint">Allowed: JPG, PNG, WEBP</div>
                </div>

                <div class="action-row">
                    <button type="submit" name="addNewGallery" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Add Gallery
                    </button>

                    <a href="gallery.php" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<?php include_once('../layout/footer.php'); ?>
