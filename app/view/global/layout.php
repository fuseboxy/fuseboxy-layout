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
if ( file_exists(__DIR__.'/layout.settings.php') ) include 'layout.settings.php';


// display
ob_start();
include 'layout.body.php';
include 'layout.modal.php';
$layout['content'] = ob_get_clean();


// wrap by HTML & BODY
include 'layout.basic.php';