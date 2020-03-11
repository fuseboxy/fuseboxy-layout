<?php /*
<fusedoc>
	<io>
		<in>
			<string name="topFlash" scope="$arguments|$_SESSION" />
			<structure name="topFlash" scope="$arguments|$_SESSION">
				<string name="icon" optional="yes" />
				<string name="type" optional="yes" default="primary text-white" comments="primary|secondary|success|info|warning|danger|light|dark" />
				<string name="title" optional="yes" />
				<string name="message" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
// cross-page
if ( isset($_SESSION['topFlash']) ) {
	$arguments['topFlash'] = $_SESSION['topFlash'];
	unset($_SESSION['topFlash']);
}
// default
if ( isset($arguments['topFlash']) ) {
	if ( !is_array($arguments['topFlash']) ) {
		$arguments['topFlash'] = array('message' => $arguments['topFlash']);
	}
	if ( empty($arguments['topFlash']['type']) ) {
		$arguments['topFlash']['type'] = 'primary text-white';
	}
}
?>
<?php if ( isset($arguments['topFlash']) ) : ?>
	<div id="top-flash" class="navbar-dark bg-<?php echo $arguments['topFlash']['type']; ?>">
		<div class="container py-2 text-center">
			<?php if ( !empty($arguments['topFlash']['icon']) ) : ?>
				<i class="<?php echo $arguments['topFlash']['icon']; ?>"></i>
			<?php endif; ?>
			<?php if ( !empty($arguments['topFlash']['title']) ) : ?>
				<strong><?php echo $arguments['topFlash']['title']; ?></strong>
			<?php endif; ?>
			<?php echo $arguments['topFlash']['message']; ?>
		</div>
	</div>
<?php endif; ?>