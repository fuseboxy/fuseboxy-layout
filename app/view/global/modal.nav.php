<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<string name="modalID" />
				<array name="modalNav" optional="yes" comments="mutual exclusive to title">
					<structure name="+">
						<string name="name" />
						<string name="url" optional="yes" />
						<boolean name="active" optional="yes" />
						<string name="class" optional="yes" />
					</structure>
				</array>
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/ ?>
<ul class="nav modal-header nav-tabs" style="margin-bottom: 0; padding-bottom: 0;">
	<?php foreach ( $layout['modalNav'] as $i => $m ) : ?>
		<li class="<?php if ( !empty($m['active']) ) echo 'active'; ?> <?php if ( isset($m['class']) ) echo $m['class']; ?>">
			<a
				<?php if ( isset($m['url']) ) : ?>href="<?php echo $m['url']; ?>"<?php endif; ?>
				data-target="#<?php echo $layout['modalID']; ?>"
				data-toggle="ajax-load"
				data-toggle-transition="none"
			><?php if ( isset($m['name']) ) echo $m['name']; ?></a></li>
	<?php endforeach; ?>
	<li class="close pull-right" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></li>
</ul>