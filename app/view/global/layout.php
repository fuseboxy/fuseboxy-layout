<?php
$layout['metaTitle'] = 'HTML TITLE';
$layout['brand'] = 'BRAND NAME';


// left menu
$arguments['nav'] = array(
	array('name' => 'Home', 'url' => '#', 'active' => true),
	array('name' => 'About Us', 'url' => '#'),
	array('name' => 'Contact', 'url' => '#'),
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
ob_start();
include 'layout.body.php';
include 'modal.php';  // modal in different sizes
$layout['content'] = ob_get_clean();


// wrap by html & body
include 'layout.basic.php';