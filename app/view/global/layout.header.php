<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="config" scope="$fusebox">
				<string name="defaultCommand" />
			</structure>
			<structure name="$xfa">
				<string name="brand" optional="yes" />
			</structure>
			<structure name="$layout">
				<string name="logo|brand" optional="yes" />
				<structure name="logo|brand" optional="yes">
					<string name="~breakpoint~" />
				</structure>
			</structure>
			<structure name="$arguments">
				<array name="nav" optional="yes" />
				<array name="navRight" optional="yes" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/ ?>
<header id="header" class="navbar navbar-expand-sm navbar-light bg-light"><?php
	// wrap by link (when necessary)
	if ( isset($xfa['brand']) and $xfa['brand'] === false ) :
		?><span class="navbar-brand"><?php
	else :
		?><a href="<?php echo F::url( isset($xfa['brand']) ? $xfa['brand'] : '' ); ?>" class="navbar-brand"><?php
	endif;
	// logo
	if ( !empty($layout['logo']) ) :
		if ( is_string($layout['logo']) ) $layout['logo'] = array($layout['logo']);
		foreach ( $layout['logo'] as $thisBreakpoints => $logoPath ) :
			// hide @ other breakpoints
			$otherBreakpoints = array_diff( array_keys($layout['logo']), array($thisBreakpoints) );
			$otherBreakpoints = explode(' ', implode(' ', $otherBreakpoints));
			// show @ this breakpoints
			$thisBreakpoints = explode(' ', $thisBreakpoints);
			// prepare class
			$logoClass = array();
			foreach ( $thisBreakpoints  as $breakpoint ) $logoClass[] = empty($breakpoint) ? 'd-inline-block' : "d-{$breakpoint}-inline-block";
			foreach ( $otherBreakpoints as $breakpoint ) $logoClass[] = empty($breakpoint) ? 'd-none' : "d-{$breakpoint}-none";
			if ( !empty($layout['brand']) ) $logoClass[] = 'mr-2';
			// display
			if ( !empty($logoPath) ) :
				?><img class="<?php echo implode(' ', $logoClass); ?>" src="<?php echo $logoPath; ?>" alt="" /><?php
			endif;
		endforeach;
	endif;
	// brand
	if ( !empty($layout['brand']) ) :
		if ( is_string($layout['brand']) ) $layout['brand'] = array($layout['brand']);
		foreach ( $layout['brand'] as $thisBreakpoints => $brandName ) :
			// hide @ other breakpoints
			$otherBreakpoints = array_diff( array_keys($layout['brand']), array($thisBreakpoints) );
			$otherBreakpoints = explode(' ', implode(' ', $otherBreakpoints));
			// show @ this breakpoints
			$thisBreakpoints = explode(' ', $thisBreakpoints);
			// prepare class
			$brandClass = array();
			foreach ( $thisBreakpoints  as $breakpoint ) $brandClass[] = empty($breakpoint) ? 'd-inline-block' : "d-{$breakpoint}-inline-block";
			foreach ( $otherBreakpoints as $breakpoint ) $brandClass[] = empty($breakpoint) ? 'd-none' : "d-{$breakpoint}-none";
			// display
			if ( !empty($brandName) ) :
				?><span class="<?php echo implode(' ', $brandClass); ?>"><?php echo $brandName; ?></span><?php
			endif;
		endforeach;
	endif;
	// wrap by link (when necessary)
	if ( isset($xfa['brand']) and $xfa['brand'] === false ) :
		?></span><!--/.navbar-brand--><?php
	else :
		?></a><!--/.navbar-brand--><?php
	endif;

	// hamburger button
	?><button 
		class="navbar-toggler" 
		type="button" 
		data-toggle="collapse" 
		data-target="#nav" 
		aria-controls="nav" 
		aria-expanded="false" 
		aria-label="Toggle navigation"
	><span class="navbar-toggler-icon"></span></button><?php
	// menu
	?><nav id="nav" class="navbar-collapse collapse"><?php
		if ( !empty($arguments['nav']) ) :
			?><ul class="navbar-nav left"><?php layoutHeaderNav($arguments['nav']); ?></ul><?php
		endif;
		if ( !empty($arguments['navRight']) ) :
			?><ul class="navbar-nav right ml-auto"><?php layoutHeaderNav($arguments['navRight'], 1, 'right'); ?></ul><?php
		endif;
	?></nav><?php
?></header>