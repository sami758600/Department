<?php
	$currentUrl	= $_SERVER['REQUEST_URI'];

	$curUrl	= explode('/',$currentUrl);
	
	$urlLength	= sizeof($curUrl);

	$urlLength--;

	$curUrl	= explode('?',$curUrl[$urlLength]);
	
?>	
					
	<div id='lefNav1' <?php if( $curUrl[0] == 'assoc.php' ) { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='<?php echo BASE_URL; ?>/public/pages/department/assoc.php'>AIML Committee</a>
	</div>
	
	<div id='lefNav2' <?php if( $curUrl[0] == 'events.php' || $curUrl[0] == 'eventdetails.php' || $curUrl[0] == 'eventsregister.php' ) { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='<?php echo BASE_URL; ?>/public/pages/Events/events.php'>Events</a>
	</div>
	
	<div id='lefNav3' <?php if( $curUrl[0] == 'slcandidates.php' || $curUrl[0] == 'eventslcandidates.php' ) { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='<?php echo BASE_URL; ?>/public/pages/Academics/slcandidates.php'>Short Listed Candidates</a>
	</div>
	
	<div id='lefNav4' <?php if( $curUrl[0] == 'eventresults.php' || $curUrl[0] == 'eventresult.php' ) { ?> class='navigation_current' <?php }else{ ?> class='navigation' <?php } ?> >
		<a href='<?php echo BASE_URL; ?>/public/pages/Events/eventresults.php'>Event Results</a>
	</div>
