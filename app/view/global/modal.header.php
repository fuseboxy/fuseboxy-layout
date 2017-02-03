<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<string name="modalID" />
				<string name="modalTitleSize" optional="yes" />
				<string name="modalTitle" optional="yes" />
				<string name="modalHeader" optional="yes" />
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
*/
$layout['modalTitleSize'] = isset($layout['modalTitleSize']) ? $layout['modalTitleSize'] : 'h4';
?>
<!-- modal title & header text -->
<?php if ( isset($layout['modalTitle']) or isset($layout['modalHeader']) ) : ?>
	<div class="modal-header" <?php if ( isset($layout['modalNav']) ) : ?>style="border: none; margin-bottom: 0; padding-bottom: 0;"<?php endif; ?>>
		<!-- close button -->
		<button type="button" class="close" data-dismiss="modal">
			<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
		</button>
		<!-- title -->
		<?php if ( isset($layout['modalTitle']) ) : ?>
			<<?php echo $layout['modalTitleSize']; ?> class="modal-title"><?php echo $layout['modalTitle']; ?></<?php echo $layout['modalTitleSize']; ?>>
		<?php endif; ?>
		<!-- header -->
		<?php if ( isset($layout['modalHeader']) ) : ?>
			<?php if ( isset($layout['modalTitle']) ) echo '<br />'; ?>
			<div><?php echo $layout['modalHeader']; ?></div>
		<?php endif; ?>
	</div>
<?php endif; ?>


<!-- modal nav -->
<?php if ( isset($layout['modalNav']) ) : ?>
	<ul class="nav modal-header nav-tabs" style="margin-bottom: 0; padding-bottom: 0;">
		<!-- nav -->
		<?php foreach ( $layout['modalNav'] as $i => $m ) : ?>
			<li class="<?php if ( !empty($m['active']) ) echo 'active'; ?> <?php if ( isset($m['class']) ) echo $m['class']; ?>">
				<a
					<?php if ( isset($m['url']) ) : ?>href="<?php echo $m['url']; ?>"<?php endif; ?>
					data-target="#<?php echo $layout['modalID']; ?>"
					data-toggle="ajax-load"
					data-toggle-transition="none"
				><?php if ( isset($m['name']) ) echo $m['name']; ?></a></li>
		<?php endforeach; ?>
		<!-- close button for nav (when necessary) -->
		<?php if ( !isset($layout['modalTitle']) and !isset($layout['modalHeader']) ) : ?>
			<li class="close pull-right" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></li>
		<?php endif; ?>
	</ul>
<?php endif; ?>