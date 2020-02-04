<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<string name="modalFooter" optional="yes" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/ ?>
<div class="modal-footer"><?php
	// user-defined footer (when necessary)
	if ( isset($layout['modalFooter']) ) :
		echo $layout['modalFooter'];
	// default footer
	else :
		// execution time
		if ( isset($GLOBALS['startTick']) ) :
			$et = round(microtime(true)*1000-$GLOBALS['startTick']);
			?><div class="small mr-auto"><small class="text-muted">Execution time: <?php echo $et; ?>ms</small></div><?php
		endif;
		// button
		?><button type="button" class="btn btn-light" data-dismiss="modal">Close</button><?php
	endif;
?></div>