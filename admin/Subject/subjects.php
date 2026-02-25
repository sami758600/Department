<?php require_once(__DIR__ . '/../../config.php');

   require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSubject	= TB_SUBJECTS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   for($i=0; $i<$classesCnt;$i++){
  		
		$classId		= $classes[$i]['id'];
		
		$subjects[$i]	= $fcObj->getSubjectsForClass($tbSubject,$classId);
	}
	
	include_once('../layout/main_header.php');
	include_once('../layout/core_forms_style.php');
?>
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>MBA Department </h4>
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'>
						<?php 
							include_once('../layout/other_leftnav.php');
						?>						
					</div>
					<div id='content_right' class='content_right'>
						<div class="comteeMem subjects-list">
							<div class="committeeTitle">Classes And Subjects</div>
							<?php
								
								for($j=0; $j< $classesCnt; $j++){
									$subjectsCnt = !empty($subjects[$j]) ? sizeof($subjects[$j]) : 0;
							?>
									<div class="class-block collapsed">
										<div class='class-header class-toggle-wrap'>
											<button type="button" class="class-toggle" aria-expanded="false" title="Expand">
												&#9660;
											</button>
											<span class="class-name"><?php echo $classes[$j]['class_name']; ?></span>
											<span class="class-count"><?php echo $subjectsCnt; ?> Subjects</span>
										</div>
										<div class='class-items class-body'>
											<div class="subject-table">
												<div class="subject-row subject-head">
													<div class="subject-col-code">Subject</div>
													<div class="subject-col-actions">Actions</div>
												</div>
											<?php
												if($subjectsCnt > 0){
												for( $k=0;$k<$subjectsCnt;$k++){
													?>
														<div class="subject-row">
															<div class="subject-col-code">
																<?php echo $subjects[$j][$k]['sub_code']; ?>
															</div>
															<div class="subject-col-actions">
																<a href="edit_subjects.php?subject=<?php echo $subjects[$j][$k]['id'];?>" >
																	<input type="button" class="button" value="Edit" />
																</a>
																<a href="delete_subjects.php?subject=<?php echo $subjects[$j][$k]['id'];?>" >
																	<input type="button" class="button delete-btn" value="Delete"/>
																</a>
															</div>
														</div>
													<?php
												}
												}else{
											?>
												<div class="subject-row">
													<div class="subject-col-code empty-row">No subjects added for this class.</div>
													<div class="subject-col-actions"></div>
												</div>
											<?php
												}
											?>
											</div>
										</div>
									</div>
									
									<br class="clearfix" />
							<?php 
								} 
							?>
							
						</div>
						<div  class="eventCandName">
							<a href="add_subject.php" >
								<input type="button" class="button" value="Add Subject" />
							</a>
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

<style type="text/css">
	.subjects-list .committeeTitle {
		display: block;
	}

	.subjects-list .class-block {
		border: 1px solid #dbe2ea;
		border-radius: 14px;
		background: #f8fafc;
		margin-bottom: 16px;
		overflow: hidden;
	}

	.subjects-list .class-toggle-wrap {
		display: flex;
		align-items: center;
		gap: 10px;
		font-weight: 700;
		padding: 14px 16px;
		background: #eef2ff;
		border-bottom: 1px solid #c7d2fe;
		cursor: pointer;
	}

	.subjects-list .class-name {
		font-size: 17px;
		color: #0f172a;
	}

	.subjects-list .class-count {
		margin-left: auto;
		font-size: 13px;
		font-weight: 600;
		color: #1e3a8a;
		background: #dbeafe;
		padding: 4px 10px;
		border-radius: 999px;
	}

	.subjects-list .class-toggle {
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

	.subjects-list .class-toggle-wrap:focus {
		outline: 2px solid #2563eb;
		outline-offset: 2px;
	}

	.subjects-list .class-body {
		padding: 12px 16px;
	}

	.subjects-list .subject-table {
		display: block;
	}

	.subjects-list .subject-row {
		display: grid;
		grid-template-columns: 1fr auto;
		gap: 12px;
		align-items: center;
		padding: 10px 0;
		border-bottom: 1px solid #e2e8f0;
	}

	.subjects-list .subject-row:last-child {
		border-bottom: 0;
	}

	.subjects-list .subject-head {
		padding-top: 0;
		font-weight: 700;
		color: #1e3a8a;
	}

	.subjects-list .subject-col-code {
		font-size: 15px;
		color: #1e293b;
	}

	.subjects-list .subject-col-actions {
		display: flex;
		gap: 8px;
	}

	.subjects-list .empty-row {
		color: #64748b;
		font-style: italic;
	}

	.subjects-list .class-block.collapsed .class-items {
		display: none;
	}

	.subjects-list .class-block.collapsed .class-toggle {
		transform: rotate(-90deg);
	}

	@media (max-width: 980px) {
		.subjects-list .class-count {
			display: none;
		}

		.subjects-list .subject-row {
			grid-template-columns: 1fr;
		}

		.subjects-list .subject-col-actions {
			justify-content: flex-start;
		}
	}
</style>

<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function () {
		var deleteButtons = document.querySelectorAll('.delete-btn');
		deleteButtons.forEach(function (btn) {
			btn.addEventListener('click', function (event) {
				var conf = confirm('Do You Want To Continue To Delete');
				if (!conf) {
					event.preventDefault();
				}
			});
		});

		var groups = document.querySelectorAll('.subjects-list .class-block');

		function toggleGroup(group) {
			if (!group) return;
			var btn = group.querySelector('.class-toggle');
			var isCollapsed = group.classList.toggle('collapsed');
			group.classList.toggle('expanded', !isCollapsed);
			if (btn) {
				btn.setAttribute('aria-expanded', String(!isCollapsed));
				btn.title = isCollapsed ? 'Expand' : 'Collapse';
			}
		}

		groups.forEach(function (group) {
			var header = group.querySelector('.class-toggle-wrap');
			var btn = group.querySelector('.class-toggle');

			if (!header || !btn) return;

			header.setAttribute('role', 'button');
			header.setAttribute('tabindex', '0');

			btn.addEventListener('click', function (event) {
				event.stopPropagation();
				toggleGroup(group);
			});

			header.addEventListener('click', function () {
				toggleGroup(group);
			});

			header.addEventListener('keydown', function (event) {
				if (event.key === 'Enter' || event.key === ' ') {
					event.preventDefault();
					toggleGroup(group);
				}
			});
		});
	});
</script>
