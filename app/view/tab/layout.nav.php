<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$tabLayout">
				<string name="style" comments="tabs|pills|~empty~" />
				<string name="position" comments="left|right|top|bottom" />
				<string name="orientation" comments="vertical|horizontal" />
				<boolean name="justify" optional="yes" default="false" comments="true|false|fill|center|end" />
				<string name="header" optional="yes" />
				<string name="headerClass" optional="yes" default="h4" />
				<string name="footer" optional="yes" />
				<string name="footerClass" optional="yes" />
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
		?><li class="nav-header nav-item mb-3"><?php
			$headerClass = isset($tabLayout['headerClass']) ? $tabLayout['headerClass'] : 'h4';
			?><span <?php if ( !empty($headerClass) ) : ?>class="<?php echo $headerClass; ?>"<?php endif; ?>><?php
				echo $tabLayout['header'];
			?></span><?php
		?></li><?php
	endif;
	// nav items
	if ( !empty($tabLayout['nav']) ) :
		foreach ( $tabLayout['nav'] as $tabKey => $tab ) :
			// fix tab (when necessary)
			if ( is_string($tab) ) $tab = array('name' => $tab);
			elseif ( !is_numeric($tabKey) and empty($tab['name']) ) $tab['name'] = $tabKey;
			// display tab (when necessary)
			if ( !empty($tab) ) :
				// menu item
				$itemClass = array('nav-item');
				if ( !empty($tab['class']) ) $itemClass[] = $tab['class'];
				if ( !empty($tab['attr']['class']) ) $itemClass[] = $tab['attr']['class'];
				$itemClass[] = ( $tabLayout['orientation'] == 'vertical' ) ? 'mb-1' : 'mr-1';
				// display menu item
				?><li class="<?php echo implode(' ', $itemClass); ?>"><?php
					// buttons (for vertical orientation)
					if ( !empty($tab['buttons']) and $tabLayout['orientation'] == 'vertical' ) :
						?><div class="float-right"><?php
							include F::appPath('view/tab/layout.nav.button.php');
						?></div><?php
					endif;
					// dropdown menu
					if ( !empty($tab['menus']) ) :
						?><ul class="dropdown-menu"><?php layoutHeaderNav($tab['menus'], 2); ?></ul><?php
					endif;
					// display custom attribute
					if ( !empty($tab['attr']) ) foreach ( $tab['attr'] as $key => $val ) if ( $key != 'class' ) echo $key.'="'.$val.'" ';
					// link styling
					$linkClass = array('nav-link');
					if ( !empty($tab['active']) ) $linkClass[] = 'active';
					if ( !empty($tab['disabled']) ) $linkClass[] = 'disabled';
					if ( !empty($tab['linkClass']) ) $linkClass[] = $tab['linkClass'];
					if ( !empty($tab['linkAttr']['class']) ) $itemClass[] = $tab['linkAttr']['class'];
					if ( !empty($tab['buttons']) and $tabLayout['orientation'] == 'horizontal' ) $linkClass[] = 'd-inline-block';
					// display menu link
					?><a 
						class="<?php echo implode(' ', $linkClass); ?>"
						<?php if ( !empty($tab['url']) ) : ?>
							href="<?php echo $tab['url']; ?>"
						<?php endif; ?>
						<?php if ( !empty($tab['newWindow']) ) : ?>
							target="_blank"
						<?php endif; ?>
						<?php if ( !empty($tab['menus']) ) : ?>
							data-toggle="dropdown"
							role="button"
							aria-haspopup="true"
							aria-expanded="false"
						<?php endif; ?>
						<?php if ( !empty($tab['linkAttr']) ) foreach ( $tab['linkAttr'] as $key => $val ) if ( $key != 'class' ) echo $key.'="'.$val.'" '; ?>
					><?php
						// tab icon
						if ( !empty($tab['icon']) ) :
							?><i class="<?php echo $tab['icon']; ?>"></i><?php
						endif;
						// tab name
						$tabNameClass = array();
						if ( !empty($tab['icon']) ) $tabNameClass[] = 'ml-2';
						if ( !empty($tab['remark']) ) $tabNameClass[] = 'mr-2';
						 ?><span class="<?php echo implode(' ', $tabNameClass); ?>"><?php echo $tab['name']; ?></span><?php
						// tab remark
						if ( !empty($tab['remark']) ) :
							$tabRemarkClass = array();
							if ( $tabLayout['style'] == 'tabs' or empty($tab['active']) ) $tabRemarkClass[] = 'text-muted';
							?><small class="<?php echo implode(' ', $tabRemarkClass); ?>">(<?php echo $tab['remark']; ?>)</small><?php
						endif;
					?></a><!--/.nav-link--><?php
					// buttons (for horizontal orientation)
					if ( !empty($tab['buttons']) and $tabLayout['orientation'] == 'horizontal' ) :
						?><div class="d-inline-block"><?php
							include F::appPath('view/tab/layout.nav.button.php');
						?></div><?php
					endif;
				?></li><!--/.nav-item--><?php
			endif; // if-tab
		endforeach; // foreach-nav
	endif; // if-has-nav
	// nav footer
	if ( !empty($tabLayout['footer']) ) :
		?><li class="nav-footer nav-item mt-3"><?php
			$footerClass = isset($tabLayout['footerClass']) ? $tabLayout['footerClass'] : '';
			?><span <?php if ( !empty($footerClass) ) : ?>class="<?php echo $footerClass; ?>"<?php endif; ?>><?php
				echo $tabLayout['footer'];
			?></span><?php
		?></li><?php
	endif;
?></ul>