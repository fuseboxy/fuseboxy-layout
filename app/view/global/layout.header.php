<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="config" scope="$fusebox">
				<string name="defaultCommand" />
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
	// logo & brand
	?><a href="<?php echo F::url( F::config('defaultCommand') ); ?>" class="navbar-brand"><?php
		// logo
		if ( isset($layout['logo'])  and is_string($layout['logo'])  ) :
			$layout['logo']  = array($layout['logo']);
		endif;
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
			// display
			if ( !empty($logoPath) ) :
				?><img class="<?php echo implode(' ', $logoClass); ?>" src="<?php echo $logoPath; ?>" alt="" /><?php
			endif;
		endforeach;
		// brand
		if ( isset($layout['brand']) and is_string($layout['brand']) ) :
			$layout['brand'] = array($layout['brand']);
		endif;
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
	?></a><?php
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
			?><ul class="navbar-nav"><?php layoutHeaderNav($arguments['nav']); ?></ul><?php
		endif;
		if ( !empty($arguments['navRight']) ) :
			?><ul class="navbar-nav ml-auto"><?php layoutHeaderNav($arguments['navRight']); ?></ul><?php
			?><style type="text/css">.ml-auto .dropdown-menu { left: auto !important; right: 0; }</style><?php
		endif;
	?></nav><?php
?></header>