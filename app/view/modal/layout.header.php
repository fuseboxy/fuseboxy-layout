<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$modalLayout">
				<string name="header" optional="yes" />
				<boolean name="headerClose" optional="yes" default="true" />
				<string name="title" optional="yes" />
				<structure name="title" optional="yes">
					<string name="text" />
					<string name="class" />
				</structure>
				<array name="nav">
					<structure name="~menuNameOptional~">
						<string name="name" />
						<string name="url" />
						<string name="icon" />
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
// default for close button
$modalLayout['headerClose'] = $modalLayout['headerClose'] ?? true;


// display (user-defined) modal header, or...
if ( !empty($modalLayout['header']) ) :
	?><header class="modal-header"><?php
		echo $modalLayout['header'];
		if ( $modalLayout['headerClose'] ) :
			?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php
		endif;
	?></header><?php


// display modal title, or...
elseif ( !empty($modalLayout['title']) ) :
	// fix format
	if ( is_string($modalLayout['title']) ) $modalLayout['title'] = array('text' => $modalLayout['title'], 'class' => 'h5');
	?><header class="modal-header"><?php
		// title
		?><div class="modal-title <?php echo $modalLayout['title']['class']; ?>"><?php echo $modalLayout['title']['text']; ?></div><?php
		// close
		if ( $modalLayout['headerClose'] ) :
			?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php
		endif;
	?></header><?php


// display modal nav
elseif ( !empty($modalLayout['nav']) ) :
	?><header class="modal-header pb-0"><?php
		// tab menu
		?><ul class="nav nav-tabs border-bottom-0"><?php
			foreach ( $modalLayout['nav'] as $tabKey => $tab ) :
				// display menu item (when necessary)
				if ( !empty($tab) ) :
					// fix menu (when necessary)
					if ( is_string($tab) ) $tab = array('name' => $tab);
					elseif ( !is_numeric($tabKey) and empty($tab['name']) ) $tab['name'] = $tabKey;
					// nav item
					$tabClass = array('nav-item mr-1');
					if ( !empty($tab['class']) ) $tabClass[] = $tab['class'];
					// display item
					?><li class="<?php echo implode(' ', $tabClass); ?>"><?php
						// nav link
						$linkClass = array('nav-link');
						if ( !empty($tab['active'])    ) $linkClass[] = 'active';
						if ( !empty($tab['linkClass']) ) $linkClass[] = $tab['linkClass'];
						// display link
						?><a
							class="<?php echo implode(' ', $linkClass); ?>"
							<?php if ( !empty($tab['url']) ) : ?>
								href="<?php echo $tab['url']; ?>"
							<?php endif; ?>
							<?php if ( !empty($tab['url']) and !empty($tab['newWindow']) ) : ?>
								target="_blank"
							<?php elseif ( !empty($tab['url']) ) : ?>
								data-toggle="ajax-load"
								data-transition="none"
								data-target="[id^=global-modal].modal.show:last .modal-content:first"
							<?php endif; ?>
						><?php
							// icon
							if ( !empty($tab['icon']) ) :
								?><i class="<?php echo $tab['icon']; ?>"></i> <?php
							endif;
							// name
							if ( !empty($tab['name']) ) :
								$tabNameClass = array();
								?><span class="<?php echo implode(' ', $tabNameClass); ?>"><?php echo $tab['name']; ?></span><?php
							endif;
							// remark
							if ( !empty($tab['remark']) ) :
								?> <small class="text-muted">(<?php echo $tab['remark']; ?>)</small><?php
							endif;
						?></a><?php
					?></li><?php
				endif; // if-not-empty
			endforeach;
		?></ul><!--/.nav-tabs--><?php
		// close button
		if ( $modalLayout['headerClose'] ) :
			?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php
		endif;
	?></header><!--/.modal-header--><?php


endif;