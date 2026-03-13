<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
  
require_once(LIB_PATH . '/functions.class.php');
require_once(LIB_PATH . '/security.php');

$fcObj = new DataFunctions();

$tbGallery = TB_GALLERY;
$tbGalleryCategory = TB_GALLERY_CATEGORY;

$msg = "";
$categoryId = "";
$imgName = "";
$imgDesc = "";

/* ---------- ADD GALLERY ---------- */
if (isset($_POST['addNewGallery'])) {
    if (!app_validate_csrf_token($_POST['csrf_token'] ?? '')) {
        $msg = "Your session expired. Please try again.";
    } else {

    $categoryIdValue = isset($_POST['categoryId']) ? trim((string)$_POST['categoryId']) : '';
    $categoryId  = (int)$categoryIdValue;
    $imgName  = trim($_POST['imageName']);
    $imgDesc  = trim($_POST['imgDesc']);

    if ($categoryIdValue === '' || $imgName == "" || $_FILES['galleryImage']['error'] != 0) {
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
                'category_id' => $categoryId,
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

$categories = $fcObj->getGalleryCategories($tbGalleryCategory, true);
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

    .add-gallery-page input[type="file"].form-control {
        padding: 0;
        min-height: 52px;
        line-height: 1.2;
        cursor: pointer;
    }

    .add-gallery-page input[type="file"].form-control::file-selector-button {
        height: 52px;
        margin: 0;
        border: 0;
        border-right: 1px solid #c8d8ea;
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
        padding: 0 16px;
        background: #ffffff;
        color: #1f3d60;
        font-weight: 600;
        cursor: pointer;
    }

    .add-gallery-page input[type="file"].form-control::-webkit-file-upload-button {
        height: 52px;
        margin: 0;
        border: 0;
        border-right: 1px solid #c8d8ea;
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
        padding: 0 16px;
        background: #ffffff;
        color: #1f3d60;
        font-weight: 600;
        cursor: pointer;
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
        <p class="page-subtitle">Attach photos to any admin-managed gallery category.</p>
    </div>

    <div class="card gallery-form-card border-0">
        <div class="card-body">

            <?php if ($msg != "") { ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php } ?>

            <?php if (empty($categories)) { ?>
                <div class="alert alert-warning">
                    Create a gallery category first in <a href="categories.php">Manage Categories</a> before uploading images.
                </div>
            <?php } ?>

            <form action="add_gallery.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(app_get_csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">

                <div class="mb-3">
                    <label class="form-label">Select Category</label>
                    <select name="categoryId" class="form-select" required <?php echo empty($categories) ? 'disabled' : ''; ?>>
                        <option value="">SELECT</option>
                        <?php foreach ($categories as $category) { ?>
                            <?php $optVal = (string)$category['id']; ?>
                            <option value="<?php echo htmlspecialchars($optVal, ENT_QUOTES, 'UTF-8'); ?>" <?php if ((string)$categoryId === $optVal) echo "selected"; ?>>
                                <?php echo htmlspecialchars((string)$category['category_name'], ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <div class="upload-hint">Need a new section first? Create it in <a href="categories.php">Manage Categories</a>.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Name</label>
                    <input type="text" name="imageName" class="form-control" value="<?php echo htmlspecialchars($imgName, ENT_QUOTES, 'UTF-8'); ?>" required <?php echo empty($categories) ? 'disabled' : ''; ?>>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Description</label>
                    <textarea name="imgDesc" class="form-control" <?php echo empty($categories) ? 'disabled' : ''; ?>><?php echo htmlspecialchars($imgDesc, ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="galleryImage" class="form-control" accept=".jpg,.jpeg,.png,.webp" required <?php echo empty($categories) ? 'disabled' : ''; ?>>
                    <div class="upload-hint">Allowed: JPG, PNG, WEBP</div>
                </div>

                <div class="action-row">
                    <button type="submit" name="addNewGallery" class="btn btn-primary" <?php echo empty($categories) ? 'disabled' : ''; ?>>
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
