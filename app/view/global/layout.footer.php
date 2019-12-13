<footer id="footer" class="pb-5">
	<hr />
	<div class="container-fluid small text-muted text-right"><?php
		// execution time (when necessary)
		if ( isset($GLOBALS['startTick']) ) :
			$et = round(microtime(true)*1000-$GLOBALS['startTick']);
			?><small class="float-left text-muted">Execution time: <?php echo $et; ?>ms</small><?php
		endif;
		// copyright
		?><span>Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved.</span><?php
	?></div>
</footer>