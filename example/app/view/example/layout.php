<?php
// 3rd-level layout (pill)
$tabLayout = array(
	'style' => 'pill',
	'position' => $fusebox->action,
	'header' => '<h6>sub-sub-layout</h6>',
	'nav' => array(
		array('name' => 'Pill #1', 'url' => '#', 'active' => true),
		array('name' => 'Pill #2', 'url' => '#'),
		array('name' => 'Pill #3', 'url' => '#'),
	),
);
//  display
ob_start();
include dirname(dirname(dirname(dirname(__DIR__)))).'/app/view/global/tab.php';
$layout['content'] = ob_get_clean();


// 2nd-level layout (tab)
$tabLayout = array(
	'style' => 'pills',
	'position' => $fusebox->action,
	'navWidth' => 3,
	'header' => '<h4>Sub-layout</h4>',
	'footer' => '<h6 class="text-muted">This is footer</h6>',
	'nav' => array(
		array('name' => 'Left', 'url' => F::url('example.left'), 'active' => F::is('*.left')),
		array('name' => 'Right', 'url' => F::url('example.right'), 'active' => F::is('*.right'), 'remark' => 'this is remark'),
		array('name' => 'Top', 'url' => F::url('example.top'), 'active' => F::is('*.top'), 'button' => array(
			'Edit' => '#',
			'Delete' => '#',
		)),
		array('name' => 'Bottom', 'url' => F::url('example.bottom'), 'active' => F::is('*.bottom'), 'menus' => array(
			array('name' => 'Menu #1'),
			array('name' => 'Menu #2'),
			array('name' => 'Menu #3'),
		)),
	),
);
ob_start();
include dirname(dirname(dirname(dirname(__DIR__)))).'/app/view/global/tab.php';
$layout['content'] = ob_get_clean();


// wrap by global layout
include F::config('appPath').'view/example/global_layout.php';

