<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
include_once('../layout/main_header.php');

 
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbGallery = TB_GALLERY;
$tbEvents  = TB_EVENTS;

/* ---------- EVENT FILTER ---------- */

$selectedEvent = isset($_GET['event']) ? $_GET['event'] : '';

$eventsList = $fcObj->getEventGallery($tbGallery);
$eventsList[] = ['id' => 0,  'event_name' => 'Others'];
$eventsList[] = ['id' => -1, 'event_name' => 'Press News'];

if ($selectedEvent !== '') {

    if ($selectedEvent == 0) {
        $events = [['id'=>0, 'event_name'=>'Others']];
    } 
    else if ($selectedEvent == -1) {
        $events = [['id'=>-1, 'event_name'=>'Press News']];
    } 
    else {
        $events = $fcObj->getEventDetails($tbEvents, $selectedEvent);
    }

} else {
    $events = $eventsList;
}

$noOfEvents = sizeof($events);

for ($i=0; $i<$noOfEvents; $i++) {
    $galleryImages[$i] = $fcObj->getImagesForEvents($tbGallery, $events[$i]['id']);
}
?>

<style type="text/css">
    .gallery-page .gallery-title {
        font-size: 24px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
        margin: 0;
    }

    .gallery-page .toolbar-select {
        min-width: 170px;
        min-height: 44px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        background: #f8fafc;
    }

    .gallery-page .toolbar-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        background: #fff;
    }

    .gallery-page .add-image-btn {
        border: 0;
        border-radius: 12px;
        padding: 10px 16px;
        background: linear-gradient(135deg, #1f2937, #111827);
        color: #fff;
        font-weight: 700;
        box-shadow: 0 8px 16px rgba(17, 24, 39, 0.2);
    }

    .gallery-page .add-image-btn:hover {
        color: #fff;
        filter: brightness(1.06);
    }

    .gallery-page .event-gallery-card {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }

    .gallery-page .event-gallery-header {
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        padding: 12px 16px;
    }

    .gallery-page .event-gallery-header .fw-semibold {
        font-size: 22px;
        font-weight: 700 !important;
        color: #1f2937;
    }

    .gallery-page .event-count {
        background: #64748b !important;
        font-size: 16px;
        padding: 6px 10px;
        border-radius: 999px;
    }

    .gallery-page .empty-state {
        color: #64748b;
        font-size: 18px;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        background: #f8fafc;
        padding: 16px;
    }

    .gallery-page .image-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 14px rgba(15, 23, 42, 0.05);
    }

    .gallery-page .image-card img {
        height: 180px;
        object-fit: cover;
    }

    .gallery-page .delete-image-btn {
        border-radius: 10px;
        font-weight: 700;
    }
</style>

<div class="container-fluid gallery-page">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="gallery-title">Gallery Management</h3>

        <div class="d-flex gap-2">

            <!-- Filter Dropdown -->
            <form method="GET">
                <select name="event" class="form-select form-select-sm toolbar-select"
                        onchange="this.form.submit()">
                    <option value="">All Events</option>
                    <?php foreach($eventsList as $ev){ ?>
                        <option value="<?php echo $ev['id']; ?>"
                            <?php if($selectedEvent==$ev['id']) echo 'selected'; ?>>
                            <?php echo $ev['event_name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </form>

            <a href="add_gallery.php" class="btn add-image-btn btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Add Image
            </a>

        </div>
    </div>

    <!-- Event Sections -->
    <?php for($i=0; $i<$noOfEvents; $i++) { ?>

        <div class="card event-gallery-card border-0 mb-4">

            <div class="card-header event-gallery-header d-flex justify-content-between align-items-center">

                <span class="fw-semibold">
                    <?php echo $events[$i]['event_name']; ?>
                </span>

                <span class="badge bg-secondary event-count">
                    <?php echo sizeof($galleryImages[$i]); ?> Images
                </span>

            </div>

            <div class="card-body">

                <?php if (empty($galleryImages[$i])) { ?>

                    <div class="text-center text-muted py-4 empty-state">
                        No images available for this event.
                    </div>

                <?php } else { ?>

                    <div class="row g-3">

                        <?php foreach($galleryImages[$i] as $image) { ?>

                            <div class="col-md-4 col-lg-3">

                                <div class="card image-card border-0 shadow-sm h-100">

                                    <img src="../gallery/<?php echo $image['image_name']; ?>"
                                         class="card-img-top"
                                         alt="Gallery Image">

                                    <div class="card-body text-center p-2">

                                        <small class="d-block mb-2 text-muted">
                                            <?php echo $image['name']; ?>
                                        </small>

                                        <a href="delete_gallery.php?image=<?php echo $image['id']; ?>"
                                           class="btn btn-sm btn-outline-danger delete-image-btn"
                                           onclick="return confirm('Are you sure you want to delete this image?')">
                                            Delete
                                        </a>

                                    </div>

                                </div>

                            </div>

                        <?php } ?>

                    </div>

                <?php } ?>

            </div>

        </div>

    <?php } ?>

</div>

<?php include_once('../layout/footer.php'); ?>
