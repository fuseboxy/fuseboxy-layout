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
	if ( isset($layout['modalFooter']) ) :
		echo $layout['modalFooter'];
	else :
		?><button type="button" class="btn btn-light" data-dismiss="modal">Close</button><?php
	endif;
?></div>