<?php /*
<fusedoc>
	<io>
		<in>
			<array name="nav" scope="$arguments" optional="yes" />
			<array name="navRight" scope="$arguments" optional="yes" />
			<string name="topFlash" scope="$arguments" optional="yes" />
			<structure name="$layout">
				<string name="brand" optional="yes" />
			</structure>
			<structure name="$xfa">
				<string name="brand" optional="yes" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/ ?>
<header id="header" class="navbar navbar-expand-sm navbar-light bg-light">
	<!-- logo -->
	<?php if ( !empty($layout['brand']) ) : ?>
		<?php if ( isset($xfa['brand']) ) : ?>
			<a href="<?php echo F::url($xfa['brand']); ?>" class="navbar-brand"><?php echo $layout['brand']; ?></a>
		<?php else : ?>
			<span class="navbar-brand"><?php echo $layout['brand']; ?></span>
		<?php endif; ?>
	<?php endif; ?>
	<!-- expand button -->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- menu -->
	<nav id="nav" class="navbar-collapse collapse">
		<!-- left menu -->
		<?php if ( !empty($arguments['nav']) ) : ?>
			<div class="navbar-nav"><?php layoutHeaderNav($arguments['nav']); ?></ul>
		<?php endif; ?>
		<!-- right menu -->
		<?php if ( !empty($arguments['navRight']) ) : ?>
			<ul class="navbar-nav navbar-right" style="margin-right: 20px;"><?php layoutHeaderNav($arguments['navRight']); ?></ul>
		<?php endif; ?>
	</nav>
</header>