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
	include F::appPath('view/global/layout.topflash.php');
	include F::appPath('view/global/layout.header.nav.php');
	include F::appPath('view/global/layout.header.php');
	// content
	?><main 
		id="content" 
		<?php if ( !empty($contentClass) ) : ?>class="<?php echo implode(' ', $contentClass); ?>"<?php endif; ?>
		<?php if ( !empty($contentStyle) ) : ?>style="<?php echo implode(' ', $contentStyle); ?>"<?php endif; ?>
	><?php
		include F::appPath('view/global/layout.flash.php');
		include F::appPath('view/global/layout.title.php');
		include F::appPath('view/global/layout.breadcrumb.php');
		if ( !empty($layout['content']) ) echo $layout['content'];
		include F::appPath('view/global/layout.pagination.php');
	?></main><?php
	// footer
	include F::appPath('view/global/layout.footer.php');
?></div>