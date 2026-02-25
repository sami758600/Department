<?php
	$currentUrl	= $_SERVER['REQUEST_URI'];

	$curUrl	= explode('/',$currentUrl);
	
	$urlLength	= sizeof($curUrl);

	$urlLength--;

	$curUrl	= explode('?',$curUrl[$urlLength]);
	
?>	
					
	<div id='lefNav1' <?php if( $curUrl[0] == 'wise.php' || $curUrl[0] == 'addwisemem.php' ) { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='assoc.php'>AIML Committee</a>
	</div>
	
	<div id='lefNav2' <?php if( $curUrl[0] == 'events.php' || $curUrl[0] == 'eventdetails.php' || $curUrl[0] == 'view_events.php' || $curUrl[0] == 'edit_event.php' ) { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='/department/admin/events/view_events.php'>Events</a>
	</div>
	
	<div id='lefNav3' <?php if( $curUrl[0] == 'slcandidates.php' || $curUrl[0] == 'eventslcandidates.php' || $curUrl[0] == 'eventregcand.php' ) { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='/department/admin/events/eventregcand.php'>Registered Candidates</a>
	</div>
	
	<div id='lefNav4' <?php if( $curUrl[0] == 'eventresults.php' || $curUrl[0] == 'eventresult.php' || $curUrl[0] == 'eventresannounce.php' ) { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='/department/admin/events/eventresults.php'>Event Results</a>
	</div>
