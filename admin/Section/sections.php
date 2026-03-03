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
			<div id="page">
				<div id="content">
					<div class="post">
						<span class="alignCenter">
							<h4>AIML Department </h4>
						</span>
						<p>
							
						</p>
					</div>

					<!-- <div id='content_left' class='content_left'>
						<?php 
							include_once('../layout/other_leftnav.php');
						?>						
					</div> -->
                    
					<div id='content_right' class='content_right'>
						<div class="comteeMem sections-list">
							<div class="committeeTitle">
								<div class='subjName'>
									Class Name
								</div>
								<div  class="subjMaterials">
									Section
								</div>
								
							</div>
							<?php
								
								for($j=0; $j< $classesCnt; $j++){
									
									if( !empty( $sections[$j] ) ){
							?>
									<div class="subjHeader class-group expanded">
										<div class='subjName class-toggle-wrap'>
											<button type="button" class="class-toggle" aria-expanded="true" title="Collapse">
												&#9660;
											</button>
										<?php 
											echo $classes[$j]['class_name'];
										?>
										</div>
										<div class='subjMaterials class-items'>
											<?php 
												$sectionsCnt	= sizeof($sections[$j]);
												
												for( $k=0;$k<$sectionsCnt;$k++){
													?>
														<div class="eventCandName">
															<?php
																echo $sections[$j][$k]['section_code'];
															?>
														</div>
														<div  class="eventCandName">
															<a href="edit_sections.php?section=<?php echo $sections[$j][$k]['id'];?>" >
																<input type="button" class="button" value="Edit" />
															</a>
															<a href="delete_sections.php?section=<?php echo $sections[$j][$k]['id'];?>" onclick="return confirm('Do You Want To Continue To Delete');">
																<input type="button" class="button" value="Delete"/>
															</a>
														</div>
													<?php
												}
											?>
										</div>
									</div>
									
									<br class="clearfix" />
							<?php 
									}
								} 
							?>
							
						</div>
						<div  class="eventCandName">
							<a href="add_section.php" >
								<input type="button" class="button" value="Add Section" />
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
	.sections-list .class-group {
		grid-template-columns: minmax(210px, 1fr) minmax(260px, 2fr);
	}

	.sections-list .class-toggle-wrap {
		display: flex;
		align-items: center;
		gap: 10px;
		font-weight: 700;
	}

	.sections-list .class-toggle {
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

	.sections-list .class-group.collapsed .class-items {
		display: none;
	}

	.sections-list .class-group.collapsed .class-toggle {
		transform: rotate(-90deg);
	}

	@media (max-width: 980px) {
		.sections-list .class-group {
			grid-template-columns: 1fr;
		}
	}
</style>

<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function () {
		var toggles = document.querySelectorAll('.sections-list .class-toggle');
		toggles.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var group = btn.closest('.class-group');
				if (!group) return;
				var isCollapsed = group.classList.toggle('collapsed');
				group.classList.toggle('expanded', !isCollapsed);
				btn.setAttribute('aria-expanded', String(!isCollapsed));
				btn.title = isCollapsed ? 'Expand' : 'Collapse';
			});
		});
	});
</script>
