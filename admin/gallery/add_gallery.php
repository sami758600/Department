<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
  
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbEvent   = TB_EVENTS;
$tbGallery = TB_GALLERY;

$msg = "";

/* ---------- ADD GALLERY ---------- */
if (isset($_POST['addNewGallery'])) {

    $eventId  = $_POST['eventId'];
    $imgName  = trim($_POST['imageName']);
    $imgDesc  = trim($_POST['imgDesc']);

    if ($eventId == "" || $imgName == "" || $_FILES['galleryImage']['error'] != 0) {
        $msg = "All fields are required.";
    } else {

        $fileExt = pathinfo($_FILES['galleryImage']['name'], PATHINFO_EXTENSION);
        $fileName = strtolower(str_replace(' ', '', $imgName)) . "." . $fileExt;

        if (move_uploaded_file($_FILES['galleryImage']['tmp_name'], "../gallery/" . $fileName)) {

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
                $msg = "Database error. Please try again.";
            }

        } else {
            $msg = "Image upload failed.";
        }
    }
}

include_once('../layout/main_header.php');

$events = $fcObj->getEventDetails($tbEvent);
?>

<style type="text/css">
    .add-gallery-page .page-title {
        font-size: 36px;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: #0f172a;
        margin-bottom: 16px;
    }

    .add-gallery-page .gallery-form-card {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
        background: #ffffff;
    }

    .add-gallery-page .form-label {
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .add-gallery-page .form-control,
    .add-gallery-page .form-select {
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        min-height: 48px;
        background: #f8fafc;
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
        padding: 10px 18px;
        background: linear-gradient(135deg, #1f2937, #111827);
        font-weight: 700;
        box-shadow: 0 8px 16px rgba(17, 24, 39, 0.2);
    }

    .add-gallery-page .btn-secondary {
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 600;
    }
</style>

<div class="container-fluid add-gallery-page">

    <h3 class="page-title">Add New Gallery Image</h3>

    <div class="card gallery-form-card border-0">
        <div class="card-body">

            <?php if ($msg != "") { ?>
                <div class="alert alert-danger">
                    <?php echo $msg; ?>
                </div>
            <?php } ?>

            <form action="add_gallery.php" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Select Event</label>
                    <select name="eventId" class="form-select" required>
                        <option value="">SELECT</option>
                        <option value="0">OTHER</option>
                        <option value="-1">Press News</option>
                        <?php foreach ($events as $event) { ?>
                            <option value="<?php echo $event['id']; ?>">
                                <?php echo $event['event_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Name</label>
                    <input type="text" name="imageName" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Description</label>
                    <input type="text" name="imgDesc" class="form-control">
                </div>

                <div class="mb-4">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="galleryImage" class="form-control" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="addNewGallery" class="btn btn-primary">
                        Add Gallery
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
