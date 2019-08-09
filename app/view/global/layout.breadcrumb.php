<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="breadcrumb" scope="$arguments">
				<string name="~label~" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/ ?>
<?php if ( isset($arguments['breadcrumb']) ) : ?>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo F::url(); ?>"><i class="fa fa-home"></i></a></li>
			<?php foreach ( $arguments['breadcrumb'] as $key => $val ) : ?>
				<?php if ( is_numeric($key) ) : ?>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $val; ?></li>
				<?php else : ?>
					<li class="breadcrumb-item"><a href="<?php echo $val; ?>"><?php echo $key; ?></a></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ol>
	</nav>
<?php endif; ?>