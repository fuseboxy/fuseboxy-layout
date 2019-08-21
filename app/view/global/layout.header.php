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
*/
// function for menu rendering
require_once 'layout.header.nav.php';
?>
<header id="header" class="navbar navbar-expand-sm navbar-light bg-light">
	<!-- logo -->
	<?php if ( !empty($layout['brand']) ) : ?>
		<?php if ( isset($xfa['brand']) ) : ?>
			<a href="<?php echo F::url($xfa['brand']); ?>" class="navbar-brand"><?php echo $layout['brand']; ?></a>
		<?php else : ?>
			<span class="navbar-brand"><?php echo $layout['brand']; ?></span>
		<?php endif; ?>
	<?php endif; ?>
	<!-- menu -->
	<nav id="nav" class="navbar-collapse collapse">
		<?php if ( !empty($arguments['nav']) ) : ?>
			<ul class="navbar-nav"><?php layoutHeaderNav($arguments['nav']); ?></ul>
		<?php endif; ?>
		<?php if ( !empty($arguments['navRight']) ) : ?>
			<ul class="navbar-nav ml-auto"><?php layoutHeaderNav($arguments['navRight']); ?></ul>
			<style type="text/css">.ml-auto .dropdown-menu { left: auto !important; right: 0; }</style>
		<?php endif; ?>
	</nav>
	<!-- expand button -->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
</header>


