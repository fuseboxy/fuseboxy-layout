<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<string name="width" comments="normal|full|narrow|(specific)" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
$contentClass = array('p-4');
$contentStyle = array();
if ( empty($layout['width']) or $layout['width'] == 'normal' ) {
	$contentClass[] = 'container';
} elseif ( $layout['width'] == 'full' ) {
	$contentClass[] = 'w-100';
} elseif ( $layout['width'] == 'narrow' ) {
	$contentClass[] = 'w-25';
} else {
	$contentStyle[] = "width: {$layout['width']};";	
}
?><div id="global-layout"><?php
	// header
	include 'layout.topflash.php';
	include 'layout.header.nav.php';
	include 'layout.header.php';
	// content
	?><div 
		id="content" 
		class="<?php echo implode(' ', $contentClass); ?>" 
		style="<?php echo implode(' ', $contentStyle); ?>"
	><?php
		include 'layout.flash.php';
		include 'layout.title.php';
		include 'layout.breadcrumb.php';
		if ( !empty($layout['content']) ) echo $layout['content'];
		include 'layout.pagination.php';
	?></div><?php
	// footer
	include 'layout.footer.php';
?></div>