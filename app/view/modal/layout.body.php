<?php /*
<fusedoc>
	<io>
		<in>
			<string name="flash" scope="$arguments" />
			<string name="content" scope="$layout" />
		</in>
		<out />
	</io>
</fusedoc>
*/ ?>
<div class="modal-body"><?php
	include F::appPath('view/global/layout.flash.php');
	// avoid showing in other layout
	if ( isset($arguments['flash']) ) unset($arguments['flash']);
	// display content specified
	if ( isset($layout['modalBody']) ) echo $layout['modalBody'];
?></div>