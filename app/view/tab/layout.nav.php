<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$tabLayout">
				<string name="style" comments="tabs|pills|~empty~" />
				<string name="position" comments="left|right|top|bottom" />
				<string name="orientation" comments="vertical|horizontal" />
				<boolean name="justify" optional="yes" default="false" comments="~true~|~false~|fill|center|end" />
				<string name="header" optional="yes" />
				<string name="headerClass" optional="yes" default="h4 mb-3" />
				<string name="footer" optional="yes" />
				<string name="footerClass" optional="yes" default="mt-3" />
				<array name="nav">
					<structure name="~tabNameOptional~">
						<string name="name" optional="yes" />
						<string name="url" optional="yes" />
						<boolean name="active" optional="yes" />
						<boolean name="disabled" optional="yes" />
						<string name="icon" optional="yes" />
						<string name="remark" optinonal="yes" />
						<string name="class" optional="yes" />
						<string name="linkClass" optional="yes" />
						<structure name="attr" optional="yes">
							<string name="~attrName~" value="~attrValue~" />
						</structure>
						<structure name="linkAttr" optional="yes">
							<string name="~attrName~" value="~attrValue~" />
						</structure>
						<!-- button -->
						<array name="buttons" optional="yes" />
						<!-- dropdown -->
						<array name="menus" optional="yes" />
					</structure>
				</array>
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
// function for menu rendering
require_once F::appPath('view/global/layout.header.nav.php');

// class combination for nav
$tabNavClass = array('nav');
if ( !empty($tabLayout['style']) ) {
	$tabNavClass[] = "nav-{$tabLayout['style']}";
}
$tabNavClass[] = "nav-{$tabLayout['style']}--{$tabLayout['position']}";
$tabNavClass[] = "nav-{$tabLayout['style']}--{$tabLayout['orientation']}";
if ( $tabLayout['orientation'] == 'vertical' ) {
	$tabNavClass[] = 'flex-column';
}
if ( $tabLayout['justify'] === true ) {
	$tabNavClass[] = 'nav-justified';
} elseif ( in_array($tabLayout['justify'], array('center', 'end')) ) {
	$tabNavClass[] = 'justify-content-'.$tabLayout['justify'];
} elseif ( $tabLayout['justify'] == 'fill' ) {
	$tabNavClass[] = 'nav-fill';
}
?>
<ul class="<?php echo implode(' ', $tabNavClass); ?>" role="navigation"><?php
	// nav header
	if ( !empty($tabLayout['header']) ) :
		$headerClass = isset($tabLayout['headerClass']) ? $tabLayout['headerClass'] : 'h4 mb-3';
		?><li class="nav-header nav-item <?php echo $headerClass; ?>"><?php echo $tabLayout['header']; ?></li><?php
	endif;
	// nav items
	if ( !empty($tabLayout['nav']) ) :
		foreach ( $tabLayout['nav'] as $itemKey => $item ) :
			// display tab (when necessary)
			if ( !empty($item) ) :
				// fix tab (when necessary)
				if ( is_string($item) ) $item = array('name' => $item);
				elseif ( !is_numeric($itemKey) and empty($item['name']) ) $item['name'] = $itemKey;
				// prepare item class
				$itemClass = array('nav-item', 'position-relative');
				if ( !empty($item['class']) ) $itemClass[] = $item['class'];
				if ( !empty($item['attr']['class']) ) $itemClass[] = $item['attr']['class'];
				$itemClass[] = ( $tabLayout['orientation'] == 'vertical' ) ? 'mb-1' : 'mr-1';
				// prepare item attributes
				$itemAttr = $item['attr'] ?? array();
				$itemAttr['class'] = implode(' ', $itemClass);
				// display menu item
				?><li <?php foreach ( $itemAttr as $key => $val ) echo $key.'="'.$val.'" '; ?>><?php
					// buttons (for vertical orientation)
					if ( !empty($item['buttons']) and $tabLayout['orientation'] == 'vertical' ) :
						?><div class="position-absolute" style="right: .5rem; top: .5rem;"><?php
							$tabItem = $item;
							include F::appPath('view/tab/layout.nav.button.php');
						?></div><?php
					endif;
					// prepare link class
					$linkClass = array('nav-link');
					if ( !empty($item['active']) ) $linkClass[] = 'active';
					if ( !empty($item['disabled']) ) $linkClass[] = 'disabled';
					if ( !empty($item['linkClass']) ) $linkClass[] = $item['linkClass'];
					if ( !empty($item['linkAttr']['class']) ) $itemClass[] = $item['linkAttr']['class'];
					if ( !empty($item['buttons']) and $tabLayout['orientation'] == 'horizontal' ) $linkClass[] = 'd-inline-block';
					// prepare link attributes
					$linkAttr = $item['linkAttr'] ?? array();
					$linkAttr['class'] = implode(' ', $linkClass);
					if ( !empty($item['url']) ) $linkAttr['href'] = $item['url'];
					if ( !empty($item['newWindow']) ) $linkAttr['target'] = '_blank';
					if ( !empty($item['menus']) ) $linkAttr = array_merge($linkAttr, [
						'role'          => 'button',
						'data-toggle'   => 'dropdown',
						'aria-haspopup' => 'true',
						'aria-expanded' => 'false',
					]);
					// wrap by link (when necessary)
					if ( !empty($item['url']) ) :
						?><a <?php foreach ( $linkAttr as $key => $val ) echo $key.'="'.$val.'" '; ?>><?php
					endif;
					// tab icon
					if ( !empty($item['icon']) ) :
						?><i class="<?php echo $item['icon']; ?>"></i> <?php
					endif;
					// tab name
					if ( !empty($item['name']) ) echo $item['name'];
					// tab remark
					if ( !empty($item['remark']) ) :
						$tabRemarkClass = array('ml-1');
						if ( $tabLayout['style'] == 'tabs' or empty($item['active']) ) $tabRemarkClass[] = 'text-muted';
						?> <small class="<?php echo implode(' ', $tabRemarkClass); ?>">(<?php echo $item['remark']; ?>)</small><?php
					endif;
					// wrap by link (when necessary)
					if ( !empty($item['url']) ) :
						?></a><?php
					endif;
					// dropdown menu (if any)
					if ( !empty($item['menus']) ) :
						?><ul class="dropdown-menu"><?php layoutHeaderNav($item['menus'], 2); ?></ul><?php
					endif;
					// buttons (for horizontal orientation)
					if ( !empty($item['buttons']) and $tabLayout['orientation'] == 'horizontal' ) :
						?><div class="d-inline-block"><?php
							$tabItem = $item;
							include F::appPath('view/tab/layout.nav.button.php');
						?></div><?php
					endif;
				?></li><!--/.nav-item--><?php
			endif; // if-not-empty
		endforeach; // foreach-nav
	endif; // if-has-nav
	// nav footer
	if ( !empty($tabLayout['footer']) ) :
		$footerClass = isset($tabLayout['footerClass']) ? $tabLayout['footerClass'] : 'mt-3';
		?><li class="nav-footer nav-item <?php echo $footerClass; ?>"><?php echo $tabLayout['footer']; ?></li><?php
	endif;
?></ul>