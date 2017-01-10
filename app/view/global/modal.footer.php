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
<div class="modal-footer">
	<?php if ( isset($layout['modalFooter']) ) : ?>
		<?php echo $layout['modalFooter']; ?>
	<?php else : ?>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<?php endif; ?>
</div>