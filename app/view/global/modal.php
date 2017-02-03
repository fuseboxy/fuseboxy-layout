<?php /*
<fusedoc>
	<description>
		this is modal layout
	</description>
	<io>
		<in>
			<structure name="$layout">
				<string name="modalID" optional="yes" />
				<string name="modalTitle" optional="yes" />
				<string name="modalTitleSize" optional="yes" />
				<string name="modalHeader" optional="yes" />
				<array  name="modalNav" optional="yes" />
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
	include 'modal.header.php';
	include 'modal.body.php';
	include 'modal.footer.php';
?></div>