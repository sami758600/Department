<?php require_once(__DIR__ . '/../config.php'); ?>
<?php
include_once('layout/main_header.php');
require_once(LIB_PATH . '/functions.class.php');

$message = "";
$type = "";

if (isset($_POST['changeImage'])) {
    $imagePos = $_POST['imagePos'];
    $fileName = $_FILES['scollImage']['name'];
    $tmpName  = $_FILES['scollImage']['tmp_name'];

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
    .slider-page .slider-title {
        font-size: 40px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
        margin-bottom: 16px;
    }

    .slider-page .slider-card {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
        background: #ffffff;
    }

    .slider-page .form-label {
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .slider-page .form-select,
    .slider-page .form-control {
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        min-height: 48px;
        background: #f8fafc;
    }

    .slider-page .form-select:focus,
    .slider-page .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        background: #ffffff;
    }

    .slider-page .size-hint {
        color: #64748b;
        font-size: 16px;
        line-height: 1.7;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 10px 12px;
    }

    .slider-page .btn-primary {
        border: 0;
        border-radius: 12px;
        padding: 10px 18px;
        background: linear-gradient(135deg, #1f2937, #111827);
        font-weight: 700;
        box-shadow: 0 8px 16px rgba(17, 24, 39, 0.2);
    }

    .slider-page .btn-outline-secondary {
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 600;
    }
</style>

<div class="slider-page">
    <h3 class="slider-title">Change Slider Images</h3>

    <div class="card slider-card border-0">
        <div class="card-body">

            <?php if ($message != "") { ?>
                <div class="alert alert-<?php echo $type; ?>">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Select Image Position</label>
                    <select name="imagePos" class="form-select" required>
                        <option value="">-- Select Position --</option>
                        <option value="0">Logo</option>
                        <option value="1">1st Position</option>
                        <option value="2">2nd Position</option>
                        <option value="3">3rd Position</option>
                        <option value="4">4th Position</option>
                        <option value="5">5th Position</option>
                        <option value="6">6th Position</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Upload Image</label>
                    <input type="file" name="scollImage" class="form-control" required>
                </div>

                <div class="mb-3 size-hint">
                    <div>Logo Size: <strong>1024px x 113px</strong></div>
                    <div>Slider Image Size: <strong>1004px x 300px</strong></div>
                </div>

                <button type="submit" name="changeImage" class="btn btn-primary">Update Image</button>
                <button type="reset" class="btn btn-outline-secondary ms-2">Reset</button>
            </form>
        </div>
    </div>
</div>

<?php include_once('layout/footer.php'); ?>
