<?php /*
<fusedoc>
	<description>
		this is tab sub-layout, which is supposed to be wrap by global-layout
	</description>
	<io>
		<in>
			<string name="content" scope="$layout" />
			<structure name="$tabLayout">
				<string name="style" comments="tabs|pills" default="tabs" />
				<string name="position" comments="left|right|top" default="left" />
				<boolean name="justify" optional="yes" default="false" comments="true|false|fill|center|end" />
				<string name="header" optional="yes" />
				<string name="headerClass" optional="yes" default="h4" />
				<string name="footer" optional="yes" />
				<string name="footerClass" optional="yes" />
				<array name="nav">
					<structure name="+">
						<string name="name" />
						<string name="remark" optinonal="yes" />
						<string name="url" optinonal="yes" />
						<boolean name="active" optional="yes" />
						<boolean name="disabled" optional="yes" />
						<!-- custom stylling -->
						<string name="class" optional="yes" />
						<string name="linkClass" optional="yes" />
						<!-- custom attributes -->
						<structure name="attr" optional="yes">
							<string name="~attrName~" value="~attrValue~" />
						</structure>
						<structure name="linkAttr" optional="yes">
							<string name="~attrName~" value="~attrValue~" />
						</structure>
						<!-- button -->
						<array name="buttons" optional="yes">
							<structure name="+">
								<string name="name" />
								<string name="url" />
								<string name="class" />
							</structure>
						</array>
						<!-- dropdown -->
						<array name="menus" optinonal="yes">
							<structure name="+">
								<string name="name" />
								<string name="url" />
								<string name="navHeader" />
								<string name="remark" />
								<string name="divider" comments="before|after" />
								<string name="className" />
							</structure>
						</array>
					</structure>
				</array>
				<number name="navWidth" optional="yes" default="2" comments="12-base grid layout" />
			</structure>
			<!-- show below elements in tab-layout, then unset them to avoid showing in global layout again -->
			<string_or_array name="title" scope="$layout" optional="yes" />
			<array name="breadcrumb" scope="$arguments" optional="yes" />
			<string name="flash" scope="$arguments" optional="yes" />
			<array name="pagination" scope="$arguments" optional="yes" />
		</in>
		<out>
			<structure name="$tabLayout">
				<string name="orientation" comments="vertical|horizontal" />
			</structure>
		</out>
	</io>
</fusedoc>
*/
// layout config default
$tabLayout = isset($tabLayout) ? $tabLayout : array();
$tabLayout['style'] = isset($tabLayout['style']) ? $tabLayout['style'] : 'tabs';
$tabLayout['position'] = isset($tabLayout['position']) ? $tabLayout['position'] : 'left';
$tabLayout['justify'] = isset($tabLayout['justify']) ? $tabLayout['justify'] : false;
$tabLayout['navWidth'] = isset($tabLayout['navWidth']) ? $tabLayout['navWidth'] : 2;
// adjust config
if ( in_array($tabLayout['style'], array('tab','pill')) ) $tabLayout['style'] .= 's';
$tabLayout['orientation'] = in_array($tabLayout['position'], array('left','right')) ? 'vertical' : 'horizontal';

// display
include F::appPath('view/tab/layout.body.php');

// clear layout items to avoid showing in global layout again
if ( isset($layout['title'])         ) unset($layout['title']);
if ( isset($arguments['breadcrumb']) ) unset($arguments['breadcrumb']);
if ( isset($arguments['flash'])      ) unset($arguments['flash']);
if ( isset($arguments['pagination']) ) unset($arguments['pagination']);


