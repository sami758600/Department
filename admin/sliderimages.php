<?php require_once(__DIR__ . '/../config.php'); ?>
<?php
include_once('layout/main_header.php');
require_once(LIB_PATH . '/functions.class.php');

$message = "";
$type = "";
$selectedPos = "";

if (isset($_POST['changeImage'])) {
    $imagePos = $_POST['imagePos'];
    $selectedPos = $imagePos;
    $fileName = $_FILES['scollImage']['name'];
    $tmpName = $_FILES['scollImage']['tmp_name'];

    if ($imagePos === "" || $fileName == "") {
        $message = "Please select image position and choose an image.";
        $type = "danger";
    } else {
        if ($imagePos == 0) {
            $targetPath = "../public/assets/images/wise.png";
        } else {
            $targetPath = "../public/assets/images/sliderimages/image_" . $imagePos . ".png";
        }

        if (move_uploaded_file($tmpName, $targetPath)) {
            $message = "Image updated successfully.";
            $type = "success";
        } else {
            $message = "Image upload failed. Please try again.";
            $type = "danger";
        }
    }
}
?>

<style type="text/css">
    .slider-page .slider-header {
        border: 1px solid #cfdced;
        border-radius: 18px;
        padding: 18px 22px;
        background:
            linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
            #f8fbff;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
        margin-bottom: 18px;
    }

    .slider-page .slider-title {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
        margin: 0;
    }

    .slider-page .slider-subtitle {
        margin: 8px 0 0;
        color: #53677f;
        font-size: 15px;
    }

    .slider-page .slider-card {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
        background: #ffffff;
    }

    .slider-page .form-label {
        font-size: 20px;
        font-weight: 700;
        color: #1f324b;
        margin-bottom: 8px;
    }

    .slider-page .form-select,
    .slider-page .form-control {
        border: 1px solid #c8d8ea;
        border-radius: 12px;
        min-height: 56px;
        background: #f6faff;
        font-size: 18px;
    }

    .slider-page .form-select:focus,
    .slider-page .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        background: #ffffff;
    }

    .slider-page .size-hint {
        color: #5d718c;
        font-size: 18px;
        line-height: 1.7;
        background: linear-gradient(90deg, #f8fbff, #f4f8fd);
        border: 1px dashed #bfd3ea;
        border-radius: 14px;
        padding: 12px 14px;
    }

    .slider-page .btn-primary {
        border: 0;
        border-radius: 12px;
        padding: 11px 22px;
        background: linear-gradient(135deg, #102a48, #123b66);
        font-weight: 700;
        font-size: 18px;
        box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
    }

    .slider-page .btn-outline-secondary {
        border-radius: 12px;
        padding: 11px 22px;
        font-weight: 600;
        font-size: 18px;
    }

    .slider-page .btn-primary:hover {
        filter: brightness(1.06);
    }

    .slider-page .action-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 4px;
    }

    @media (max-width: 768px) {
        .slider-page .slider-title {
            font-size: 26px;
        }

        .slider-page .form-label {
            font-size: 17px;
        }

        .slider-page .form-select,
        .slider-page .form-control,
        .slider-page .size-hint,
        .slider-page .btn-primary,
        .slider-page .btn-outline-secondary {
            font-size: 16px;
        }
    }
</style>

<div class="slider-page">
    <div class="slider-header">
        <h3 class="slider-title">Change Slider Images</h3>
        <p class="slider-subtitle">Update logo and homepage slider assets from one place.</p>
    </div>

    <div class="card slider-card border-0">
        <div class="card-body">

            <?php if ($message != "") { ?>
                <div class="alert alert-<?php echo $type; ?>">
                    <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Select Image Position</label>
                    <select name="imagePos" class="form-select" required>
                        <option value="">-- Select Position --</option>
                        <option value="0" <?php if ($selectedPos === "0") echo 'selected'; ?>>Logo</option>
                        <option value="1" <?php if ($selectedPos === "1") echo 'selected'; ?>>1st Position</option>
                        <option value="2" <?php if ($selectedPos === "2") echo 'selected'; ?>>2nd Position</option>
                        <option value="3" <?php if ($selectedPos === "3") echo 'selected'; ?>>3rd Position</option>
                        <option value="4" <?php if ($selectedPos === "4") echo 'selected'; ?>>4th Position</option>
                        <option value="5" <?php if ($selectedPos === "5") echo 'selected'; ?>>5th Position</option>
                        <option value="6" <?php if ($selectedPos === "6") echo 'selected'; ?>>6th Position</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Upload Image</label>
                    <input type="file" name="scollImage" class="form-control" accept=".png,.jpg,.jpeg,.webp" required>
                </div>

                <div class="mb-3 size-hint">
                    <div>Logo Size: <strong>1024px x 113px</strong></div>
                    <div>Slider Image Size: <strong>1004px x 300px</strong></div>
                </div>

                <div class="action-row">
                    <button type="submit" name="changeImage" class="btn btn-primary">
                        <i class="bi bi-upload me-1"></i> Update Image
                    </button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once('layout/footer.php'); ?>
