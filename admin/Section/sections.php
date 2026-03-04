<?php require_once(__DIR__ . '/../../config.php');

   require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSection	= TB_SECTION;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   for($i=0; $i<$classesCnt;$i++){
  		
		$classId		= $classes[$i]['id'];
		
		$sections[$i]	= $fcObj->getSections($tbSection,$classId);
	}
	
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

	.section-list-hero {
		border: 1px solid #cfdced;
		border-radius: 18px;
		padding: 18px 22px;
		background:
			linear-gradient(140deg, rgba(37, 99, 235, 0.06), rgba(15, 118, 110, 0.04)),
			#f8fbff;
		box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
		margin-bottom: 16px;
	}

	.section-list-title {
		margin: 0;
		font-size: 32px;
		font-weight: 800;
		letter-spacing: -0.6px;
		color: #0f172a;
	}

	.section-list-subtitle {
		margin: 8px 0 0;
		font-size: 15px;
		color: #556a84;
	}

	.section-list-card {
		background: #ffffff;
		border: 1px solid #d7dde6;
		border-radius: 16px;
		box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
		padding: 16px;
	}

	.section-group {
		border: 1px solid #dce7f3;
		border-radius: 14px;
		background: #f8fbff;
		margin-bottom: 12px;
		overflow: hidden;
	}

	.section-group:last-child {
		margin-bottom: 0;
	}

	.section-group-head {
		display: flex;
		align-items: center;
		gap: 10px;
		padding: 12px 14px;
		background: #eef5ff;
		border-bottom: 1px solid #d9e6f4;
	}

	.section-toggle {
		width: 30px;
		height: 30px;
		border: 1px solid #cbd5e1;
		border-radius: 8px;
		background: #ffffff;
		color: #1e3a8a;
		font-size: 12px;
		line-height: 1;
		cursor: pointer;
		display: inline-flex;
		align-items: center;
		justify-content: center;
	}

	.section-group.collapsed .section-toggle {
		transform: rotate(-90deg);
	}

	.section-class-name {
		font-size: 19px;
		font-weight: 700;
		color: #1f324b;
		margin: 0;
	}

	.section-table-head,
	.section-row {
		display: grid;
		grid-template-columns: minmax(160px, 1fr) 210px;
		align-items: center;
		gap: 12px;
		padding: 10px 14px;
	}

	.section-table-head {
		font-size: 13px;
		font-weight: 800;
		color: #19436f;
		text-transform: uppercase;
		letter-spacing: 0.4px;
		background: #f9fcff;
		border-bottom: 1px solid #e0e8f2;
	}

	.section-row {
		background: #ffffff;
		border-bottom: 1px solid #e8edf5;
	}

	.section-row:last-child {
		border-bottom: 0;
	}

	.section-code {
		font-size: 17px;
		color: #1f324b;
		overflow-wrap: anywhere;
	}

	.section-actions {
		display: flex;
		justify-content: flex-end;
		gap: 8px;
		flex-wrap: wrap;
	}

	.section-btn {
		border: 0;
		border-radius: 11px;
		padding: 8px 14px;
		font-size: 14px;
		font-weight: 700;
		color: #fff;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		min-width: 74px;
	}

	.section-btn-edit {
		background: linear-gradient(135deg, #1e3a8a, #1d4ed8);
	}

	.section-btn-delete {
		background: linear-gradient(135deg, #b91c1c, #dc2626);
	}

	.section-group.collapsed .section-body {
		display: none;
	}

	.section-empty {
		border: 1px dashed #cbd5e1;
		border-radius: 12px;
		background: #f8fafc;
		color: #64748b;
		font-weight: 600;
		padding: 16px;
		text-align: center;
	}

	.section-footer {
		margin-top: 14px;
	}

	.section-add-btn {
		border: 0;
		border-radius: 12px;
		padding: 11px 20px;
		background: linear-gradient(135deg, #102a48, #123b66);
		color: #fff;
		font-weight: 700;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		box-shadow: 0 10px 20px rgba(16, 42, 72, 0.24);
	}

	@media (max-width: 768px) {
		.section-list-title {
			font-size: 26px;
		}

		.section-table-head {
			display: none;
		}

		.section-row {
			grid-template-columns: 1fr;
		}

		.section-actions {
			justify-content: flex-start;
		}
	}
</style>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter"></span>
						<p>
							
						</p>
					</div>

					<div id='content_left' class='content_left'></div>
                    
					<div id='content_right' class='content_right'>
						<div class="section-list-hero">
							<h3 class="section-list-title">Manage Sections</h3>
							<p class="section-list-subtitle">View sections class-wise and keep section records aligned.</p>
						</div>
						<div class="section-list-card">
							<?php for($j=0; $j< $classesCnt; $j++){ ?>
								<?php if( !empty( $sections[$j] ) ){ ?>
									<div class="section-group expanded">
										<div class="section-group-head">
											<button type="button" class="section-toggle" aria-expanded="true" title="Collapse">
												&#9660;
											</button>
											<p class="section-class-name"><?php echo htmlspecialchars((string)$classes[$j]['class_name'], ENT_QUOTES, 'UTF-8'); ?></p>
										</div>
										<div class="section-body">
											<div class="section-table-head">
												<div>Section</div>
												<div style="text-align:right;">Actions</div>
											</div>
											<?php $sectionsCnt = sizeof($sections[$j]); ?>
											<?php for( $k=0; $k<$sectionsCnt; $k++){ ?>
												<div class="section-row">
													<div class="section-code">
														<?php echo htmlspecialchars((string)$sections[$j][$k]['section_code'], ENT_QUOTES, 'UTF-8'); ?>
													</div>
													<div class="section-actions">
														<a class="section-btn section-btn-edit" href="edit_sections.php?section=<?php echo (int)$sections[$j][$k]['id']; ?>">
															Edit
														</a>
														<a class="section-btn section-btn-delete" href="delete_sections.php?section=<?php echo (int)$sections[$j][$k]['id']; ?>" onclick="return confirm('Do You Want To Continue To Delete');">
															Delete
														</a>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
							<?php } ?>

							<?php
								$hasSections = false;
								for($x=0; $x<$classesCnt; $x++){
									if (!empty($sections[$x])) {
										$hasSections = true;
										break;
									}
								}
								if (!$hasSections) {
									echo '<div class="section-empty">No sections found.</div>';
								}
							?>

							<div class="section-footer">
								<a class="section-add-btn" href="add_section.php">
									<i class="bi bi-plus-circle"></i>
									Add Section
								</a>
							</div>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				<?php 
					include_once('../layout/sidebar.php');
				?>
				<br class="clearfix" />
			</div>
		</div>

<?php 
	include_once('../layout/footer.php');
?>

<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function () {
		var toggles = document.querySelectorAll('.section-toggle');
		toggles.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var group = btn.closest('.section-group');
				if (!group) return;
				var isCollapsed = group.classList.toggle('collapsed');
				group.classList.toggle('expanded', !isCollapsed);
				btn.setAttribute('aria-expanded', String(!isCollapsed));
				btn.title = isCollapsed ? 'Expand' : 'Collapse';
			});
		});
	});
</script>
