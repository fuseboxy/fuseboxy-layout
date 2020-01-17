<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$tab">
				<array name="buttons" optional="yes">
					<structure name="+">
						<string name="name" />
						<string name="url" />
						<string name="class" optional="yes" />
					</structure>
				</array>
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
foreach ( $tab['buttons'] as $btn ) :
	// button styling
	$btnClass = array('btn', 'btn-sm');
	if ( empty($btn['class']) ) $btnClass[] = 'btn-light';
	$btnClass[] = 'py-0 px-1 ml-1';
	if ( $tabLayout['orientation'] == 'vertical' ) $btnClass[] = 'mb-n3';
	if ( !empty($btn['class']) ) $btnClass[] = $btn['class'];
	// display button
	?><a 
		href="<?php echo $btn['url']; ?>" 
		class="<?php echo implode(' ', $btnClass); ?>"
	><?php echo $btn['name']; ?></a><?php
endforeach;