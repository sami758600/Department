<?php require_once(__DIR__ . '/../config.php');?>
<?php 
include_once('layout/main_header.php');

// require_once("libraries/functions.class.php");
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

<h3 class="mb-4 fw-bold">Change Slider Images</h3>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <?php if ($message != "") { ?>
            <div class="alert alert-<?php echo $type; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Select Image Position
                </label>
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
                <label class="form-label fw-semibold">
                    Upload Image
                </label>
                <input type="file" name="scollImage" class="form-control" required>
            </div>

            <div class="mb-3 text-muted small">
                <div>Logo Size: <strong>1024px × 113px</strong></div>
                <div>Slider Image Size: <strong>1004px × 300px</strong></div>
            </div>

            <button type="submit" name="changeImage" class="btn btn-primary">
                Update Image
            </button>

            <button type="reset" class="btn btn-outline-secondary ms-2">
                Reset
            </button>

        </form>

    </div>
</div>

<?php include_once('layout/footer.php'); ?>
