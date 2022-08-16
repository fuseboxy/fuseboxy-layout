Fuseboxy Layout (v2.x)
======================


## Prerequisites
Enable **output_buffering** of PHP settings:
* e.g. `output_buffering = 4096`


## Installation

### Composer Installation

1. (WIP)

### Manual Installation

1. Add following config into **app/config/fusebox_config.php** if not already exists:
	* `'baseUrl' => str_replace('//', '/', str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']).'/' ) )`

2. Copy files from the package into your application:
	* `app/view/global/*`
	* `css/main.css` *- optional*
	* `js/main.js` *- optional*
	* `test/test_fuseboxy_global_layout.php` *- optional (Only if you want to perform a unit test)*

3. Open and edit following variables at **app/view/global/layout.php**:
	* `$layout['metaTitle']`
	* `$layout['brand']`

4. Done.


-------------------------

## Global Layout

#### Configuration File

* {APP_PATH}/view/global/layout.php

#### Settings

```
<structure name="$layout">
	<string name="metaTitle" comments="showing at browser tab" />
	<string name="logo|brand" optional="yes" />
	<structure name="logo|brand" optional="yes">
		<string name="~breakpoint~" comments="empty is the default" />
	</structure>
</structure>
<structure name="nav|navRight" scope="$arguments">
	<string name="icon" optional="yes" />
	<string name="name" optional="yes" />
	<string name="url" optinonal="yes" />
	<boolean name="active" optional="yes" />
	<string name="remark" optinonal="yes" />
	<boolean name="disabled" optional="yes" />
	<boolean name="newWindow" optional="yes" />
	<!-- custom styling -->
	<string name="class" optional="yes" />
	<string name="linkClass" optional="yes" />
	<!-- custom attributes -->
	<structure name="attr" optional="yes">
		<string name="~attrName~" value="~attrValue~" />
	</structure>
	<structure name="linkAttr" optional="yes">
		<string name="~attrName~" value="~attrValue~" />
	</structure>
	<!-- utilities for dropdown -->
	<string name="navHeader" optional="yes" />
	<array name="divider" optional="yes">
		<string name="+" comments="before|after" />
	</array>
	<!-- sub menu (if any) -->
	<array name="menus" optional="yes" />
</structure>
```

#### Example

```
<?php
switch ( $fusebox->action ) :

	case 'index':
		ob_start();
		?><h1>Hello World</h1><?php
		$layout['content'] = ob_get_clean();
		include F::appPath('view/global/layout.php');
		break;

	...

endswitch;
```

-------------------------

## Tab Layout

#### Settings

```
<structure name="$tabLayout">
	<string name="style" comments="tabs|pills|~empty~" />
	<string name="position" comments="left|right|top|bottom" />
	<string name="orientation" comments="vertical|horizontal" />
	<boolean name="justify" optional="yes" default="false" comments="~true~|~false~|fill|center|end" />
	<string name="header" optional="yes" />
	<string name="headerClass" optional="yes" default="h4 mb-3" />
	<string name="footer" optional="yes" />
	<string name="footerClass" optional="yes" default="mt-3" />
	<array name="nav">
		<structure name="~tabNameOptional~">

			<string name="linkClass" optional="yes" />

			<structure name="attr" optional="yes">
				<string name="~attrName~" value="~attrValue~" />
			</structure>
			<structure name="linkAttr" optional="yes">
				<string name="~attrName~" value="~attrValue~" />
			</structure>
			<!-- button -->
			<array name="buttons" optional="yes" />
			<!-- dropdown -->
			<array name="menus" optional="yes" />
		</structure>
	</array>
</structure>
```

#### Example

```
<?php
$tabLayout = array(
	'style' => 'tab',
	'position' => left',
	'nav' => array(
		'Home' => array('url' => F::url('home'), 'icon' => 'fa fa-home', 'active' => F::is('home.*')),
		'User' => array('url' => F::url('user'), 'icon' => 'fa fa-user', 'active' => F::is('user.*')),
		'Settings' => array('url' => F::url('settings'), 'icon' => 'fa fa-cog', 'active' => F::is('settings.*')),
	),
);
ob_start();
// display tab layout
include F::appPath('view/tab/layout.php');
$layout['content'] = ob_get_clean();
// wrap by global layout
$layout['width'] = 'full';
include F::appPath('view/global/layout.php');
```


-------------------------

## Modal Layout

#### Settings

```
<structure name="$modalLayout">
	<string name="header" optional="yes" />
	<boolean name="headerClose" optional="yes" default="true" />
	<string name="title" optional="yes" />
	<structure name="title" optional="yes">
		<string name="text" />
		<string name="class" />
	</structure>
	<array name="nav">
		<structure name="~menuNameOptional~">
			<string name="name" />
			<string name="url" />
			<string name="icon" />
			<string name="remark" />
			<string name="class" />
			<string name="linkClass" />
			<boolean name="active" />
			<boolean name="newWindow" />
		</structure>
	</array>
	<string name="footer" optional="yes" />
</structure>
```

#### Example

```
<?php
switch ( $fusebox->action ) :

	...

	case 'edit':
		$arguments['data'] = ORM::get('foo', 100);
		// display form
		ob_start();
		include F::appPath('view/foo/edit.php');
		$layout['content'] = ob_get_clean();
		// custom footer
		ob_start();
		include F::appPath('view/foo/edit.button.php');
		$modalLayout['footer'] = ob_get_clean();
		// show as modal
		$modalLayout['title'] = 'Edit';
		include F::appPath('view/modal/layout.php');
		break;

	...

endswitch;
```


-------------------------

## Usage

After you have correctly installed the module, you could try your first example:

```
switch ( $fusebox->action ) :
	...

	case 'example':
		$layout['pageTitle'] = 'Hello World';
		ob_start();
		echo 'Global Layout Example';
		$layout['content'] = ob_get_clean();
		include 'app/view/global/layout.php';
		break;

	...
endswitch;
```


--

## Navigation


## Flash


## Top Flash


## Breadcrumb


## Pagination


## Tab Layout