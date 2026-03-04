<?php
	$currentUrl	= $_SERVER['REQUEST_URI'];

	$curUrl	= explode('/',$currentUrl);
	
	$urlLength	= sizeof($curUrl);

	$urlLength--;

	$curUrl	= explode('?',$curUrl[$urlLength]);
	
?>	
					
	<div id='lefNav3' <?php if( $curUrl[0] == 'slcandidates.php' || $curUrl[0] == 'eventslcandidates.php' || $curUrl[0] == 'eventregcand.php' ) { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='/department/admin/events/eventregcand.php'>Registered Candidates</a>
	</div>
