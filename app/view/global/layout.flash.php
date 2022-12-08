<?php /*
<fusedoc>
	<io>
		<in>
			<string name="flash" scope="$arguments|$_SESSION" />
			<structure name="flash" scope="$arguments|$_SESSION">
				<string name="type" optional="yes" default="primary" comments="primary|secondary|success|info|warning|danger|light|dark" />
				<string name="icon" optional="yes" />
				<string name="heading" optional="yes" />
				<string name="message" optional="yes" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
// cross-page
if ( isset($_SESSION['flash']) ) :
	$arguments['flash'] = $_SESSION['flash'];
	unset($_SESSION['flash']);
endif;
// default
if ( !empty($arguments['flash']) ) :
	if ( !is_array($arguments['flash']) ) $arguments['flash'] = array('message' => $arguments['flash']);
	if ( empty($arguments['flash']['type']) ) $arguments['flash']['type'] = 'primary';
endif;
// display (when necessary)
if ( !empty($arguments['flash']) ) :
	?><div id="flash" class="alert alert-<?php echo $arguments['flash']['type']; ?>"><?php
		if ( !empty($arguments['flash']['icon']) ) :
			?><span class="mr-1"><i class="<?php echo $arguments['flash']['icon']; ?>"></i></span><?php
		endif;
		if ( !empty($arguments['flash']['heading']) ) :
			?><span class="mr-1"><strong><?php echo $arguments['flash']['heading']; ?></strong></span><?php
		endif;
		if ( !empty($arguments['flash']['message']) ) :
			?><span><?php echo $arguments['flash']['message']; ?></span><?php
		endif;
	?></div><?php
endif;