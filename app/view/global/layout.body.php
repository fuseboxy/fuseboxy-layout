<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<string name="width" comments="normal|full|container|w-100|.." default="container-fluid" />
			</structure>
			<array name="$contentClass" optional="yes" default="p-4" />
			<array name="$contentStyle" optional="yes" />
		</in>
		<out />
	</io>
</fusedoc>
*/
$contentClass = $contentClass ?? 'p-4';
$contentStyle = $contentStyle ?? '';
if ( is_string($contentClass) ) $contentClass = array($contentClass);
if ( is_string($contentStyle) ) $contentStyle = array($contentStyle);
// apply corresponding class for layout width
$layout['width'] = $layout['width'] ?? 'container';
if ( $layout['width'] == 'normal' ) $contentClass[] = 'container';
if ( $layout['width'] == 'full'   ) $contentClass[] = 'container-fluid';
// display
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