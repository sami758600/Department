<?php

###############################################################################
#
#	
#
#
###############################################################################

// Define for database
//database server
DEFINE('DB_SERVER', "localhost");

//database login name
//DEFINE('DB_USER', "nirulawi_wise");
//database login password
//DEFINE('DB_PASS', "DuwLA%h;r)TX");

//database name
//DEFINE('DB_DATABASE', "nirulawi_wise");

//DEFINE('BASE_PATH', "http://nirulawise.com");

//database login name
DEFINE('DB_USER', "root");
//database login password
// DEFINE('DB_PASS', "MyNewPass123!");
DEFINE('DB_PASS', "Sami@7586");
// DEFINE('DB_PASS', "rakesh2003");
// DEFINE('DB_PASS', "sai123");

//database name
DEFINE('DB_DATABASE', "anu");

DEFINE('BASE_PATH', "http://localhost/anu");


/*
*These are tables 
*/
DEFINE('TB_USERS','users');

DEFINE('TB_STAFF','staff');
DEFINE('TB_STAFF_CATEGORY','staff_category');

DEFINE('TB_BATCH','year_batch');
DEFINE('TB_STREAM','stream');
DEFINE('TB_CLASS','class');
DEFINE('TB_SECTION','section');
DEFINE('TB_SYLLABUS','syllabus');

DEFINE('TB_COMT_CATEG','committee_cat');
DEFINE('TB_COMMITTEE','committee');

DEFINE('TB_EVENT_TYPES','event_types');
DEFINE('TB_EVENTS','events');
DEFINE('TB_EVENT_REG','event_reg');
DEFINE('TB_EVENT_RESULT','event_results');

DEFINE('TB_SUBJECTS','subjects');
DEFINE('TB_MATERAILS','materials');
DEFINE('TB_PREV_PAPERS','prev_papers');

DEFINE('TB_ACHIEVEMENTS','achievements');

DEFINE('TB_PLACEMENTS','placements');

DEFINE('TB_ALUMNI','alumni');

DEFINE('TB_COMMENTS','comments');

DEFINE('TB_HIGHLIGHTS','highlights');

DEFINE('TB_GALLERY','gallery');

DEFINE('TEACHING',1);
DEFINE('NONTEACHING',2);

DEFINE('BRANCH','IT');

DEFINE('DOCUMENT',1);
DEFINE('NON_DOCUMENT',2);

DEFINE('anu',1);
DEFINE('DEPARTMENT',2);

DEFINE('HOD','hod');
DEFINE('PRINCIPAL','principal');
DEFINE('CHAIRMAN','chairman');

DEFINE('PASSOUT','0');

DEFINE('OTHERSTUD','5');

/*
 *  this tables is for admin
 */
DEFINE('ADMIN_TABLE','admin');


// define for Inifile

// Allow direct file download (hotlinking)?
// Empty - allow hotlinking
// If set to nonempty value (Example: example.com) will only allow downloads when referrer contains this text
define('ALLOWED_REFERRER', '');

?>
