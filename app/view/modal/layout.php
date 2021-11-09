<?php /*
<fusedoc>
	<description>
		this is modal layout
	</description>
	<io>
		<in>
			<structure name="$modalLayout">
				<string name="elementID" optional="yes" />
				<string name="header" optional="yes" />
				<structure name="title" optional="yes">
					<string name="title" />
					<string name="class" />
				</structure>
				<array name="nav">
					<structure name="+">
						<string name="name" />
						<string name="url" />
						<string name="remark" />
						<string name="class" />
						<string name="linkClass" />
						<boolean name="active" />
						<boolean name="disabled" />
					</structure>
				</array>
				<string name="footer" optional="yes" />
			</structure>
			<string name="flash" scope="$arguments" />
			<string name="content" scope="$layout" />
		</in>
		<out />
	</io>
</fusedoc>
*/
$modalLayout['elementID'] = isset($modalLayout['elementID']) ? $modalLayout['elementID'] : ('modal-'.uniqid());
?><div id="<?php echo $modalLayout['elementID']; ?>" class="modal-content"><?php
	include F::appPath('view/modal/layout.header.php');
	include F::appPath('view/modal/layout.body.php');
	include F::appPath('view/modal/layout.footer.php');
?></div>