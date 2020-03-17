<?php foreach ( ['sm','md','lg','xl','max'] as $size ) : ?>
	<div id="global-modal-<?php echo $size; ?>" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-<?php echo $size; ?>">
			<div class="modal-content">
			</div>
		</div>
	</div>
<?php endforeach; ?>