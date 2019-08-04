<?php
// pill menu
$tabLayout = array(
	'style' => 'pill',
	'position' => 'top',
	'nav' => array(
		array('name' => 'Pill #1', 'url' => '#', 'active' => true),
		array('name' => 'Pill #2', 'url' => '#'),
		array('name' => 'Pill #3', 'url' => '#'),
	),
);
// academic-year : display
ob_start();
include dirname(dirname(dirname(dirname(__DIR__)))).'/app/view/global/tab.php';
$layout['content'] = ob_get_clean();


// tab menu
$tabLayout = array(
	'style' => 'tab',
	'position' => 'top',
	'header' => '<h3>Sub Layout</h3>',
	'navWidth' => 4,
	'nav' => array(
		array('name' => 'Normal Tab', 'url' => F::url('example'), 'active' => true),
		array('name' => 'Tab with Remark', 'remark' => '(12)'),
		array('name' => 'Tab with Button', 'button' => array(
			'Edit' => '#',
			'Delete' => '#',
		)),
		array('name' => 'Tab with Dropdown', 'menus' => array(
			array('name' => 'Menu #1'),
			array('name' => 'Menu #2'),
			array('name' => 'Menu #3'),
		)),
	),
);


// tab layout
ob_start();
include dirname(dirname(dirname(dirname(__DIR__)))).'/app/view/global/tab.php';
$layout['content'] = ob_get_clean();


// wrap by global layout
include F::config('appPath').'view/example/global_layout.php';

