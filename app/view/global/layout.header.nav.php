<?php /*
<fusedoc>
	<io>
		<in>
			<array name="$menus">
				<structure name="~menuNameOptional~">
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
			// fix menu (when necessary)
			if ( is_string($item) ) $item = array('name' => $item);
			elseif ( !is_numeric($itemKey) and empty($item['name']) ) $item['name'] = $itemKey;
			// display menu item (when necessary)
			if ( !empty($item) ) :
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
				// nav item
				$itemClass = array();
				if ( $level == 1                             ) $itemClass[] = 'nav-item';
				if ( !empty($item['active']) and $level == 1 ) $itemClass[] = 'active';
				if ( !empty($item['menus'])                  ) $itemClass[] = ( $level == 1 ) ? 'dropdown' : 'dropdown-submenu';
				if ( !empty($item['disabled'])               ) $itemClass[] = 'disabled';
				if ( !empty($item['class'])                  ) $itemClass[] = $item['class'];
				if ( !empty($item['attr']['class'])          ) $itemClass[] = $item['attr']['class'];
				// display nav item (when necessary)
				if ( !empty($item['name']) or !empty($item['icon']) ) :
					?><li 
						class="<?php echo implode(' ', $itemClass); ?>"
						<?php if ( !empty($item['attr']) ) foreach ( $item['attr'] as $key => $val ) if ( $key != 'class' ) echo "{$key}='{$val}' "; ?>
					><?php
						// nav link
						$linkClass = array();
						$linkClass[] =  ( $level == 1 ) ? 'nav-link' : 'dropdown-item';
						if ( !empty($item['active']) and $level > 1 ) $linkClass[] = 'active';
						if ( !empty($item['linkClass'])             ) $linkClass[] = $item['linkClass'];
						if ( !empty($item['linkAttr']['class'])     ) $linkClass[] = $item['linkAttr']['class'];
						// default link
						$item['url'] = isset($item['url']) ? $item['url'] : '#';
						// display nav link
						?><a 
							href="<?php echo $item['url']; ?>" 
							class="<?php echo implode(' ', $linkClass); ?>" 
							<?php if ( !empty($item['newWindow']) ) : ?>target="_blank"<?php endif; ?>
							<?php if ( !empty($item['menus']) ) : ?>role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php endif; ?>
							<?php if ( !empty($item['linkAttr']) ) foreach ( $item['linkAttr'] as $key => $val ) if ( $key != 'class' ) echo "{$key}='{$val}' "; ?>
						><?php
							// menu icon
							if ( !empty($item['icon']) ) :
								?><i class="<?php echo $item['icon']; ?>"></i><?php
							endif;
							// menu name
							if ( !empty($item['name']) ) :
								$itemNameClass = array();
								if ( !empty($item['icon']) ) $itemNameClass[] = 'ml-1';
								if ( !empty($item['remark']) ) $itemNameClass[] = 'mr-1';
								 ?><span class="<?php echo implode(' ', $itemNameClass); ?>"><?php echo $item['name']; ?></span><?php
							endif;
							// menu remark
							if ( !empty($item['remark']) ) :
								?><small class="text-muted">(<?php echo $item['remark']; ?>)</small><?php
							endif;
						?></a><?php
						// has submenu
						if ( !empty($item['menus']) ) :
							?><ul class="dropdown-menu <?php if ( $align == 'right' ) echo 'dropdown-menu-right'; ?>"><?php
								layoutHeaderNav($item['menus'], $level+1, $align);
							?></ul><?php
						endif;
					?></li><?php
				endif; // if-item-name
				// divider (if any)
				if ( in_array('after', $itemDivider) ) :
					?><li class="dropdown-divider"></li><?php
				endif;
			endif; // if-item
		endforeach; // foreach-item
	} // function
endif; // if-function-exists