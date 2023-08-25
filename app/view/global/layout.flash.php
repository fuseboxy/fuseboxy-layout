<?php /*
<fusedoc>
	<io>
		<in>
			<string_or_structure name="flash" scope="$arguments|$_SESSION">
				<string name="type" optional="yes" default="primary" comments="primary|secondary|success|info|warning|danger|light|dark" />
				<string name="icon" optional="yes" />
				<string name="heading" optional="yes" />
				<string name="message" optional="yes" />
				<string name="remark" optional="yes" />
			</string_or_structure>
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
// display (when necessary)
if ( !empty($arguments['flash']) ) :
	?><div id="flash"><?php F::alert($arguments['flash']); ?></div><?php
endif;