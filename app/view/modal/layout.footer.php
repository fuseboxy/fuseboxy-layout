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
		// execution time
		if ( isset($GLOBALS['startTick']) ) :
			$et = round(microtime(true)*1000-$GLOBALS['startTick']);
			?><div class="small mr-auto"><small class="text-muted">Execution time: <?php echo $et; ?>ms</small></div><?php
		endif;
		// button
		?><button type="button" class="btn btn-light btn-close" data-dismiss="modal">Close</button><?php
	// custom footer
	else :
		echo $modalLayout['footer'];
	endif;
?></div>