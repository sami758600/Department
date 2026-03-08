<?php 
require_once(__DIR__ . '/../../config.php');

include_once(INCLUDES_PATH . '/header.php');
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbGallery = TB_GALLERY;
$tbEvents  = TB_EVENTS;

if (isset($_REQUEST['event'])) {

    $eventId = $_REQUEST['event'];

    if ($eventId == 0) {
        $events[0]['id'] = 0;
        $events[0]['event_name'] = 'Others';
    } elseif ($eventId == -1) {
        $events[0]['id'] = -1;
        $events[0]['event_name'] = 'Press News';
    } else {
        $events = $fcObj->getEventDetails($tbEvents, $eventId);
    }

} else {

    $events = $fcObj->getEventGallery($tbGallery);
    $eventCnt = sizeof($events);

    $events[$eventCnt]['id'] = 0;
    $events[$eventCnt]['event_name'] = 'Others';
    $events[$eventCnt + 1]['id'] = -1;
    $events[$eventCnt + 1]['event_name'] = 'Press News';
}

$noOfEvents = sizeof($events);

for ($i = 0; $i < $noOfEvents; $i++) {
    $eventId = $events[$i]['id'];
    $galleryImages[$i] = $fcObj->getImagesForEvents($tbGallery, $eventId);
}

/**
 * Resolve gallery image URL for public pages.
 * New uploads are stored in /admin/gallery, while some older files exist in /gallery.
 */
function getPublicGalleryImageUrl($fileName) {
    $fileName = trim((string)$fileName);
    if ($fileName === '') {
        return '';
    }

    $encoded = rawurlencode($fileName);

    $adminPath = ROOT_PATH . '/admin/gallery/' . $fileName;
    if (file_exists($adminPath)) {
        return BASE_URL . '/admin/gallery/' . $encoded;
    }

    $legacyPath = ROOT_PATH . '/gallery/' . $fileName;
    if (file_exists($legacyPath)) {
        return BASE_URL . '/gallery/' . $encoded;
    }

    return BASE_URL . '/admin/gallery/' . $encoded;
}

?>

<div class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold">Gallery</h2>
        <p class="text-muted">Moments captured from our academic and association activities</p>
    </div>

    <?php for ($i = 0; $i < $noOfEvents; $i++) { ?>

        <div class="mb-5">

            <!-- Event Title -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-semibold">
                    <?php echo $events[$i]['event_name']; ?>
                </h4>

                <?php if (!isset($_REQUEST['event'])) { ?>
                    <a href="gallery.php?event=<?php echo $events[$i]['id']; ?>" 
                       class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                <?php } ?>
            </div>

            <!-- Image Grid -->
            <div class="row g-4">

                <?php
                    $noOfImages = sizeof($galleryImages[$i]);

                    if ($noOfImages > 6 && !isset($_REQUEST['event'])) {
                        $imagesCount = 6;
                    } else {
                        $imagesCount = $noOfImages;
                    }

                    for ($j = 0; $j < $imagesCount; $j++) {
                ?>

                    <div class="col-md-4 col-lg-3">
                        <div class="card border-0 shadow-sm gallery-card">
                            <?php
                                $imageUrl = getPublicGalleryImageUrl($galleryImages[$i][$j]['image_name']);
                            ?>
                            <a href="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8'); ?>" 
                               data-bs-toggle="modal"
                               data-bs-target="#imageModal"
                               onclick="showImage(this.href); return false;">

                                <img src="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8'); ?>"
                                     class="card-img-top gallery-img"
                                     alt="<?php echo $events[$i]['event_name']; ?>">
                            </a>
                        </div>
                    </div>

                <?php } ?>

            </div>

        </div>

    <?php } ?>

</div>


<!-- IMAGE MODAL -->
<div class="modal fade" id="imageModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-body text-center p-0">
        <img id="modalImage" src="" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<script>
function showImage(src) {
    document.getElementById("modalImage").src = src;
}
</script>

<?php include_once(INCLUDES_PATH . '/footer.php'); ?>
