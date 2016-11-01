<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<string name="title" optional="yes" />
				<string name="subTitle" optional="yes" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/ ?>
<?php if ( !empty($layout['title']) ) : ?>
	<h1 class="page-header">
		<?php echo $layout['title']; ?>
		<?php if ( !empty($layout['subTitle']) ) : ?>
			<small><?php echo $layout['subTitle']; ?></small>
		<?php endif; ?>
	</h1>
<?php endif; ?>