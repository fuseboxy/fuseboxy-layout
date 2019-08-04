<?php
// pill menu
$tabLayout = array(
	'style' => 'pill',
	'position' => 'left',
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
	'position' => 'left',
	'header' => '<h3>Sub Layout</h3>',
	'navWidth' => 4,
	'nav' => array(
		array('name' => 'Normal Tab', 'url' => '#', 'active' => true),
		array('name' => 'Tab with Remark', 'url' => '#', 'remark' => '(12)'),
		array('name' => 'Tab with Button', 'url' => '#', 'button' => array(
			'Edit' => '#',
			'Delete' => '#',
		)),
		array('name' => 'Tab with Menu', 'url' => '#', 'menus' => array(
			array('name' => 'Menu #1', 'url' => '#'),
			array('name' => 'Menu #2', 'url' => '#'),
			array('name' => 'Menu #3', 'url' => '#'),
		)),
	),
);


// tab layout
ob_start();
include dirname(dirname(dirname(dirname(__DIR__)))).'/app/view/global/tab.php';
$layout['content'] = ob_get_clean();


// wrap by global layout
include F::config('appPath').'view/example/global_layout.php';

