<?php 
include_once('main_header.php');
require_once("../libraries/functions.class.php");

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

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="fw-bold">Gallery Management</h3>

        <div class="d-flex gap-2">

            <!-- Filter Dropdown -->
            <form method="GET">
                <select name="event" class="form-select form-select-sm"
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

            <a href="add_gallery.php" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Add Image
            </a>

        </div>
    </div>

    <!-- Event Sections -->
    <?php for($i=0; $i<$noOfEvents; $i++) { ?>

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-light d-flex justify-content-between align-items-center">

                <span class="fw-semibold">
                    <?php echo $events[$i]['event_name']; ?>
                </span>

                <span class="badge bg-secondary">
                    <?php echo sizeof($galleryImages[$i]); ?> Images
                </span>

            </div>

            <div class="card-body">

                <?php if (empty($galleryImages[$i])) { ?>

                    <div class="text-center text-muted py-4">
                        No images available for this event.
                    </div>

                <?php } else { ?>

                    <div class="row g-3">

                        <?php foreach($galleryImages[$i] as $image) { ?>

                            <div class="col-md-4 col-lg-3">

                                <div class="card border-0 shadow-sm h-100">

                                    <img src="../gallery/<?php echo $image['image_name']; ?>"
                                         class="card-img-top"
                                         style="height:180px; object-fit:cover;"
                                         alt="Gallery Image">

                                    <div class="card-body text-center p-2">

                                        <small class="d-block mb-2 text-muted">
                                            <?php echo $image['name']; ?>
                                        </small>

                                        <a href="delete_gallery.php?image=<?php echo $image['id']; ?>"
                                           class="btn btn-sm btn-outline-danger"
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

<?php include_once('footer.php'); ?>
