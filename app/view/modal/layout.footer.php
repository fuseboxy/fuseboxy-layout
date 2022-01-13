<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$modalLayout">
				<string name="footer" optional="yes" />
			</structure>
			<number name="startTick" scope="$GLOBALS" optional="yes" comments="for execution time" />
		</in>
		<out />
	</io>
</fusedoc>
*/
// display default footer (when not specified)
if ( !isset($modalLayout['footer']) ) :
	?><footer class="modal-footer"><?php
		// execution time (if any)
		if ( $et = F::et() ) :
			?><div class="small mr-auto"><small class="text-muted">Execution time: <?php echo $et; ?>ms</small></div><?php
		endif;
		// close button
		?><button type="button" class="btn btn-light b-1 btn-close" data-dismiss="modal">Close</button><?php
	?></footer><?php

// display custom footer (when non-empty specified)
elseif ( !empty($modalLayout['footer']) ) :
	?><footer class="modal-footer"><?php
		// extract footer content if already wrapped by [modal-footer] element
		$footer = class_exists('Util') ? Util::phpQuery($modalLayout['footer']) : $modalLayout['footer'];
		echo ( is_object($footer) and $footer->find('> .modal-footer')->length ) ? $footer->find('> .modal-footer')->length : $footer;
	?></footer><?php

endif;