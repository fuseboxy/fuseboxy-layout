<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$modalLayout">
				<string name="header" optional="yes" />
				<structure name="title" optional="yes">
					<string name="title" />
					<string name="class" />
				</structure>
				<array name="nav">
					<structure name="+">
						<string name="name" />
						<string name="url" />
						<string name="remark" />
						<string name="class" />
						<string name="linkClass" />
						<boolean name="active" />
						<boolean name="disabled" />
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
		?><ul class="nav nav-tabs border-bottom-0"><?php
			foreach ( $layout['modalNav'] as $item ) :
				if ( !empty($item) ) :
					// nav item
					$itemClass = array('nav-item mr-1');
					if ( !empty($item['class']) ) $itemClass[] = $item['class'];
					// display item
					?><li class="<?php echo implode(' ', $itemClass); ?>"><?php
						// nav link
						$linkClass = array('nav-link');
						if ( !empty($item['active'])    ) $linkClass[] = 'active';
						if ( !empty($item['disabled'])  ) $linkClass[] = 'disabled';
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
						><?php
							// name
							if ( isset($item['name']) ) :
								?><span><?php echo $item['name']; ?></span><?php
							endif;
							// remark
							if ( !empty($item['remark']) ) :
								?><em class="ml-1 small text-muted">(<?php echo $item['remark']; ?>)</em><?php
							endif;
						?></a><?php
					?></li><?php
				endif;
			endforeach;
		?></ul><!--/.nav-tabs--><?php
		?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php
	?></div><!--/.modal-header--><?php
endif;
