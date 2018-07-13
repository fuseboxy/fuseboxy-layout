<?php /*
<fusedoc>
	<io>
		<in>
			<array name="$menus">
				<structure name="+">
					<string name="name" />
					<string name="url" optional="yes" />
					<string name="navHeader" optional="yes" />
					<boolean name="newWindow" optional="yes" />
					<list name="divider" optional="yes" delim=",">
						<string name="before|after" />
					</list>
					<array name="menus" optional="yes" comments="same data structure as base" />
					<string name="className" optional="yes" />
					<boolean name="active" />
				</structure>
			</array>
			<number name="$level" optional="yes" default="1" />
		</in>
		<out />
	</io>
</fusedoc>
*/
if ( !function_exists('layoutHeaderNav') ) {
	function layoutHeaderNav($menus, $level=1) {
		foreach ( $menus as $m ) {
			// divider (before)
			if ( !empty($m['divider']) and stripos($m['divider'], 'before') !== false ) { ?><li class="divider"></i><?php }
			// header
			if ( !empty($m['navHeader']) ) { ?><li class="dropdown-header"><?php echo $m['navHeader']; ?></li><?php }
			// menu item
			$menuItemClass = '';
			if ( !empty($m['className']) ) $menuItemClass .= "{$m['className']} ";
			if ( !empty($m['active'])    ) $menuItemClass .= 'active ';
			if ( !empty($m['menus'])     ) $menuItemClass .= ( $level == 1 ) ? 'dropdown ' : 'dropdown-submenu ';
			?><li class="<?php echo $menuItemClass; ?>"><?php
				?><a
					href="<?php echo !empty($m['url']) ? $m['url'] : '#'; ?>"
					<?php if ( !empty($m['newWindow']) ) : ?>target="_blank"<?php endif; ?>
					<?php if ( !empty($m['menus']) and $level == 1 ) : ?>class="dropdown-toggle" data-toggle="dropdown"<?php endif; ?>
				><?php
					if ( !empty($m['name']) ) echo $m['name'];
					if ( !empty($m['menus']) and $level == 1 ) { ?> <i class="caret"></i><?php }
				?></a><?php
				// has submenu
				if ( !empty($m['menus']) ) { ?><ul class="dropdown-menu"><?php layoutHeaderNav($m['menus'], $level+1); ?></ul><?php }
			?></li><?php
			// divider (after)
			if ( !empty($m['divider']) and stripos($m['divider'], 'after') !== false ) { ?><li class="divider"></i><?php }
		} // foreach-menus
	} // function
} // if-function-exists