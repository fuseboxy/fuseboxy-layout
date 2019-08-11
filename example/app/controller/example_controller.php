<?php
switch ($fusebox->action) :

	case 'index':
		F::redirect('example.left');
		break;

	case 'left':
	case 'right':
	case 'top':
	case 'bottom':
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
		$layout['title'] = array('This is title', 'This is sub-title', 'This is sub-sub-title');
		// layout
		$layout['width'] = 'full';
		include F::config('appPath').'view/example/layout.php';
		break;

	default:
		F::pageNotFound();

endswitch;