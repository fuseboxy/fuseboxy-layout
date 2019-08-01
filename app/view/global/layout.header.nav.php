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
					<array name="menus" optional="yes" comments="same data structure as base" />
					<boolean name="active" />
					<list name="divider" optional="yes" delim=",">
						<string name="before|after" />
					</list>
					<string name="className" optional="yes" />
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
			// header
			if ( !empty($m['navHeader']) ) :
				?><li class="dropdown-header h6"><?php echo $m['navHeader']; ?></li><?php 
			endif;
			// menu item
			$itemClass = array();
			if ( $level == 1 ) $itemClass[] = 'nav-item';
			if ( !empty($m['active'])    ) $itemClass[] = 'active';
			if ( !empty($m['menus'])     ) $itemClass[] = 'dropdown';
			if ( !empty($m['className']) ) $itemClass[] = $m['className'];
			?><li class="<?php echo implode(' ', $itemClass); ?>"><?php
				// divider (before)
				if ( isset($m['divider']) and stripos($m['divider'], 'before') !== false ) :
					?><li class="dropdown-divider"></li><?php
				endif;
				// menu link
				$linkClass = array();
				$linkClass[] =  ( $level == 1 ) ? 'nav-link' : 'dropdown-item';
				if ( !empty($m['menus']) ) $linkClass[] = 'dropdown-toggle';
				// default link
				$m['url'] = isset($m['url']) ? $m['url'] : '#';
				?><a
					href="<?php echo $m['url']; ?>"
					class="<?php echo implode(' ', $linkClass); ?>"
					<?php if ( !empty($m['menus']) ) : ?>
						role="button" 
						data-toggle="dropdown" 
						aria-haspopup="true" 
						aria-expanded="false" 
					<?php endif; ?>
					<?php if ( !empty($m['newWindow']) ) : ?>
						target="_blank"
					<?php endif; ?>
				><?php if ( !empty($m['name']) ) echo $m['name']; ?></a><?php
				// has submenu
				if ( !empty($m['menus']) ) :
					?><ul class="dropdown-menu"><?php layoutHeaderNav($m['menus'], $level+1); ?></ul><?php
				endif;
			?></li><?php
			// divider (after)
			if ( isset($m['divider']) and ( stripos($m['divider'], 'after') !== false or $m['divider'] === true ) ) :
				?><li class="dropdown-divider"></li><?php
			endif;
		} // foreach-menus
	} // function
} // if-function-exists