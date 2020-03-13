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
if ( is_file( F::appPath('view/global/layout.settings.php') ) {
	include F::appPath('view/global/layout.settings.php');
} else {
	include F::appPath('view/global/layout.settings.php.DEFAULT');
}


// display
ob_start();
include F::appPath('view/global/layout.body.php');
include F::appPath('view/global/layout.modal.php');
$layout['content'] = ob_get_clean();


// wrap by HTML & BODY
include F::appPath('view/global/layout.basic.php');