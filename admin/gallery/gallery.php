<?php require_once(__DIR__ . '/../../config.php');?>
<?php 
include_once('../layout/main_header.php');

 
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();

$tbGallery = TB_GALLERY;
$tbGalleryCategory = TB_GALLERY_CATEGORY;

/* ---------- CATEGORY FILTER ---------- */

$selectedCategory = trim((string)($_GET['category'] ?? ''));

$categoriesList = $fcObj->getGalleryCategories($tbGalleryCategory);
$categoriesWithImages = $fcObj->getEventGallery($tbGallery);

if ($selectedCategory !== '') {
    $categories = $fcObj->getGalleryCategoryById($tbGalleryCategory, (int)$selectedCategory);
} else {
    $categories = $categoriesWithImages;
}

$noOfCategories = sizeof($categories);

for ($i=0; $i<$noOfCategories; $i++) {
    $galleryImages[$i] = $fcObj->getImagesForEvents($tbGallery, $categories[$i]['id']);
}

function getAdminGalleryImageUrl($fileName) {
    $fileName = trim((string)$fileName);
    if ($fileName === '') {
        return '';
    }

    $encoded = rawurlencode($fileName);
    $adminPath = __DIR__ . '/' . $fileName;
    if (file_exists($adminPath)) {
        return $encoded;
    }

    $legacyPath = dirname(__DIR__) . '/../gallery/' . $fileName;
    if (file_exists($legacyPath)) {
        return '../../gallery/' . $encoded;
    }

    return $encoded;
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
        font-size: 24px;
        font-weight: 800;
        letter-spacing: -0.3px;
        color: #0f172a;
        margin: 0;
    }

    .gallery-page .gallery-subtitle {
        margin: 8px 0 0;
        color: #53677f;
        font-size: 14px;
    }

    .gallery-page .toolbar-select {
        min-width: 220px;
        min-height: 42px;
        border: 1px solid #c8d8ea;
        border-radius: 12px;
        background: #f6faff;
        font-weight: 600;
        font-size: 14px;
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
        padding: 10px 16px;
        background: linear-gradient(135deg, #102a48, #123b66);
        color: #fff;
        font-weight: 700;
        font-size: 14px;
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
        font-size: 22px;
        font-weight: 700 !important;
        color: #17385d;
        letter-spacing: -0.2px;
        line-height: 1.15;
    }

    .gallery-page .event-count {
        background: linear-gradient(135deg, #64748b, #475569) !important;
        font-size: 13px;
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 700;
    }

    .gallery-page .empty-state {
        color: #64748b;
        font-size: 15px;
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
        font-size: 14px;
        color: #536b84 !important;
    }

    .gallery-page .delete-image-btn {
        border-radius: 11px;
        font-weight: 700;
        padding: 7px 14px;
        font-size: 14px;
    }

    .gallery-page .card-body {
        font-size: 14px;
    }

    html[data-theme="dark"] .gallery-page .gallery-header,
    html[data-theme="dark"] .gallery-page .event-gallery-card,
    html[data-theme="dark"] .gallery-page .image-card {
        background: #10233a !important;
        border-color: #2a3f5d !important;
        box-shadow: 0 12px 24px rgba(2, 8, 20, 0.4) !important;
    }

    html[data-theme="dark"] .gallery-page .gallery-title,
    html[data-theme="dark"] .gallery-page .event-gallery-header .fw-semibold {
        color: #e6f0ff !important;
    }

    html[data-theme="dark"] .gallery-page .gallery-subtitle,
    html[data-theme="dark"] .gallery-page .image-name,
    html[data-theme="dark"] .gallery-page .empty-state {
        color: #bcd0ea !important;
    }

    html[data-theme="dark"] .gallery-page .event-gallery-header {
        background: #1a2d48 !important;
        border-bottom-color: #2a3f5d !important;
    }

    html[data-theme="dark"] .gallery-page .event-count {
        background: #304a6f !important;
        color: #eaf2ff !important;
    }

    html[data-theme="dark"] .gallery-page .toolbar-select {
        background: #13253e !important;
        border-color: #2f4a6f !important;
        color: #e6f0ff !important;
    }

    html[data-theme="dark"] .gallery-page .toolbar-select:focus {
        background: #162c49 !important;
        border-color: #5a8dd2 !important;
        box-shadow: 0 0 0 4px rgba(90, 141, 210, 0.24) !important;
    }

    html[data-theme="dark"] .gallery-page .empty-state {
        background: #122840 !important;
        border-color: #2d4669 !important;
    }

    html[data-theme="dark"] .gallery-page .delete-image-btn {
        color: #ffd4dc !important;
        border-color: #ff6b83 !important;
    }

    @media (max-width: 991px) {
        .gallery-page .gallery-title {
            font-size: 22px;
        }

        .gallery-page .event-gallery-header .fw-semibold {
            font-size: 20px;
        }

        .gallery-page .toolbar-select {
            min-width: 100%;
        }
    }

    @media (max-width: 767px) {
        .gallery-page .event-gallery-header .fw-semibold {
            font-size: 18px;
        }
    }
</style>

<div class="container-fluid gallery-page">

    <!-- Header -->
    <div class="gallery-header mb-4 d-flex justify-content-between align-items-start flex-wrap gap-3">

        <div>
            <h3 class="gallery-title">Gallery Management</h3>
            <p class="gallery-subtitle">Filter and manage gallery images category-wise.</p>
        </div>

        <div class="d-flex gap-2 flex-wrap">

            <!-- Filter Dropdown -->
            <form method="GET">
                <select name="category" class="form-select form-select-sm toolbar-select"
                        onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php foreach($categoriesList as $categoryItem){ ?>
                        <option value="<?php echo (int)$categoryItem['id']; ?>"
                            <?php if($selectedCategory==(string)$categoryItem['id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars((string)$categoryItem['category_name'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php } ?>
                </select>
            </form>

            <a href="categories.php" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-tags me-1"></i> Manage Categories
            </a>

            <a href="add_gallery.php" class="btn add-image-btn btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Add Image
            </a>

        </div>
    </div>

    <!-- Category Sections -->
    <?php if ($noOfCategories === 0) { ?>
        <div class="card event-gallery-card border-0 mb-4">
            <div class="card-body">
                <div class="text-center text-muted py-4 empty-state">
                    No gallery categories with images are available yet.
                </div>
            </div>
        </div>
    <?php } ?>

    <?php for($i=0; $i<$noOfCategories; $i++) { ?>

        <div class="card event-gallery-card border-0 mb-4">

            <div class="card-header event-gallery-header d-flex justify-content-between align-items-center">

                <span class="fw-semibold">
                    <?php echo htmlspecialchars((string)$categories[$i]['event_name'], ENT_QUOTES, 'UTF-8'); ?>
                </span>

                <span class="badge bg-secondary event-count">
                    <?php echo sizeof($galleryImages[$i]); ?> Images
                </span>

            </div>

            <div class="card-body">

                <?php if (empty($galleryImages[$i])) { ?>

                    <div class="text-center text-muted py-4 empty-state">
                        No images available for this category.
                    </div>

                <?php } else { ?>

                    <div class="gallery-grid">

                        <?php foreach($galleryImages[$i] as $image) { ?>
                            <?php
                                $imageName = htmlspecialchars((string)$image['name'], ENT_QUOTES, 'UTF-8');
                            ?>

                            <div>

                                <div class="card image-card border-0 shadow-sm h-100">

                                    <img src="<?php echo htmlspecialchars((string)getAdminGalleryImageUrl($image['image_name']), ENT_QUOTES, 'UTF-8'); ?>"
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
