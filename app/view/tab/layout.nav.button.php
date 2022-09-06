<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$tabLayout">
				<string name="orientation" comments="horizontal|vertical" />
			</structure>
			<structure name="$tabItem" comments="tab">
				<array name="buttons" optional="yes">
					<string name="~buttonName~" value="~url~" optional="yes" />
					<structure name="~indexOrName~">
						<string name="name" optional="yes" />
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
foreach ( $tabItem['buttons'] as $btnKey => $btnItem ) :
	// button name
	// ===> default use [name] when specified
	// ===> then use [array-key] when not numeric
	// ===> then use [array-value] when key is numeric & value is string
	// ===> otherwise empty
	if ( !empty($btnItem['name']) ) $btnName = $btnItem['name'];
	elseif ( !is_numeric($btnKey) ) $btnName = $btnKey;
	elseif (  is_string($btnItem) ) $btnName = $btnItem;
	else $btnName = '';
	// button url
	// ===> default use [array-value] when both key & value are string
	// ===> then use [url] when specified
	// ===> otherwise empty
	if ( !is_numeric($btnKey) and is_string($btnItem) ) $btnUrl = $btnItem;
	else $btnUrl = $btnItem['url'] ?? '';
	// button styling
	// ===> default use [btn-light] when not specified
	$btnClass = array('btn btn-xs ml-1');
	if ( empty($btnItem['class']) ) $btnClass[] = 'btn-light b-1';
	// display button
	?><a 
		class="<?php echo implode(' ', $btnClass); ?>"
		<?php if ( !empty($btnUrl) ) : ?>href="<?php echo $btnUrl; ?>"<?php endif; ?>
	><?php echo $btnName; ?></a><?php
endforeach;