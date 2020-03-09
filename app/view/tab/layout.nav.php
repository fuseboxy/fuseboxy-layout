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
				<string name="footer" optional="yes" />
				<array name="nav">
					<structure name="+">
						<string name="name" />
						<string name="url" optinonal="yes" />
						<boolean name="active" optional="yes" />
						<boolean name="disabled" optional="yes" />
						<string name="remark" optinonal="yes" />
						<string name="class" optional="yes" />
						<string name="style" optional="yes" />
						<string name="linkClass" optional="yes" />
						<string name="linkStyle" optional="yes" />
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
require_once F::config('appPath').'view/global/layout.header.nav.php';

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
		?><li class="nav-header nav-item mb-3"><?php echo $tabLayout['header']; ?></li><?php
	endif;
	// nav items
	if ( !empty($tabLayout['nav']) ) :
		foreach ( $tabLayout['nav'] as $i => $tab ) :
			if ( !empty($tab) ) :
				// menu item
				$itemClass = array('nav-item');
				if ( !empty($tab['class']) ) $itemClass[] = $tab['class'];
				$itemClass[] = ( $tabLayout['orientation'] == 'vertical' ) ? 'mb-1' : 'mr-1';
				// display menu item
				?><li class="<?php echo implode(' ', $itemClass); ?>"><?php
					// buttons (for vertical orientation)
					if ( !empty($tab['buttons']) and $tabLayout['orientation'] == 'vertical' ) :
						?><div class="float-right"><?php include 'layout.nav.button.php'; ?></div><?php
					endif;
					// dropdown menu
					if ( !empty($tab['menus']) ) :
						?><ul class="dropdown-menu"><?php layoutHeaderNav($tab['menus'], 2); ?></ul><?php
					endif;
					// link styling
					$linkClass = array('nav-link');
					if ( !empty($tab['active']) ) $linkClass[] = 'active';
					if ( !empty($tab['disabled']) ) $linkClass[] = 'disabled';
					if ( !empty($tab['linkClass']) ) $linkClass[] = $tab['linkClass'];
					if ( !empty($tab['menus']) ) $linkClass[] = 'dropdown-toggle';
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
					><?php
						// tab name
						 ?><span><?php echo $tab['name']; ?></span><?php
						// tab remark
						if ( !empty($tab['remark']) ) :
							?><em
								class="small ml-1 <?php if ( $tabLayout['style'] == 'tabs' or empty($tab['active']) ) echo 'text-muted'; ?>"
							>(<?php echo $tab['remark']; ?>)</em><?php
						endif;
					?></a><!--/.nav-link--><?php
					// buttons (for horizontal orientation)
					if ( !empty($tab['buttons']) and $tabLayout['orientation'] == 'horizontal' ) :
						?><div class="d-inline-block"><?php include 'layout.nav.button.php'; ?></div><?php
					endif;
				?></li><!--/.nav-item--><?php
			endif; // if-tab
		endforeach; // foreach-nav
	endif; // if-has-nav
	// nav footer
	if ( !empty($tabLayout['footer']) ) :
		?><li class="nav-footer nav-item mt-3"><?php echo $tabLayout['footer']; ?></li><?php
	endif;
?></ul>