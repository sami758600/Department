<?php
	$currentUrl	= $_SERVER['REQUEST_URI'];

	$curUrl	= explode('/',$currentUrl);
	
	$urlLength	= sizeof($curUrl);

	$urlLength--;

	$curUrl	= explode('?',$curUrl[$urlLength]);
	
?>	
					
	<div id='lefNav1' <?php if( $curUrl[0] == 'otheroperations.php' ) { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='/department/admin/settings/otheroperations.php'>Classes</a>
	</div>
	
	<div id='lefNav2' <?php if( $curUrl[0] == 'sections.php') { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='/department/admin/Section/sections.php'>Sections</a>
	</div>

	<div id='lefNav2' <?php if( $curUrl[0] == 'subjects.php') { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='/department/admin/Subject/subjects.php'>Subjects</a>
	</div>

	<div id='lefNav3' <?php if( $curUrl[0] == 'batch.php') { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='/department/admin/batches/batch.php'>Batch Or Year</a>
	</div>

	<div id='lefNav3' <?php if( $curUrl[0] == 'branch.php') { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='/department/admin/branch/branch.php'>Stream Or Branch</a>
	</div>
