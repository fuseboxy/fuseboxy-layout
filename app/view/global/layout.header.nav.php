<?php /*
<fusedoc>
	<io>
		<in>
			<array name="$menus">
				<structure name="$item">
					<string name="name" />
					<string name="remark" optinonal="yes" />
					<string name="url" optinonal="yes" />
					<boolean name="active" optional="yes" />
					<boolean name="disabled" optional="yes" />
					<boolean name="newWindow" optional="yes" />
					<!-- custom styling -->
					<string name="class" optional="yes" />
					<string name="style" optional="yes" />
					<string name="linkClass" optional="yes" />
					<string name="linkStyle" optional="yes" />
					<!-- utilities for dropdown -->
					<string name="navHeader" optional="yes" />
					<array name="divider">
						<string name="+" comments="before|after" />
					</array>
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
		foreach ( $menus as $item ) {
			// fix variables
			if ( empty($item['divider']) ) {
				$item['divider'] = array();
			} elseif ( $item['divider'] === true ) {
				$item['divider'] = array('after');
			} elseif ( is_string($item['divider']) ) {
				$item['divider'] = array($item['divider']);
			}
			// header
			if ( !empty($item['navHeader']) ) :
				?><li class="dropdown-header h6"><?php echo $item['navHeader']; ?></li><?php 
			endif;
			// nav item
			$itemClass = array();
			if ( $level == 1               ) $itemClass[] = 'nav-item';
			if ( !empty($item['active'])   ) $itemClass[] = 'active';
			if ( !empty($item['disabled']) ) $itemClass[] = 'disabled';
			if ( !empty($item['menus'])    ) $itemClass[] = 'dropdown';
			if ( !empty($item['class'])    ) $itemClass[] = $item['class'];
			// divider (before)
			if ( in_array('before', $item['divider']) ) :
				?><li class="dropdown-divider"></li><?php
			endif;
			// display nav item
			?><li 
				class="<?php echo implode(' ', $itemClass); ?>"
				<?php if ( !empty($item['style']) ) : ?>style="<?php echo $item['style']; ?>" <?php endif; ?>
			><?php
				// nav link
				$linkClass = array();
				$linkClass[] =  ( $level == 1 ) ? 'nav-link' : 'dropdown-item';
				if ( !empty($item['menus']) ) $linkClass[] = 'dropdown-toggle';
				// default link
				$item['url'] = isset($item['url']) ? $item['url'] : '#';
				// display nav link
				?><a 
					href="<?php echo $item['url']; ?>" 
					class="<?php echo implode(' ', $linkClass); ?>" 
					<?php if ( !empty($item['linkStyle']) ) : ?>style="<?php echo $item['linkStyle']; ?>"<?php endif; ?>
					<?php if ( !empty($item['newWindow']) ) : ?>target="_blank"<?php endif; ?>
					<?php if ( !empty($item['menus']) ) : ?>role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php endif; ?>
				><?php if ( !empty($item['name']) ) echo $item['name']; ?></a><?php
				// has submenu
				if ( !empty($item['menus']) ) :
					?><ul class="dropdown-menu"><?php layoutHeaderNav($item['menus'], $level+1); ?></ul><?php
				endif;
			?></li><?php
			// divider (after)
			if ( in_array('after', $item['divider']) ) :
				?><li class="dropdown-divider"></li><?php
			endif;
		} // foreach-item
	} // function
} // if-function-exists