<?php require_once(__DIR__ . '/../../config.php');

   require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();
   
   $tbClass		= TB_CLASS;
   
   $tbSyllabus	= TB_SYLLABUS;
   
   $classes		= $fcObj->getClassesWOPO( $tbClass );
  
   $classesCnt	= sizeof($classes);
   
   for($i=0; $i<$classesCnt;$i++){
  		
		$classId		= $classes[$i]['id'];
		
		$syllabus[$i]	= $fcObj->getSyllabusForClass($tbSyllabus,$classId);
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
						<div class="comteeMem syllabus-list">
							<div class="committeeTitle">
								<div class='eventCandName'>
									Class Name
								</div>
								<div  class="eventCandName">
									Syllabus
								</div>
								
							</div>
							<?php
								
								for($j=0; $j< $classesCnt; $j++){
									
									if( !empty( $syllabus[$j] ) ){
							?>
									<div class="usersDetHeader class-group expanded">
										<div class='eventCandName class-toggle-wrap'>
											<button type="button" class="class-toggle" aria-expanded="true" title="Collapse">
												&#9660;
											</button>
										<?php 
											echo $classes[$j]['class_name'];
										?>
										</div>
										<div  class="eventCandName class-items">
											<a href="<?php echo BASE_URL; ?>/public/uploads/syllabus/<?php echo rawurlencode($syllabus[$j][0]['syllabus_name']); ?>" target="_blank">
												Download Syllabus
											</a>
										</div>
										<div  class="eventCandName class-items">
											<a href="edit_syllabus.php?syllabus=<?php echo $syllabus[$j][0]['id'];?>" >
												<input type="button" class="button" value="Edit" />
											</a>
											<a href="delete_syllabus.php?syllabus=<?php echo $syllabus[$j][0]['id'];?>" onclick="return confirm('Do You Want To Continue To Delete');">
												<input type="button" class="button" value="Delete"/>
											</a>
										</div>
									</div>
									
									<br class="clearfix" />
							<?php 
									}
								} 
							?>
							
						</div>
						<div  class="eventCandName">
							<a href="add_syllabus.php" >
								<input type="button" class="button" value="Add Syllabus" />
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
	.syllabus-list .class-toggle-wrap {
		display: flex;
		align-items: center;
		gap: 10px;
		font-weight: 700;
	}

	.syllabus-list .class-toggle {
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

	.syllabus-list .class-group.collapsed .class-items {
		display: none;
	}

	.syllabus-list .class-group.collapsed .class-toggle {
		transform: rotate(-90deg);
	}
</style>

<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function () {
		var toggles = document.querySelectorAll('.syllabus-list .class-toggle');
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
