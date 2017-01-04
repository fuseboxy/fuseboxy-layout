<?php /*
<fusedoc>
	<io>
		<in>
			<string name="$fusebox->error" />
		</in>
		<out />
	</io>
</fusedoc>
*/

// just show textual message (when ajax request)
// ===> rely on javascript to style the message
if ( F::ajaxRequest() ) {
	echo $fusebox->error;

// show error message with global layout (when normal request)
} else {
	// define flash type
	if ( $fusebox->error == 'page not found' ) {
		$arguments['flash'] = array('type' => 'warning', 'message' => "<i class='fa fa-exclamation-circle'></i> <strong>".F::command()."</strong> - {$fusebox->error}");
	} else {
		$arguments['flash'] = array('type' => 'danger', 'message' => "<i class='fa fa-exclamation-circle'></i> <strong>".F::command()."</strong> - {$fusebox->error}");
	}
	// layout
	if ( F::is('auth.*') ) {
		include F::config('appPath').'view/auth/layout.php';
	} else {
		include F::config('appPath').'view/global/layout.php';
	}
}