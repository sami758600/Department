<?php 
include_once('header.php');
require_once("libraries/functions.class.php");

$fcObj = new DataFunctions();

$tbGallery = TB_GALLERY;
$tbEvents  = TB_EVENTS;

if (isset($_REQUEST['event'])) {

    $eventId = $_REQUEST['event'];

    if ($eventId == 0) {
        $events[0]['id'] = 0;
        $events[0]['event_name'] = 'Others';
    } else {
        $events = $fcObj->getEventDetails($tbEvents, $eventId);
    }

} else {

    $events = $fcObj->getEventGallery($tbGallery);
    $eventCnt = sizeof($events);

    $events[$eventCnt]['id'] = 0;
    $events[$eventCnt]['event_name'] = 'Others';
}

$noOfEvents = sizeof($events);

for ($i = 0; $i < $noOfEvents; $i++) {
    $eventId = $events[$i]['id'];
    $galleryImages[$i] = $fcObj->getImagesForEvents($tbGallery, $eventId);
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
                            <a href="gallery/<?php echo $galleryImages[$i][$j]['image_name']; ?>" 
                               data-bs-toggle="modal"
                               data-bs-target="#imageModal"
                               onclick="showImage(this.href); return false;">

                                <img src="gallery/<?php echo $galleryImages[$i][$j]['image_name']; ?>"
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

<?php include_once('footer.php'); ?>
