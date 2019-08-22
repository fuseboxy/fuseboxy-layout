<?php
$layout['metaTitle'] = '';  // html title
$layout['brand'] = ''; // brand name


// left menu
$arguments['nav'] = array(
	array('name' => 'Home', 'url' => F::url('home'), 'active' => F::is('home.*')),
);


// right menu
/*$arguments['navRight'] = array(
	// settings
	( class_exists('Auth') and Auth::activeUserInRole('SUPER,ADMIN') ) ? array(
		'name' => '<i class="fa fa-cog"></i>',
		'menus' => array(
			array('navHeader' => 'SETTINGS', 'divider' => 'after'),
			array('name' => 'User Management', 'url' => F::url('user'), 'active' => F::is('user.*')),
			array('name' => 'System Settings', 'url' => F::url('enum'), 'active' => F::is('enum.*')),
			array('name' => 'Audit Log',      'url' => F::url('log'),  'active' => F::is('log.*')),
		),
	) : null,
	// user-sim
	( class_exists('Sim') and class_exists('Auth') and Auth::userInRole('SUPER') ) ? call_user_func(function(){
		$simMenus = array( array('navHeader' => 'USER SIMULATION', 'divider' => 'after') );
		$simUsers = R::find('user', "id != ? AND role != 'SUPER' AND IFNULL(disabled, 0) = 0 ORDER BY username ASC", array(Auth::user('id')));
		foreach ( $simUsers as $u ) $simMenus[] = array('name' => $u->username, 'url' => F::url("auth.start_sim&user_id={$u->id}"));
		if ( Sim::user() ) $simMenus[] = array('name' => '<i class="fa fa-sign-out-alt"></i> End Sim', 'url' => F::url('auth.end_sim'), 'divider' => 'before');
		return $simUsers ? array(
			'name' => '<i class="fa fa-mask"></i>'.( Sim::user() ? ' ' : '' ).Sim::user('username'),
			'menus' => $simMenus,
			'active' => Sim::user(),
		) : null;
	}) : null,
	// logout
	( class_exists('Auth') and Auth::user()  ) ? array(
		'name' => '<i class="fa fa-user"></i>',
		'menus' => array(
			array('navHeader' => Auth::user('username'), 'divider' => 'after'),
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