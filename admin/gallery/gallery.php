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
    .gallery-page .gallery-header {
        border: 1px solid #cfdced;
        border-radius: 18px;
        padding: 18px 22px;
        background:
            linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
            #f8fbff;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
    }

    .gallery-page .gallery-title {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.6px;
        color: #0f172a;
        margin: 0;
    }

    .gallery-page .gallery-subtitle {
        margin: 8px 0 0;
        color: #53677f;
        font-size: 15px;
    }

    .gallery-page .toolbar-select {
        min-width: 220px;
        min-height: 46px;
        border: 1px solid #c8d8ea;
        border-radius: 12px;
        background: #f6faff;
        font-weight: 600;
        color: #1f3d60;
    }

    .gallery-page .toolbar-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        background: #fff;
    }

    .gallery-page .add-image-btn {
        border: 0;
        border-radius: 12px;
        padding: 12px 18px;
        background: linear-gradient(135deg, #102a48, #123b66);
        color: #fff;
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
    }

    .gallery-page .add-image-btn:hover {
        color: #fff;
        filter: brightness(1.06);
    }

    .gallery-page .event-gallery-card {
        border: 1px solid #d7dde6;
        border-radius: 16px;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .gallery-page .event-gallery-header {
        background: linear-gradient(90deg, #f8fbff, #f3f8ff);
        border-bottom: 1px solid #dce7f3;
        padding: 14px 18px;
    }

    .gallery-page .event-gallery-header .fw-semibold {
        font-size: 36px;
        font-weight: 700 !important;
        color: #17385d;
        letter-spacing: -0.4px;
        line-height: 1.15;
    }

    .gallery-page .event-count {
        background: linear-gradient(135deg, #64748b, #475569) !important;
        font-size: 15px;
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 700;
    }

    .gallery-page .empty-state {
        color: #64748b;
        font-size: 18px;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        background: #f8fafc;
        padding: 16px;
    }

    .gallery-page .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 14px;
    }

    .gallery-page .image-card {
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 6px 14px rgba(15, 23, 42, 0.05);
        transition: transform .2s ease, box-shadow .2s ease;
        background: #fff;
    }

    .gallery-page .image-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.1);
    }

    .gallery-page .image-card img {
        width: 100%;
        height: 210px;
        object-fit: cover;
        display: block;
        background: #eef4fb;
    }

    .gallery-page .image-name {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 38px;
        color: #536b84 !important;
    }

    .gallery-page .delete-image-btn {
        border-radius: 11px;
        font-weight: 700;
        padding: 7px 14px;
    }

    @media (max-width: 991px) {
        .gallery-page .gallery-title {
            font-size: 26px;
        }

        .gallery-page .event-gallery-header .fw-semibold {
            font-size: 28px;
        }

        .gallery-page .toolbar-select {
            min-width: 100%;
        }
    }

    @media (max-width: 767px) {
        .gallery-page .event-gallery-header .fw-semibold {
            font-size: 23px;
        }
    }
</style>

<div class="container-fluid gallery-page">

    <!-- Header -->
    <div class="gallery-header mb-4 d-flex justify-content-between align-items-start flex-wrap gap-3">

        <div>
            <h3 class="gallery-title">Gallery Management</h3>
            <p class="gallery-subtitle">Filter and manage event-wise gallery images.</p>
        </div>

        <div class="d-flex gap-2 flex-wrap">

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
                    <?php echo htmlspecialchars((string)$events[$i]['event_name'], ENT_QUOTES, 'UTF-8'); ?>
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

                    <div class="gallery-grid">

                        <?php foreach($galleryImages[$i] as $image) { ?>
                            <?php
                                $imageName = htmlspecialchars((string)$image['name'], ENT_QUOTES, 'UTF-8');
                                $imageFile = rawurlencode((string)$image['image_name']);
                            ?>

                            <div>

                                <div class="card image-card border-0 shadow-sm h-100">

                                    <img src="../gallery/<?php echo $imageFile; ?>"
                                         class="card-img-top"
                                         alt="Gallery Image">

                                    <div class="card-body text-center p-2">

                                        <small class="d-block mb-2 image-name">
                                            <?php echo $imageName; ?>
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
