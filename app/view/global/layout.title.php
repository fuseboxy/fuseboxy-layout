<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<structure name="title" optional="yes">
					<string name="tag" optional="yes" default="h1" />
					<string name="icon" optional="yes" />
					<string name="class" optional="yes" default="page-header border-bottom mb-4" />
					<string name="message" />
				</structure>
				<string name="title" optional="yes" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
if ( isset($layout['title']) and is_string($layout['title']) ) $layout['title'] = array('message' => $layout['title']);

// default
if ( !isset($layout['title']['tag']) ) $layout['title']['tag'] = 'h1';
if ( !isset($layout['title']['class']) ) $layout['title']['class'] = 'page-header border-bottom mb-4';

// display
if ( !empty($layout['title']['message']) ) :
	echo "<{$layout['title']['tag']} class='{$layout['title']['class']}'>";
	if ( !empty($layout['title']['icon']) ) echo "<i class='{$layout['title']['icon']}'></i>";
	echo $layout['title']['message'];
	echo "</{$layout['title']['tag']}>";
endif;