<?php foreach ( ['sm','md','lg','xl','max'] as $size ) : ?>
	<div id="global-modal-<?php echo $size; ?>" class="modal fade" data-background="static" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-<?php echo $size; ?>">
			<div class="modal-content">
			</div>
		</div>
	</div>
<?php endforeach; ?>


<div id="global-modal-iframe" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-max">
		<div class="modal-content">
			<div class="modal-body" style="border-top-left-radius: 5px; border-top-right-radius: 5px; height: 750px; overflow: hidden; padding: 0;">
				<iframe name="global-modal-iframe" src="about:blank" style="border: none; height: 100%; width: 100%;"></iframe>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div id="global-modal-title-iframe" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-max">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">&nbsp;</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body" style="height: 700px; padding: 0;">
				<iframe name="global-modal-title-iframe" src="about:blank" style="border: none; height: 100%; width: 100%;"></iframe>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>