<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$layout">
				<structure name="title" optional="yes">
					<string name="tag" optional="yes" default="h1" />
					<string name="icon" optional="yes" />
					<string name="class" optional="yes" default="page-header border-bottom mb-4" />
					<string name="message|text|title" optional="yes" />
					<string name="remark" optional="yes" />
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
if ( !isset($layout['title']['class']) ) $layout['title']['class'] = 'page-header mb-4';

// display (when anything in title)
if (
	!empty($layout['title']['icon']) or 
	!empty($layout['title']['message']) or
	!empty($layout['title']['text']) or
	!empty($layout['title']['title']) or
	!empty($layout['title']['remark'])
) :
	// open-tag & class
	?><<?php echo $layout['title']['tag']; ?> class="<?php echo $layout['title']['class']; ?>"><?php
		// icon
		if ( !empty($layout['title']['icon']) ) :
			?><i class="<?php echo $layout['title']['icon']; ?>"></i><?php
		endif;
		// message
		echo $layout['title']['message'] ?? $layout['title']['text'] ?? $layout['title']['title'] ?? '';
		// remark
		if ( !empty($layout['title']['remark']) ) :
			?><small class="ml-2 text-muted"><?php echo $layout['title']['remark']; ?></small><?php
		endif;
	// close-tag
	?></<?php echo $layout['title']['tag']; ?>><?php
endif;