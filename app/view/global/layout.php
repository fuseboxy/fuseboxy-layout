<?php
$layout['metaTitle'] = '';  // html title
$layout['brand'] = ''; // brand name


// left menu
/*$arguments['nav'] = array(
	array('name' => 'Home', 'url' => '#', 'active' => true),
	array('name' => 'About Us', 'url' => '#'),
	array('name' => 'Contact', 'url' => '#'),
);*/


// right menu
/*$arguments['navRight'] = array(
	// settings
	( class_exists('Auth') and Auth::activeUserInRole('SUPER,ADMIN') ) ? array(
		'name' => '<i class="fa fa-cog"></i>',
		'menus' => array(
			array('navHeader' => '<strong>SETTINGS</strong>', 'divider' => 'after'),
			array('name' => 'User Management', 'url' => F::url('user'), 'active' => F::is('user.*')),
			array('name' => 'System Settings', 'url' => F::url('enum'), 'active' => F::is('enum.*')),
			array('name' => 'Audit Log',      'url' => F::url('log'),  'active' => F::is('log.*')),
		),
	) : null,
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
	( class_exists('Auth') and Auth::user() ) ? array(
		'name' => "<img src='//ssl.gstatic.com/accounts/ui/avatar_2x.png' class='rounded' style='height: 32px; width: 32px; margin: -10px 0;' />",
		'menus' => array(
			array('navHeader' => '<strong>'.Auth::user('username').'</strong>', 'divider' => 'after'),
			array('name' => 'Update Profile', 'url' => F::url('account.profile'), 'active' => F::is('account.profile')),
			array('name' => 'Change Password', 'url' => F::url('account.password'), 'active' => F::is('account.password')),
			array('name' => '<i class="fa fa-power-off"></i> Sign Out', 'url' => F::url('auth.logout'), 'divider' => 'before'),
		),
	) : null,
);*/


// display altogether
// ===> include modal in different sizes for [toggle=modal]
ob_start();
include 'layout.body.php';
include 'layout.modal.php';
$layout['content'] = ob_get_clean();


// wrap by html & body
include 'layout.basic.php';