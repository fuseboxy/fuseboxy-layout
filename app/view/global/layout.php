<?php /*
<fusedoc>
	<io>
		<in />
		<out>
			<structure name="$layout">
				<string name="content" />
			</structure>
		</out>
	</io>
</fusedoc>
*/
// title & nav
$customSettings  = F::appPath('view/global/layout.settings.php');
$defaultSettings = F::appPath('view/global/layout.settings.php-default');
include is_file($customSettings) ? $customSettings : $defaultSettings;


// display
ob_start();
include F::appPath('view/global/layout.body.php');
include F::appPath('view/global/layout.modal.php');
$layout['content'] = ob_get_clean();


// wrap by html
include F::appPath('view/global/layout.html.php');