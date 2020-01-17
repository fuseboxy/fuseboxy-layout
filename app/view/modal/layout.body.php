<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<string name="modalBody" optional="yes" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/ ?>
<div class="modal-body"><?php
	include F::config('appPath').'global/layout.flash.php';
	// avoid showing in other layout
	if ( isset($arguments['flash']) ) unset($arguments['flash']);
	// display content specified
	if ( isset($layout['modalBody']) ) echo $layout['modalBody'];
?></div>