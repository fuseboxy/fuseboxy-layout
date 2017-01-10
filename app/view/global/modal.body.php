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
<div class="modal-body">
	<?php include 'layout.flash.php'; ?>
	<?php if ( isset($layout['modalBody']) ) echo $layout['modalBody']; ?>
</div>