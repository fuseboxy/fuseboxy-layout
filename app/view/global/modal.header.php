<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<string name="modalHeader" optional="yes" />
				<structure name="modalTitle" optional="yes">
					<string name="title" />
					<string name="class" optional="yes" default="h5" />
				</structure> 
				<array name="modalNav" optional="yes">
					<structure name="+">
						<string name="name" />
						<string name="url" optional="yes" />
						<boolean name="newWindow" optional="yes" />
						<string name="class" optional="yes" />
						<string name="linkClass" optional="yes" />
						<boolean name="active" optional="yes" />
					</structure>
				</array>
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
// fix parameter
if ( isset($layout['modalTitle']) and is_string($layout['modalTitle']) ) {
	$layout['modalTitle'] = array(
		'title' => $layout['modalTitle'],
		'class' => 'h5',
	);
}


// modal title
if ( !empty($layout['modalTitle']) ) :
	?><div class="modal-header"><?php
		?><div class="modal-title <?php echo $layout['modalTitle']['class']; ?>"><?php echo $layout['modalTitle']['title']; ?></div><?php
		?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php
	?></div><?php
endif;


// modal header
if ( !empty($layout['modalHeader']) ) :
	?><div class="modal-header"><?php
		echo $layout['modalHeader'];
		?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php
	?></div><?php
endif;


// modal nav
if ( !empty($layout['modalNav']) ) :
	?><div class="modal-header pb-0"><?php
		?><ul class="nav nav-tabs" style="margin-bottom: -1px;"><?php
			foreach ( $layout['modalNav'] as $item ) :
				// nav item
				$itemClass = array('nav-item mr-1');
				if ( !empty($item['class']) ) $itemClass[] = $item['class'];
				// display item
				?><li class="<?php echo implode(' ', $itemClass); ?>"><?php
					// nav link
					$linkClass = array('nav-link');
				if ( !empty($item['active']) ) $linkClass[] = 'active';
					if ( !empty($item['linkClass']) ) $linkClass[] = $item['linkClass'];
					// display link
					?><a
						class="<?php echo implode(' ', $linkClass); ?>"
						<?php if ( !empty($item['url']) ) : ?>
							href="<?php echo $item['url']; ?>"
						<?php endif; ?>
						<?php if ( !empty($item['url']) and !empty($item['newWindow']) ) : ?>
							target="_blank"
						<?php elseif ( !empty($item['url']) ) : ?>
							data-toggle="ajax-load"
							data-toggle-transition="none"
							data-target="[id^=global-modal].modal.show .modal-content"
						<?php endif; ?>
					><?php if ( isset($item['name']) ) echo $item['name']; ?></a><?php
				?></li><?php
			endforeach;
		?></ul><!--/.nav-tabs--><?php
		?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php
	?></div><!--/.modal-header--><?php
endif;
