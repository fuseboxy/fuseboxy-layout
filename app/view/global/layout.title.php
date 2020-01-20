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
if ( !empty($layout['title']) ) :
	if ( is_string($layout['title']) ) $layout['title'] = array($layout['title']);
	?><h2 class="page-header border-bottom"><?php
		foreach ( $layout['title'] as $level => $title ) :
			// deeper the level smaller the title
			for ( $i=0; $i<$level; $i++ ) $title = "<small>{$title}</small>";
			// display this level of title
			echo "<span class='mr-3'>{$title}</span>";
		endforeach;
	?></h2><?php
endif;