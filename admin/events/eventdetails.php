<?php require_once(__DIR__ . '/../../config.php');
require_once(LIB_PATH . '/functions.class.php');

$fcObj = new DataFunctions();
$tbEvents = TB_EVENTS;

$eventId = isset($_GET['event']) ? (int)$_GET['event'] : 0;
$eventDetails = array();
if ($eventId > 0) {
    $eventDetails = $fcObj->getEventDetails($tbEvents, $eventId);
}

if (empty($eventDetails)) {
    header('Location: view_events.php');
    exit;
}

$event = $eventDetails[0];

include_once('../layout/main_header.php');
include_once('../layout/core_forms_style.php');
?>
<style type="text/css">
    #content_left {
        display: none;
    }

    #content {
        grid-template-columns: 1fr;
        gap: 0;
    }

    #page {
        max-width: none;
    }

    .event-detail-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.07);
        padding: 16px;
    }

    .event-detail-row {
        display: grid;
        grid-template-columns: 190px 1fr;
        gap: 10px;
        align-items: start;
        padding: 10px 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .event-detail-row:last-of-type {
        border-bottom: 0;
    }

    .event-label {
        font-weight: 700;
        color: #334155;
    }

    .event-value {
        color: #0f172a;
        line-height: 1.45;
        word-break: break-word;
    }

    .event-actions {
        margin-top: 14px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .event-actions .button {
        border: 0;
        border-radius: 12px;
        padding: 10px 20px;
        color: #fff;
        font-weight: 700;
    }

    .event-actions .btn-edit {
        background: linear-gradient(135deg, #1e3a8a, #1d4ed8);
    }

    .event-actions .btn-delete {
        background: linear-gradient(135deg, #b91c1c, #dc2626);
    }

    @media (max-width: 820px) {
        .event-detail-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div id="page">
    <div id="content">
        <div class="post">
            <span class="alignCenter"></span>
            <p></p>
        </div>
        <div id='content_left' class='content_left'></div>
        <div id='content_right' class='content_right'>
            <div class="event-detail-card">
                <div class="event-detail-row">
                    <div class="event-label">Event Title</div>
                    <div class="event-value"><?php echo htmlspecialchars((string)$event['event_name'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="event-detail-row">
                    <div class="event-label">Event Description</div>
                    <div class="event-value"><?php echo nl2br(htmlspecialchars((string)$event['event_desc'], ENT_QUOTES, 'UTF-8')); ?></div>
                </div>
                <div class="event-detail-row">
                    <div class="event-label">Event Date</div>
                    <div class="event-value"><?php echo htmlspecialchars((string)$event['event_date'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="event-detail-row">
                    <div class="event-label">Venue</div>
                    <div class="event-value"><?php echo nl2br(htmlspecialchars((string)$event['event_address'], ENT_QUOTES, 'UTF-8')); ?></div>
                </div>
                <div class="event-detail-row">
                    <div class="event-label">Registration Dates</div>
                    <div class="event-value">
                        <?php echo htmlspecialchars((string)$event['reg_frm_date'], ENT_QUOTES, 'UTF-8'); ?> to
                        <?php echo htmlspecialchars((string)$event['reg_to_date'], ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                </div>

                <div class="event-actions">
                    <a href="edit_event.php?event=<?php echo (int)$event['id']; ?>">
                        <input type="button" class="button btn-edit" value="Edit" />
                    </a>
                    <a href="delete_event.php?event=<?php echo (int)$event['id']; ?>" onclick="return confirm('Do You Want To Continue To Delete');">
                        <input type="button" class="button btn-delete" value="Delete" />
                    </a>
                </div>
            </div>
        </div>
        <br class="clearfix" />
    </div>
                    <div class="mt-3">
                    <a href="../settings/department_option.php?option=events" class="btn btn-outline-secondary">Back</a>
                </div><?php include_once('../layout/sidebar.php'); ?>
    <br class="clearfix" />
</div>
</div>

<?php include_once('../layout/footer.php'); ?>
