<?php
switch ($fusebox->action) :

	case 'index':
		ob_start();
		include F::config('appPath').'view/example/index.php';
		$layout['content'] = ob_get_clean();
		// message
		$arguments['topFlash'] = 'This is global flash';
		$arguments['flash'] = 'This is inner flash';
		// breadcrumb
		$arguments['breadcrumb'] = array(
			'Level #1' => F::url('example'),
			'Level #2',
		);
		// title
		$layout['title'] = 'This is title';
		$layout['subTitle'] = 'This is sub-title';
		// layout
		$layout['width'] = 'full';
		include F::config('appPath').'view/example/layout.php';
		break;

	default:
		F::pageNotFound();

endswitch;