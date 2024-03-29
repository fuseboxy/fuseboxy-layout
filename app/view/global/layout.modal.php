<?php /*
<fusedoc>
	<description>
		create empty modals in different size
	</description>
	<io />
</fusedoc>
*/
foreach ( ['max','xxl','xl','lg','md','','sm','xs'] as $size ) :
	?><div id="global-modal<?php if ( !empty($size) ) echo '-'.$size; ?>" class="modal fade" data-backdrop="true" tabindex="-1" role="dialog" aria-hidden="true"><?php
		?><div class="modal-dialog modal-dialog-scrollable <?php if ( !empty($size) ) echo 'modal-'.$size; ?>"><?php
			?><div class="modal-content"></div><?php
		?></div><?php
	?></div><?php
endforeach;