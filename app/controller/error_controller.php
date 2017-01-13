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
// do nothing...
if ( empty($fusebox->error) ) {


// just show textual message (when ajax request)
} elseif ( F::ajaxRequest() ) {
	echo $fusebox->error;


// show error message with global layout (when normal request)
} else {
	$arguments['flash'] = array(
		'type' => ( $fusebox->error == 'page not found' ) ? 'warning' : 'danger',
		'message' => "<i class='fa fa-exclamation-circle'>&nbsp;</i> {$fusebox->error}",
	);
	if ( F::is('account.*,auth.*') ) {
		include F::config('appPath')."view/{$fusebox->controller}/layout.php";
	} else {
		include F::config('appPath').'view/global/layout.php';
	}
}