<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$tabLayout">
				<string name="style" comments="tabs|pills|~empty~" />
				<string name="position" comments="left|right|top|bottom" />
				<string name="orientation" comments="vertical|horizontal" />
				<number name="navWidth" value="1~12" comments="applicable to vertical nav only" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
// content class
$tabContentClass = 'tab-content ';
if ( $tabLayout['position'] != 'top' ) {
	$tabContentClass .= 'col-sm-'.(12-$tabLayout['navWidth']).' ';
}

// layout class
$tabLayoutClass = array('tab-layout');
if ( $tabLayout['orientation'] == 'vertical' ) $tabLayoutClass[] = 'row';

// nav class
$tabNavClass = array('tab-nav');
$tabNavClass[] = 'col-' . ( $tabLayout['orientation'] == 'vertical' ? $tabLayout['navWidth'] : 12 );

// content class
$tabContentClass = array('tab-content');
$tabContentClass[] = 'col-' . ( $tabLayout['orientation'] == 'vertical' ? (12-$tabLayout['navWidth']) : 12 );
if ( $tabLayout['position'] == 'right'  ) $tabContentClass[] = 'order-first';
if ( $tabLayout['position'] == 'top'    ) $tabContentClass[] = 'pt-3';
if ( $tabLayout['position'] == 'bottom' ) $tabContentClass[] = 'pb-3';


// display
?><div class="<?php echo implode(' ', $tabLayoutClass); ?>"><?php
	include F::appPath('view/global/layout.header.nav.php');
	if ( $tabLayout['position'] != 'bottom' ) :
		?><div class="<?php echo implode(' ', $tabNavClass); ?>"><?php
			include F::appPath('view/tab/layout.nav.php');
		?></div><?php
	endif;
	?><div class="<?php echo implode(' ', $tabContentClass); ?>"><?php
		?><div class="tab-pane active" role="tabpanel"><?php
			include F::appPath('view/global/layout.title.php');
			include F::appPath('view/global/layout.breadcrumb.php');
			include F::appPath('view/global/layout.flash.php');
			if ( !empty($layout['content']) ) echo $layout['content'];
			include F::appPath('view/global/layout.pagination.php');
		?></div><?php
	?></div><?php
	if ( $tabLayout['position'] == 'bottom' ) :
		?><div class="<?php echo implode(' ', $tabNavClass); ?>"><?php
			include F::appPath('view/tab/layout.nav.php');
		?></div><?php
	endif;
?></div>