<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$tabLayout">
				<string name="style" comments="tabs|pills" />
				<string name="position" comments="left|right|top|bottom" />
				<string name="orientation" comments="vertical|horizontal" />
				<number name="navWidth" value="1~12" comments="applicable to vertical nav only" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
// class for tab-style
// ===> not standard bootstrap 3 class
// ===> please refer to {bootstrap.custom.css}
if ( $tabLayout['style'] == 'tabs' ) {
	$tabLayoutClass = "tabbable tabs-{$tabLayout['position']}";
} else {
	$tabLayoutClass = '';
}

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
//$tabNavClass[] = 'col-sm-12';

// content class
$tabContentClass = array('tab-content');
$tabContentClass[] = 'col-' . ( $tabLayout['orientation'] == 'vertical' ? (12-$tabLayout['navWidth']) : 12 );
if ( $tabLayout['position'] == 'right' ) $tabContentClass[] = 'order-first';
//$tabContentClass[] = 'col-sm-12';
?>


<div class="<?php echo implode(' ', $tabLayoutClass); ?>">
	<div class="<?php echo implode(' ', $tabNavClass); ?>"><?php
		include 'tab.nav.php';
	?></div>
	<div class="<?php echo implode(' ', $tabContentClass); ?>">
		<div class="tab-pane active" role="tabpanel"><?php
			include 'layout.title.php';
			include 'layout.breadcrumb.php';
			include 'layout.flash.php';
			if ( isset($layout['content']) ) echo "<div>{$layout['content']}</div>";
			include 'layout.pagination.php';
		?></div>
	</div>
</div>