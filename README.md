Fuseboxy Layout (v2.x)
======================


## Prerequisites

#### PHP Settings

* Enable __output_buffering__ at `php.ini` (e.g. `output_buffering = 4096`)


## Installation

#### Composer Installation

1. (work-in-progress)

#### Manual Installation

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
			<string name="name" optional="yes" />
			<string name="url" optional="yes" />
			<boolean name="active" optional="yes" />
			<boolean name="disabled" optional="yes" />
			<string name="icon" optional="yes" />
			<string name="remark" optinonal="yes" />
			<string name="class" optional="yes" />
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

// display tab layout
ob_start();
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


## Top Flash

#### Settings

```
<string name="topFlash" scope="$arguments|$_SESSION" />
<structure name="topFlash" scope="$arguments|$_SESSION">
	<string name="icon" optional="yes" />
	<string name="type" optional="yes" default="primary text-white" comments="primary|secondary|success|info|warning|danger|light|dark" />
	<string name="title" optional="yes" />
	<string name="message" />
</structure>
```

#### Example

```
<?php
switch ( $fusebox->action ) :

	...

	case 'foo':
		...
		$arguments['topFlash'] = array('type' => 'danger', 'message' => 'Very Important Message!!');
		include F::appPath('view/global/layout.php');
		break;

	...

endswitch;
```


-------------------------


## Title

#### Settings

```
<structure name="$layout">
	<structure name="title" optional="yes">
		<string name="tag" optional="yes" default="h1" />
		<string name="icon" optional="yes" />
		<string name="class" optional="yes" default="page-header border-bottom mb-4" />
		<string name="message" />
	</structure>
	<string name="title" optional="yes" />
</structure>
```

#### Example

```
<?php
switch ( $fusebox->action ) :

	case 'index':
		ob_start();
		include F::appPath('view/home/index.php');
		$layout['content'] = ob_get_clean();
		// title
		$layout['title'] = 'Home Page';
		// global layout
		include F::appPath('view/global/layout.php');
		break;

	...

endswitch;
```


-------------------------


## Flash

#### Settings

```
<string name="flash" scope="$arguments|$_SESSION" />
<structure name="flash" scope="$arguments|$_SESSION">
	<string name="type" optional="yes" default="primary" comments="primary|secondary|success|info|warning|danger|light|dark" />
	<string name="icon" optional="yes" />
	<string name="heading" optional="yes" />
	<string name="message" />
</structure>
```

#### Example

```
<?php
switch ( $fusebox->action ) :

	...

	case 'save':
		$bean = ORM::saveNew($bean, $arguments['data']);
		$arguments['flash'] = 'Record Saved';
		include F::appPath('view/global/layout.php');
		break;

	...

endswitch;
```


-------------------------


## Breadcrumb

#### Settings

```
<structure name="breadcrumb" scope="$arguments">
	<string name="~label~" value="~url~" />
</structure>
```

#### Example

```
<?php
switch ( $fusebox->action ) :

	...

	case 'view':
		$product = ORM::get('product', $arguments['productID']);
		// display
		ob_start();
		include F::appPath('view/product/view.php');
		$layout['content'] = ob_get_clean();
		// breadcrumb
		$arguments['breadcrumb'] = array($product->category, $product->title);
		// global layout
		include F::appPath('view/global/layout.php');
		break;

	...

endswitch;
```

