<?php
// 3rd-level layout (pill)
$tabLayout = array(
	'style' => 'pills',
	'position' => F::is('*.right') ? $fusebox->action : 'left',
	'nav' => array(
		array('name' => 'Normal example', 'url' => '#normal-example', 'active' => true),
		array('name' => 'Dropdown example', 'url' => '#dropdown-example', 'menus' => array(
			array('name' => 'Menu #1'),
			array('name' => 'Menu #2'),
			array('name' => 'Menu #3'),
		)),
		array('name' => 'Button example', 'url' => '#button-example', 'class' => 'text-nowrap', 'buttons' => array(
			array('name' => 'Edit', 'url' => '#edit-button'),
			array('name' => 'Delete', 'url' => '#delete-button', 'class' => 'btn-danger'),
		)),
		array('name' => 'Remark example', 'url' => '#remark-example', 'remark' => 999),
		array('name' => 'Disabled example', 'url' => '#disabled-example', 'disabled' => true),
	),
);
//  display
ob_start();
include dirname(dirname(dirname(dirname(__DIR__)))).'/app/view/global/tab.php';
$layout['content'] = ob_get_clean();


// 2nd-level layout (tab)
$tabLayout = array(
	'style' => 'tabs',
	'position' => $fusebox->action,
	'nav' => array(
		array('name' => 'Left Tab',     'url' => F::url('example.left'),   'active' => F::is('*.left')),
		array('name' => 'Right Tab',    'url' => F::url('example.right'),  'active' => F::is('*.right')),
		array('name' => 'Top Tab',      'url' => F::url('example.top'),    'active' => F::is('*.top')),
		array('name' => 'Bottom Tab',   'url' => F::url('example.bottom'), 'active' => F::is('*.bottom')),
		array('name' => 'Disabled Tab', 'url' => F::url('example'),        'disabled' => true),
	),
);
ob_start();
include dirname(dirname(dirname(dirname(__DIR__)))).'/app/view/global/tab.php';
$layout['content'] = ob_get_clean();


// wrap by global layout
include F::config('appPath').'view/global/layout.php';

