<?php 
	require_once(__DIR__ . '/../../../config.php');

    include_once(INCLUDES_PATH . '/header.php');
    require_once(LIB_PATH . '/functions.class.php');

   $fcObj	= new DataFunctions();

   $tbComtCtg = TB_COMT_CATEG;
   $tbComt	  = TB_COMMITTEE;
   
   $ComtCateg	= $fcObj->getComiteCatg($tbComtCtg);
   $categoryCnt		= sizeof($ComtCateg);
   
   $CmtMemDet	= array();
   
   for($i=0; $i<$categoryCnt;$i++){
  		
		$categoryId			= $ComtCateg[$i]['id'];
		
		$CmtMemDet[$i]	= $fcObj->getCmtMembers($tbComt,$categoryId);
	}

?>
<div class="box1">
        <div class="wrapper">
          <article class="col1">
				<div id="index_cont">
					<div class="post">
						<span class="alignCenter">
							<h4>AIML Association </h4>
						</span>
						<p>
							
						</p>
					</div>
					<div id='content_left' class='content_left'>
						<?php 
							include_once('leftnav.php');
						?>						
					</div>
					<div id='content_right' class='content_right'>
						<div class="comteeMem">
							<p class="mainContent">
								AIML: Matter About AIML..................................................................................
							</p>
						</div>
						<div class="comteeMem">
							<div class="comteeMemRow">
							<?php
								$membersCnt	= count( $CmtMemDet );

								for($i=0; $i< $membersCnt; $i++){
									if( !empty( $CmtMemDet[$i] )){
							?>
										<div class="comteeMemDetails">
											<div class="comiteMemName"><img src="<?php echo BASE_URL; ?>/public/assets/images/users/<?php echo rawurlencode((string)$CmtMemDet[$i][0]['image']);?>" alt="<?php echo $CmtMemDet[$i][0]['firstname'].' '.$CmtMemDet[$i][0]['lastname'];?>" title="<?php echo $CmtMemDet[$i][0]['firstname'].' '.$CmtMemDet[$i][0]['lastname'];?>" width="100px" height="100px" /></div>
											<div class="comiteMemName"><?php echo $CmtMemDet[$i][0]['firstname'].' '.$CmtMemDet[$i][0]['lastname'];?></div>
											<div class="comiteMemCls"><?php echo htmlspecialchars((string)$CmtMemDet[$i][0]['address']);?></div>
											<div class="comiteCategory"><?php echo $ComtCateg[$i]['category_name'];?></div>
											<br class="clearfix" />
										</div>
							<?php 
									}
								} 
							?>
							</div>
						</div>
					</div>
					<br class="clearfix" />
				</div>
				</article>
          <article class="col2 pad_left2">
				<?php 
					include_once('sidebar.php');
				?>
          </article>
        </div>
      </div>
    </section>
<?php include_once(INCLUDES_PATH . '/footer.php'); ?>

