<?php require_once(__DIR__ . '/../../config.php');
	include_once('../layout/main_header.php');
	include_once('../layout/core_forms_style.php');
	include_once('../layout/events_list_style.php');

	require_once(LIB_PATH . '/functions.class.php');

	$fcObj = new DataFunctions();

	if (isset($_REQUEST['event'])) {
		$eventId = intval($_REQUEST['event']);
	} else {
		$eventId = 0;
	}

	$tbEvents = TB_EVENTS;
	$tbEventRes = TB_EVENT_RESULT;
	$tbEventReg = TB_EVENT_REG;

	$eventSLCandDet = $fcObj->getEventSLCand($tbEventReg, $eventId);
	$eventDetails = $fcObj->getEventDetails($tbEvents, $eventId);

	$noOfSLCand = sizeof($eventSLCandDet);
	$eventTitle = ($eventDetails && isset($eventDetails[0]['event_name'])) ? $eventDetails[0]['event_name'] : 'Unknown Event';
	$eventDbId = ($eventDetails && isset($eventDetails[0]['id'])) ? $eventDetails[0]['id'] : 0;
?>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>AIML Association</h4>
						</span>
						<p></p>
					</div>
					<div id='content_left' class='content_left'>
						<?php include_once('../layout/leftnav.php'); ?>
					</div>
					<div id='content_right' class='content_right'>
						<div class="eventDetails event-result-card">
							<div class="eventTitle event-meta-row">
								<div class="eventHead">Event Title :</div>
								<div class="eventDes"><?php echo htmlspecialchars($eventTitle, ENT_QUOTES, 'UTF-8'); ?></div>
							</div>

							<div class="eventTitle event-grid-header">
								<div class="checkBox"></div>
								<div class="eventName">Candidate Name</div>
								<div class="eventName">Admission Id</div>
								<div class="eventRegisDates">Award</div>
							</div>

							<form action="eventresannounce.php" method="post" enctype="multipart/form-data">
								<?php if ($noOfSLCand > 0) { ?>
									<?php for ($i = 0; $i < $noOfSLCand; $i++) { ?>
										<div class="eventDet event-grid-row">
											<div class="checkBox">
												<input type="checkbox" name="<?php echo $i; ?>[user_id]" value="<?php echo intval($eventSLCandDet[$i]['id']); ?>" />
											</div>
											<div class="eventName">
												<?php
													echo htmlspecialchars(
														$eventSLCandDet[$i]['firstname'] . ' ' . $eventSLCandDet[$i]['lastname'],
														ENT_QUOTES,
														'UTF-8'
													);
												?>
											</div>
											<div class="eventName">
												<?php echo htmlspecialchars($eventSLCandDet[$i]['admission_id'], ENT_QUOTES, 'UTF-8'); ?>
											</div>
											<div class="eventRegisDates">
												<input type="text" name="<?php echo $i; ?>[award]" value="" placeholder="Winner / Runner-up" />
											</div>
										</div>
									<?php } ?>
								<?php } else { ?>
									<div class="eventDet no-data">No users are shortlisted.</div>
								<?php } ?>

								<input type="hidden" name="eventName" value="<?php echo htmlspecialchars($eventTitle, ENT_QUOTES, 'UTF-8'); ?>" />
								<input type="hidden" name="eventId" value="<?php echo intval($eventDbId); ?>" />
								<input type="submit" class="button" name="announceResult" value="Announce Result" />
							</form>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				<?php include_once('../layout/sidebar.php'); ?>
				<br class="clearfix" />
			</div>
		</div>

<style type="text/css">
	.event-result-card {
		background: #ffffff;
		border: 1px solid #e5e7eb;
		border-radius: 14px;
		box-shadow: 0 10px 24px rgba(15, 23, 42, 0.07);
		padding: 16px;
	}

	.event-result-card .event-meta-row,
	.event-result-card .event-grid-header,
	.event-result-card .event-grid-row {
		display: grid;
		grid-template-columns: 80px 1fr 180px 1.2fr;
		gap: 10px;
		align-items: center;
		padding: 10px 12px;
		border-bottom: 1px solid #e5e7eb;
	}

	.event-result-card .event-meta-row {
		grid-template-columns: 130px 1fr;
		background: #f8fafc;
		border: 1px solid #e2e8f0;
		border-radius: 10px;
		margin-bottom: 10px;
	}

	.event-result-card .event-grid-header {
		background: #eef2ff;
		border: 1px solid #dbe5fb;
		border-radius: 10px;
		color: #1e3a8a;
		font-weight: 700;
		margin-bottom: 8px;
	}

	.event-result-card .event-grid-row:last-of-type {
		border-bottom: 0;
	}

	.event-result-card .eventHead {
		font-weight: 700;
		color: #334155;
	}

	.event-result-card .eventDes,
	.event-result-card .eventName,
	.event-result-card .eventRegisDates {
		word-break: break-word;
	}

	.event-result-card input[type="checkbox"] {
		width: 18px;
		height: 18px;
	}

	.event-result-card input[type="text"] {
		width: 100%;
		min-height: 42px;
		padding: 9px 12px;
		border: 1px solid #cbd5e1;
		border-radius: 10px;
		background: #f8fafc;
		outline: none;
	}

	.event-result-card input[type="text"]:focus {
		border-color: #2563eb;
		background: #ffffff;
		box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
	}

	.event-result-card .button {
		margin-top: 16px;
		border: 0;
		border-radius: 12px;
		padding: 10px 20px;
		background: linear-gradient(135deg, #0f172a, #1e3a8a);
		color: #fff;
		font-weight: 700;
		box-shadow: 0 8px 16px rgba(30, 58, 138, 0.2);
	}

	.event-result-card .no-data {
		display: block;
		font-weight: 600;
		color: #475569;
		padding: 18px 12px;
		border-bottom: 0;
	}

	@media (max-width: 980px) {
		.event-result-card .event-grid-header,
		.event-result-card .event-grid-row {
			grid-template-columns: 1fr;
		}

		.event-result-card .event-meta-row {
			grid-template-columns: 1fr;
		}
	}
</style>

<?php include_once('../layout/footer.php'); ?>
