<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<string name="title" optional="yes" />
				<array name="title" optioal="yes">
					<string name="+" />
				</array>
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
?>
<?php if ( !empty($layout['title']) ) : ?>
	<?php if ( is_string($layout['title']) ) $layout['title'] = array($layout['title']); ?>
	<h1 class="page-header"><?php
		foreach ( $layout['title'] as $level => $title ) :
			for ( $i=0; $i<$level; $i++ ) :
				$title = " <small>{$title}</small>";
			endfor;
			echo $title;
		endforeach;
	?></h1>
<?php endif; ?>