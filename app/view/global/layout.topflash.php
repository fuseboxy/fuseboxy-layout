<?php /*
<fusedoc>
	<io>
		<in>
			<string name="topFlash" scope="$arguments|$_SESSION" />
			<structure name="topFlash" scope="$arguments|$_SESSION">
				<string name="icon" optional="yes" />
				<string name="type" optional="yes" default="primary text-white" comments="primary|secondary|success|info|warning|danger|light|dark" />
				<string name="title|heading" optional="yes" />
				<string name="message" optional="yes" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
// cross-page
if ( isset($_SESSION['topFlash']) ) :
	$arguments['topFlash'] = $_SESSION['topFlash'];
	unset($_SESSION['topFlash']);
endif;
// default
if ( !empty($arguments['topFlash']) ) :
	if ( !is_array($arguments['topFlash']) ) $arguments['topFlash'] = array('message' => $arguments['topFlash']);
	if ( empty($arguments['topFlash']['type']) ) $arguments['topFlash']['type'] = 'primary text-white';
endif;
// display (when necessary)
if ( !empty($arguments['topFlash']) ) :
	?><div id="top-flash" class="navbar-dark bg-<?php echo $arguments['topFlash']['type']; ?>">
		<div class="container py-2 text-center"><?php
			// icon
			if ( !empty($arguments['topFlash']['icon']) ) :
				?><i class="<?php echo $arguments['topFlash']['icon']; ?>"></i> <?php
			endif;
			// heading
			if ( !empty($arguments['topFlash']['title']) or !empty($arguments['topFlash']['heading']) ) :
				?><strong><?php echo $arguments['topFlash']['title'] ?? $arguments['topFlash']['heading']; ?></strong> <?php
			endif;
			// message
			if ( !empty($arguments['topFlash']['message']) ) :
				?><span><?php echo $arguments['topFlash']['message']; ?></span> <?php
			endif;
		?></div>
	</div><?php
endif;