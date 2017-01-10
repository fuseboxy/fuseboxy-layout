<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<string name="modalTitle" optional="yes" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/ ?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
	</button>
	<h4 class="modal-title"><?php echo $layout['modalTitle']; ?></h4>
</div>