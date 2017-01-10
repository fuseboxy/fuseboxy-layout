<?php /*
<fusedoc>
	<description>
		this is modal layout
	</description>
	<io>
		<in>
			<structure name="$layout">
				<string name="modalID" optional="yes" />
				<string name="modalTitle" optional="yes" comments="mutual exclusive to nav" />
				<array  name="modalNav" optional="yes" comments="mutual exclusive to title" />
				<string name="modalBody" optional="yes" />
				<string name="modalFooter" optional="yes" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
$layout['modalID'] = isset($layout['modalID']) ? $layout['modalID'] : ('modal-'.uniqid());
?>
<div id="<?php echo $layout['modalID']; ?>" class="modal-content"><?php
	if ( isset($layout['modalTitle']) ) include 'modal.title.php';
	if ( isset($layout['modalNav']) ) include 'modal.nav.php';
	include 'modal.body.php';
	include 'modal.footer.php';
	// avoid showing in other layout
	if ( isset($arguments['flash']) ) unset($arguments['flash']);
?></div>