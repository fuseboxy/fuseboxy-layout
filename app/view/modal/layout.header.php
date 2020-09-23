<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$modalLayout">
				<string name="header" optional="yes" />
				<string name="title" optional="yes" />
				<structure name="title" optional="yes">
					<string name="text" />
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
						<boolean name="newWindow" />
					</structure>
				</array>
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
// display (user-defined) modal header, or...
if ( !empty($modalLayout['header']) ) :
	?><div class="modal-header"><?php
		echo $modalLayout['header'];
		?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php
	?></div><?php


// display modal title, or...
elseif ( !empty($modalLayout['title']) ) :
	if ( is_string($modalLayout['title']) ) :
		$modalLayout['title'] = array( 'text' => $modalLayout['title'], 'class' => 'h5');
	endif;
	?><div class="modal-header"><?php
		?><div class="modal-title <?php echo $modalLayout['title']['class']; ?>"><?php echo $modalLayout['title']['title']; ?></div><?php
		?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php
	?></div><?php


// display modal nav
elseif ( !empty($modalLayout['nav']) ) :
	?><div class="modal-header pb-0"><?php
		?><ul class="nav nav-tabs border-bottom-0"><?php
			foreach ( $modalLayout['nav'] as $item ) :
				if ( !empty($item) ) :
					// nav item
					$itemClass = array('nav-item mr-1');
					if ( !empty($item['class']) ) $itemClass[] = $item['class'];
					// display item
					?><li class="<?php echo implode(' ', $itemClass); ?>"><?php
						// nav link
						$linkClass = array('nav-link');
						if ( !empty($item['active'])    ) $linkClass[] = 'active';
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