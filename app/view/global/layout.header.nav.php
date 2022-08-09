<?php /*
<fusedoc>
	<io>
		<in>
			<array name="$menus">
				<structure name="~menuNameOptional~">
					<!-- link -->
					<string name="name" optional="yes" />
					<string name="url" optional="yes" />
					<string name="icon" optional="yes" />
					<string name="remark" optional="yes" />
					<boolean name="active" optional="yes" />
					<boolean name="disabled" optional="yes" />
					<boolean name="newWindow" optional="yes" />
					<!-- custom styling -->
					<string name="icon" optional="yes" />
					<string name="class" optional="yes" />
					<string name="linkClass" optional="yes" />
					<!-- custom attributes -->
					<structure name="attr" optional="yes">
						<string name="~attrName~" value="~attrValue~" />
					</structure>
					<structure name="linkAttr" optional="yes">
						<string name="~attrName~" value="~attrValue~" />
					</structure>
					<!-- utilities for dropdown -->
					<string name="navHeader" optional="yes" />
					<array name="divider" optional="yes">
						<string name="+" comments="before|after" />
					</array>
					<!-- sub menu (if any) -->
					<array name="menus" optional="yes" />
				</structure>
			</array>
			<number name="$level" optional="yes" default="1" />
			<string name="$align" comments="left|right" default="left" />
		</in>
		<out />
	</io>
</fusedoc>
*/
if ( !function_exists('layoutHeaderNav') ) :
	function layoutHeaderNav($menus, $level=1, $align='left') {
		foreach ( $menus as $itemKey => $item ) :
			// display menu item (when necessary)
			if ( !empty($item) ) :
				// fix menu (when necessary)
				if ( is_string($item) ) $item = array('name' => $item);
				elseif ( !is_numeric($itemKey) and empty($item['name']) ) $item['name'] = $itemKey;
				// fix variable
				if ( empty($item['divider']) ) :
					$itemDivider = array();
				elseif ( $item['divider'] === true ) :
					$itemDivider = array('after');
				elseif ( is_string($item['divider']) ) :
					$itemDivider = array_filter( explode(',', str_replace('|', ',', $item['divider']) ) );
				endif;
				// divider (if any)
				if ( in_array('before', $itemDivider) ) :
					?><li class="dropdown-divider"></li><?php
				endif;
				// header (if any)
				if ( !empty($item['navHeader']) ) :
					?><li class="dropdown-header h6"><?php echo $item['navHeader']; ?></li><?php 
				endif;
				// prepare item url (when necessary)
				$item['url'] = $item['url'] ?? $item['linkAttr']['href'] ?? false;
				// prepare item class
				$itemClass = array();
				if ( $level == 1                             ) $itemClass[] = 'nav-item';
				if ( $level == 1 and !empty($item['active']) ) $itemClass[] = 'active';
				if ( !empty($item['menus'])                  ) $itemClass[] = ( $level == 1 ) ? 'dropdown' : 'dropdown-submenu';
				if ( !empty($item['disabled'])               ) $itemClass[] = 'disabled';
				if ( !empty($item['class'])                  ) $itemClass[] = $item['class'];
				if ( !empty($item['attr']['class'])          ) $itemClass[] = $item['attr']['class'];
				// prepare item attributes
				$itemAttr = $item['attr'] ?? array();
				if ( isset($itemAttr['class']) ) unset($itemAttr['class']);
				// display nav item
				?><li class="<?php echo implode(' ', $itemClass); ?>" <?php echo http_build_query($itemAttr, '', ' '); ?>><?php
					// prepare link class
					$linkClass = array();
					$linkClass[] =  ( $level == 1 ) ? 'nav-link' : 'dropdown-item';
					if ( !empty($item['active']) and $level > 1 ) $linkClass[] = 'active';
					if ( !empty($item['linkClass'])             ) $linkClass[] = $item['linkClass'];
					if ( !empty($item['linkAttr']['class'])     ) $linkClass[] = $item['linkAttr']['class'];
					// prepare link attributes
					$linkAttr = $item['linkAttr'] ?? array();
					if ( isset($linkAttr['href']) ) unset($linkAttr['href']);
					if ( isset($linkAttr['class']) ) unset($linkAttr['class']);
					if ( !empty($item['newWindow']) ) $linkAttr['target'] = '_blank';
					// wrap by link (when necessary)
					if ( !empty($item['url']) or !empty($item['menus']) ) :
						?><a 
							href="<?php echo $item['url']; ?>" 
							class="<?php echo implode(' ', $linkClass); ?>" 
							<?php echo http_build_query($linkAttr, '', ' '); ?>
							<?php if ( !empty($item['menus']) ) : ?>role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php endif; ?>
						><?php
					endif;
					// menu icon
					if ( !empty($item['icon']) ) :
						?><i class="<?php echo $item['icon']; ?>"></i> <?php
					endif;
					// menu name
					if ( !empty($item['name']) ) echo $item['name'];
					// menu remark
					if ( !empty($item['remark']) ) :
						?> <small class="text-muted">(<?php echo $item['remark']; ?>)</small><?php
					endif;
					// wrap by link (when necessary)
					if ( !empty($item['url']) or !empty($item['menus']) ) :
						?></a><?php
					endif;
					// has submenu
					if ( !empty($item['menus']) ) :
						?><ul class="dropdown-menu <?php if ( $align == 'right' ) echo 'dropdown-menu-right'; ?>"><?php
							layoutHeaderNav($item['menus'], $level+1, $align);
						?></ul><?php
					endif;
				?></li><?php
				// divider (if any)
				if ( in_array('after', $itemDivider) ) :
					?><li class="dropdown-divider"></li><?php
				endif;
			endif; // if-not-empty
		endforeach; // foreach-item
	} // function
endif; // if-function-exists