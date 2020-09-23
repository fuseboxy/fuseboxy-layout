<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$modalLayout">
				<string name="footer" optional="yes" />
			</structure>
			<number name="startTick" scope="$GLOBALS" optional="yes" comments="for execution time" />
		</in>
		<out />
	</io>
</fusedoc>
*/ ?>
<div class="modal-footer"><?php
	// default footer
	if ( !isset($modalLayout['footer']) ) :
		ob_start();
		// execution time
		if ( isset($GLOBALS['startTick']) ) :
			$et = round(microtime(true)*1000-$GLOBALS['startTick']);
			?><div class="small mr-auto"><small class="text-muted">Execution time: <?php echo $et; ?>ms</small></div><?php
		endif;
		// button
		?><button type="button" class="btn btn-light" data-dismiss="modal">Close</button><?php
		$modalLayout['footer'] = ob_get_clean();
	endif;
	// display
	echo $modalLayout['footer']
?></div>