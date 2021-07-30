<footer id="footer" class="border-top pt-4 pb-5">
	<div class="container-fluid small text-muted text-right"><?php
		// execution time (when necessary)
		if ( $et = F::et() ) :
			?><small class="float-left text-muted">Execution time: <?php echo $et; ?>ms</small><?php
		endif;
		// copyright
		?><span>Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved.</span><?php
	?></div>
</footer>