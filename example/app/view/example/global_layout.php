<?php
$layout['metaTitle'] = '';  // html title
$layout['brand'] = 'Global Layout'; // brand name


// left menu
$arguments['nav'] = array(
	array('name' => 'Example', 'url' => F::url('example'), 'active' => true),
	array('name' => 'Single Level Dropdown', 'url' => '#', 'menus' => array(
		array('name' => 'Dropdown #1'),
		array('name' => 'Dropdown #2'),
		array('name' => 'Dropdown #3'),
	)),
	array('name' => 'Multiple Levels Dropdown', 'menus' => array(
		array('name' => 'Dropdown #1', 'navHeader' => 'Level #1', 'divider' => 'before', 'menus' => array(
			array('name' => 'Sub-Dropdown #1', 'navHeader' => 'Level #2'),
			array('name' => 'Sub-Dropdown #2'),
			array('name' => 'Sub-Dropdown #3'),
		)),
		array('name' => 'Dropdown #2'),
		array('name' => 'Dropdown #3'),
	)),
);


// right menu
$arguments['navRight'] = array(
	// settings
	array(
		'name' => '<i class="fa fa-cog"></i>',
		'menus' => array(
			array('navHeader' => '<strong>SETTINGS</strong>', 'divider' => 'after'),
			array('name' => 'User Management', 'url' => '#'),
		),
	),
	// user-sim
	array(
		'name' => '<i class="fa fa-eye-slash"></i>',
		'menus' => array(
			array('navHeader' => '<strong>USER SIMULATION</strong>', 'divider' => 'after'),
			array('name' => 'Staff #1', 'url' => '#'),
			array('name' => 'Staff #2', 'url' => '#'),
		),
	),
	// logout
	array(
		'name' => "<img src='//ssl.gstatic.com/accounts/ui/avatar_2x.png' class='img-rounded' style='height: 32px; width: 32px; margin: -10px 0;' />",
		'menus' => array(
			array('navHeader' => '<strong>{USERNAME}</strong>', 'divider' => 'after'),
			array('name' => 'Update Profile', 'url' => '#'),
			array('name' => 'Change Password', 'url' => '#'),
			array('name' => '<i class="fa fa-power-off"></i> Sign Out', 'url' => '#', 'divider' => 'before'),
		),
	),
);


// display altogether
// ===> include modal in different sizes for [toggle=modal]
ob_start();
include dirname(dirname(dirname(dirname(__DIR__)))).'/app/view/global/layout.body.php';
include dirname(dirname(dirname(dirname(__DIR__)))).'/app/view/global/layout.modal.php';
$layout['content'] = ob_get_clean();


// wrap by html & body
include dirname(dirname(dirname(dirname(__DIR__)))).'/app/view/global/layout.basic.php';


