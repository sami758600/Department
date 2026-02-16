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

<div class="container-fluid">

    <h3 class="mb-4 fw-bold">Add New Gallery Image</h3>

    <div class="card shadow-sm border-0">
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
