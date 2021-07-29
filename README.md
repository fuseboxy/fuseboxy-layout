Fuseboxy Layout (v2.x)
======================

Pre-built global layout with handy navigation, flash message, breadcrumb, etc.

This module is **OPTIONAL** to Fuseboxy framework.


--

## Third-party Components
The global layout module includes CDN of following JS and CSS libraries to provide a faster development environment:
* jQuery
* Bootstrap
* Font Awesome
* HTML Shiv
* Respond JS

Please be noted that the Fuseboxy framework core does **NOT** depend on any one of these.

Therefore, developer could feel free to keep/remove any of these at `app/view/global/layout.basic.php` whenever applicable.


--

## Configuration
Enable **output_buffering** of PHP settings:
* e.g. `output_buffering = 4096`


-- 

## Installation
Composer Installation
1. (WIP)

Manual Installation
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


--

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