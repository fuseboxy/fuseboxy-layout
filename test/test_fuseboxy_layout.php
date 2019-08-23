<?php
class TestFuseboxyLayout extends UnitTestCase {


	function __construct() {
		if ( !class_exists('Framework') ) {
			include dirname(__FILE__).'/utility-layout/framework/1.0.6/fuseboxy.php';
		}
		if ( !class_exists('F') ) {
			include dirname(__FILE__).'/utility-layout/framework/1.0.6/F.php';
		}
		if ( !class_exists('phpQuery') ) {
			include dirname(__FILE__).'/utility-layout/phpquery/0.9.5/phpQuery.php';
		}
		Framework::$mode = Framework::FUSEBOX_UNIT_TEST;
	}


	function test__layout__basic() {
		global $fusebox;
		Framework::createAPIObject();
		Framework::loadConfig();
		Framework::setMyself();
		// essential arguments
		$fusebox->config['baseUrl'] = '';
		$fusebox->controller = 'unit';
		$fusebox->action = 'test';
		$layout['content'] = '{{THIS IS CONTENT}}';
		// check content defined
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.basic.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/{{THIS IS CONTENT}}/i', $output);
		$this->assertTrue( pq('[data-controller=unit]')->length == 1 );
		$this->assertTrue( pq('[data-action=test]')->length == 1 );
		// clean-up
		unset($fusebox);
	}


	function test__layout__body() {
		// check has content defined
		$layout['width'] = 'normal';
		$layout['content'] = '{{MY CONTENT}}';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.body.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/{{MY CONTENT}}/i', $output);
		$this->assertTrue( pq('.container')->length );
		unset($layout);
		// check full layout
		$layout['width'] = 'full';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.body.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.container-fluid')->length );
		unset($layout);
		// check narrow layout
		$layout['width'] = 'narrow';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.body.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.container-narrow')->length );
		unset($layout);
		// check user-defined layout
		$layout['width'] = '50%';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.body.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/style="width: 50%"/', $output);
		unset($layout);
	}


	function test__layout__breadcrumb() {
		// empty breadcrumb (still have home)
		$arguments['breadcrumb'] = array();
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.breadcrumb.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.breadcrumb')->length == 1 );
		$this->assertTrue( pq('.breadcrumb>li')->length == 1 );
		$this->assertTrue( pq('.breadcrumb>li>a')->attr('href') == F::url() );
		// breadcrumb without link (just home)
		$arguments['breadcrumb'] = array('AAA', 'BBB', 'CCC');
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.breadcrumb.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.breadcrumb>li')->length == 4 );
		$this->assertTrue( pq('.breadcrumb a')->length == 1 );
		$this->assertTrue( pq('.breadcrumb>li:eq(1)')->text() == 'AAA' );
		$this->assertTrue( pq('.breadcrumb>li:eq(2)')->text() == 'BBB' );
		$this->assertTrue( pq('.breadcrumb>li:eq(3)')->text() == 'CCC' );
		// breadcrumb with link
		$arguments['breadcrumb'] = array('foo' => F::url('foo'), 'bar' => F::url('bar'));
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.breadcrumb.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.breadcrumb>li')->length == 3 );		
		$this->assertTrue( pq('.breadcrumb a')->length == 3 );
		$this->assertTrue( pq('.breadcrumb>li:eq(1)>a')->attr('href') == F::url('foo') );
		$this->assertTrue( pq('.breadcrumb>li:eq(2)>a')->attr('href') == F::url('bar') );
	}


	function test__layout__flash() {
		// flash by session variable
		// ===> session variable should be cleared
		$_SESSION['flash'] = 'This is a flash message';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.flash.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is a flash message/i', $output);
		$this->assertTrue( !isset($_SESSION['flash']) );
		$this->assertTrue( pq('#flash')->length );
		// flash by local variable
		$arguments['flash'] = 'This is another flash message';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.flash.php';
		$output = ob_get_clean();
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is another flash message/i', $output);
		// session should be over local variable
		$_SESSION['flash'] = 'Message at session';
		$arguments['flash'] = 'Message at local';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.flash.php';
		$output = ob_get_clean();
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/message at session/i', $output);
		$this->assertNoPattern('/message at local/i', $output);
		// simple text should be default as warning style
		$arguments['flash'] = 'This is simple text message';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.flash.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is simple text message/i', $output);
		$this->assertTrue( pq('#flash.alert-warning')->length );
		// with type defined
		$arguments['flash'] = array(
			'type' => 'danger',
			'message' => 'This is dangerous message',
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.flash.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is dangerous message/i', $output);
		$this->assertTrue( pq('#flash.alert-danger')->length );
		// with type, icon, title, and message defined
		$arguments['flash'] = array(
			'icon' => 'fa fa-info',
			'type' => 'info',
			'title' => 'NOTE:',
			'message' => 'This is informational message',
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.flash.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is informational message/i', $output);
		$this->assertTrue( pq('#flash.alert-info')->length );
		$this->assertTrue( pq('#flash .fa-info')->length );
		$text = pq('#flash')->text();
		$text = preg_replace('/[\r\n]+/', " ", $text);
		$text = preg_replace('/[ \t]+/', ' ', $text);
		$text = trim($text);
		$this->assertPattern('/note: this is informational message/i', $text);
		// no flash defined
		if ( isset($arguments['flash']) ) unset($arguments['flash']);
		if ( isset($_SESSION['flash']) ) unset($_SESSION['flash']);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.flash.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertFalse( pq('#flash')->length );
		$this->assertTrue( trim($output) == '' );
		// clean-up
		if ( isset($_SESSION['flash']) ) unset($_SESSION['flash']);
	}


	function test__layout__footer() {
		// simply make sure something displayed
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.footer.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('#footer')->length );
	}


	function test__layout__header() {
		// simply make sure something displayed
		// ===> no menu
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.header.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('#header')->length );
		$this->assertTrue( pq('#nav')->length );
		$this->assertFalse( pq('.navbar-nav:not(.navbar-right)>li')->length );
		$this->assertFalse( pq('.navbar-nav.navbar-right>li')->length );
		// single-level menu
		$arguments['nav'] = array(
			array('name' => 'Home', 'url' => F::url('home.index')),
			array('name' => 'Foo Bar', 'url' => F::url('foo.bar')),
			array('name' => 'Unit Test', 'url' => F::url('unit.test')),
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.header.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/home/i', pq('.navbar-nav:not(.navbar-right)>li:eq(0)')->text());
		$this->assertPattern('/foo bar/i', pq('.navbar-nav:not(.navbar-right)>li:eq(1)')->text());
		$this->assertPattern('/unit test/i', pq('.navbar-nav:not(.navbar-right)>li:eq(2)')->text());
		$this->assertTrue( pq('.navbar-nav:not(.navbar-right)>li')->length == 3 );
		$this->assertTrue( pq('.navbar-nav:not(.navbar-right)>li:eq(0)>a')->attr('href') == F::url('home.index') );
		$this->assertTrue( pq('.navbar-nav:not(.navbar-right)>li:eq(1)>a')->attr('href') == F::url('foo.bar') );
		$this->assertTrue( pq('.navbar-nav:not(.navbar-right)>li:eq(2)>a')->attr('href') == F::url('unit.test') );
		unset($arguments['nav']);
		// double-level menu
		$arguments['nav'] = array(
			array('name' => 'People', 'menus' => array(
				array('name' => 'Staff', 'url' => F::url('people.staff')),
				array('name' => 'Student', 'url' => F::url('people.student')),
			)),
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.header.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/people/i', pq('.navbar-nav:not(.navbar-right)>li:eq(0)')->text());
		$this->assertPattern('/staff/i', pq('.navbar-nav:not(.navbar-right)>li li:eq(0)')->text());
		$this->assertPattern('/student/i', pq('.navbar-nav:not(.navbar-right)>li li:eq(1)')->text());
		$this->assertTrue( pq('.navbar-nav:not(.navbar-right)>li')->length == 1 );
		$this->assertTrue( pq('.navbar-nav:not(.navbar-right)>li li')->length == 2 );
		$this->assertTrue( pq('.navbar-nav:not(.navbar-right)>li li:eq(0)>a')->attr('href') == F::url('people.staff') );
		$this->assertTrue( pq('.navbar-nav:not(.navbar-right)>li li:eq(1)>a')->attr('href') == F::url('people.student') );
		unset($arguments['nav']);
		// right navigation
		$arguments['navRight'] = array(
			array('name' => 'foo'),
			array('name' => 'bar'),
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.header.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertFalse( pq('.navbar-nav:not(.navbar-right)>li')->length );
		$this->assertTrue( pq('.navbar-nav.navbar-right>li')->length );
		$this->assertPattern('/foo/i', pq('.navbar-nav.navbar-right>li:eq(0)')->text());
		$this->assertPattern('/bar/i', pq('.navbar-nav.navbar-right>li:eq(1)')->text());
		unset($arguments['navRight']);
		// check active, class-name, and nav-header
		$arguments['nav'] = array(
			array('name' => 'unit', 'url' => F::url('unit'), 'navHeader' => 'Hello World'),
			array('name' => 'test', 'url' => F::url('test'), 'active' => true, 'className' => 'foo-bar'),
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.header.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('li.active')->length );
		$this->assertTrue( pq('li.foo-bar')->length );
		$this->assertTrue( pq('li.dropdown-header')->length );
		$this->assertTrue( trim( pq('li.active')->text() ) == 'test');
		$this->assertTrue( trim( pq('li.foo-bar')->text() ) == 'test');
		$this->assertTrue( trim( pq('li.dropdown-header')->text() ) == 'Hello World' );
		unset($arguments['nav']);
	}


	function test__layout__modal() {
		// check all sizes of modal
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.modal.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('#global-modal')->length );
		$this->assertTrue( pq('.modal-sm')->length );
		$this->assertTrue( pq('.modal-lg')->length );
		$this->assertTrue( pq('.modal-max')->length );
		$this->assertTrue( pq('#global-modal-iframe')->length );
		$this->assertTrue( pq('#global-modal-title-iframe')->length );
		$this->assertTrue( pq('iframe')->length == 2 );
		$this->assertTrue( pq('.modal')->length == 6 );
	}


	function test__layout__pagination() {
		// has pages
		$arguments['pagination'] = array(
			'record_count' => 45,
			'record_per_page' => 10,
			'page_visible' => 100,
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.pagination.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('ul.pagination')->length );
		$this->assertTrue( pq('ul.pagination>li')->length >= 5 );
		unset($arguments['pagination']);
		// has no page
		$arguments['pagination'] = array('record_count' => 0);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.pagination.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertFalse( pq('ul.pagination')->length );
		$this->assertFalse( pq('ul.pagination>li')->length );
		unset($arguments['pagination']);
		// no pagination defined
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.pagination.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertFalse( pq('ul.pagination')->length );
	}


	function test__layout__title() {
		// no title
		// ===> nothing display
		$layout['title'] = null;
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.title.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertFalse( pq('.page-header')->length );
		if ( isset($layout['title']) ) unset($layout['title']);
		// empty title
		// ===> nothing display as well
		$layout['title'] = '';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.title.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertFalse( pq('.page-header')->length );
		unset($layout['title']);
		// space title
		// ===> display invisible title
		$layout['title'] = ' ';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.title.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.page-header')->length );
		$text = pq('.page-header')->text();
		$text = preg_replace('/[\r\n]+/', " ", $text);
		$text = preg_replace('/[ \t]+/', ' ', $text);
		$text = trim($text);
		$this->assertTrue( $text == '' );
		unset($layout['title']);
		// has title
		// ===> display title
		$layout['title'] = 'Hello';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.title.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.page-header')->length );
		$this->assertPattern('/hello/i', pq('.page-header')->text());
		unset($layout['title']);
		// has sub-title
		// ===> display both title & sub-title
		$layout['title'] = 'Hello';
		$layout['subTitle'] = 'World';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.title.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.page-header')->length );
		$text = pq('.page-header')->text();
		$text = preg_replace('/[\r\n]+/', " ", $text);
		$text = preg_replace('/[ \t]+/', ' ', $text);
		$text = trim($text);
		$this->assertPattern('/hello world/i', $text);
		unset($layout['title'], $layout['subTitle']);
		// empty sub-title
		// ===> display title only
		$layout['title'] = 'Hello';
		$layout['subTitle'] = '';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.title.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.page-header')->length );
		$this->assertPattern('/hello/i', pq('.page-header')->text());
		unset($layout['title'], $layout['subTitle']);
		// has sub-title but no title
		$layout['subTitle'] = 'World';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.title.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( trim($output) == '' );
		$this->assertFalse( pq('.page-header')->length );
		$this->assertNoPattern('/world/i', pq('.page-header')->text());
		unset($layout['subTitle']);
	}


	function test__layout__topFlash() {
		// flash by session variable
		// ===> session variable should be cleared
		$_SESSION['topFlash'] = 'This is a flash message';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.topflash.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is a flash message/i', $output);
		$this->assertTrue( !isset($_SESSION['topFlash']) );
		$this->assertTrue( pq('#top-flash')->length );
		// flash by local variable
		$arguments['topFlash'] = 'This is another flash message';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.topflash.php';
		$output = ob_get_clean();
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is another flash message/i', $output);
		// session should be over local variable
		$_SESSION['topFlash'] = 'Message at session';
		$arguments['topFlash'] = 'Message at local';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.topflash.php';
		$output = ob_get_clean();
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/message at session/i', $output);
		$this->assertNoPattern('/message at local/i', $output);
		// simple text should be default as warning style
		$arguments['topFlash'] = 'This is simple text message';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.topflash.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is simple text message/i', $output);
		$this->assertTrue( pq('#top-flash.btn-warning')->length );
		// with type defined
		$arguments['topFlash'] = array(
			'type' => 'danger',
			'message' => 'This is dangerous message',
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.topflash.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is dangerous message/i', $output);
		$this->assertTrue( pq('#top-flash.btn-danger')->length );
		// with type, icon, title, and message defined
		$arguments['topFlash'] = array(
			'icon' => 'fa fa-info',
			'type' => 'info',
			'title' => 'NOTE:',
			'message' => 'This is informational message',
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.topflash.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is informational message/i', $output);
		$this->assertTrue( pq('#top-flash.btn-info')->length );
		$this->assertTrue( pq('#top-flash .fa-info')->length );
		$text = pq('#top-flash')->text();
		$text = preg_replace('/[\r\n]+/', " ", $text);
		$text = preg_replace('/[ \t]+/', ' ', $text);
		$text = trim($text);
		$this->assertPattern('/note: this is informational message/i', $text);
		// no flash defined
		if ( isset($arguments['topFlash']) ) unset($arguments['topFlash']);
		if ( isset($_SESSION['topFlash']) ) unset($_SESSION['topFlash']);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.topflash.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertFalse( pq('#top-flash')->length );
		$this->assertTrue( trim($output) == '' );
		// clean-up
		if ( isset($_SESSION['topFlash']) ) unset($_SESSION['topFlash']);
	}


	function test__layout() {
		global $fusebox;
		Framework::createAPIObject();
		Framework::loadConfig();
		Framework::setMyself();
		$fusebox->config['baseUrl'] = '';
		$fusebox->controller = 'foo';
		$fusebox->action = 'bar';
		// minimum arguments
		// ===> should have no error
		$layout['content'] = '<p>This Is Global Layout Unit Test</p>';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is global layout unit test/i', $output);
		$this->assertTrue( pq('body')->length );
		$this->assertTrue( pq('[data-controller=foo][data-action=bar]')->length );
		// clean-up
		unset($fusebox);
	}


	function test__modal__body() {

	}


	function test__modal__footer() {

	}


	function test__modal__nav() {

	}


	function test__modal__title() {

	}


	function test__modal() {
		
	}
/*
	function test__modal__content() {
		// always has content, footer, and close button
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/modal.content.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.modal-content')->length );
		$this->assertTrue( pq('.modal-footer')->length );
		$this->assertTrue( pq('[data-dismiss=modal]')->length );
		$this->assertFalse( pq('.modal-header')->length );
		$this->assertFalse( pq('.modal-body')->length );
		// element ID specified
		$layout['modalID'] = 'unit-test-modal';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/modal.content.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('#unit-test-modal')->length );
		unset($layout['modalID']);
		// title specified
		$layout['modalTitle'] = 'Foobar Modal';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/modal.content.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.modal-header')->length );
		$this->assertPattern('/foobar modal/i', pq('.modal-header')->text());
		unset($layout['modalTitle']);
		// body content specified
		$layout['modalBody'] = '<div><p>This is <mark>BODY CONTENT</mark>!!!</p></div>';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/modal.content.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.modal-body')->length );
		$this->assertPattern('/this is body content/i', pq('.modal-body')->text());
		unset($layout['modalBody']);
	}
*/

	function test__tab__body() {
		// essential settings
		$tabLayout['style'] = 'tab';
		$tabLayout['position'] = 'left';
		$tabLayout['navWidth'] = 2;
		$layout['content'] = '<<THIS IS MY CONTENT>>';
		// no error with essential settings
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/tab.body.php';
		$output = ob_get_clean();
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertPattern('/this is my content/i', $output);
	}


	function test__tab__nav() {
		// essential settings
		$tabLayout['style'] = 'tab';
		$tabLayout['position'] = 'left';
		$tabLayout['navWidth'] = 2;
		// no error with essential settings
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/tab.nav.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertFalse( pq('li')->length );
		// header & footer specified
		$tabLayout['header'] = 'Unit Test';
		$tabLayout['footer'] = 'foo bar';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/tab.nav.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.tab-header')->length );
		$this->assertTrue( pq('.tab-footer')->length );
		$this->assertPattern('/unit test/i', pq('.tab-header')->text());
		$this->assertPattern('/foo bar/i', pq('.tab-footer')->text());
		$this->assertTrue( pq('li')->length == 2 );
		unset($tabLayout['header'], $tabLayout['footer']);
		// has tabs
		$tabLayout['nav'] = array(
			array('name' => '1st Tab', 'url' => F::url('tab.first'), 'active' => true),
			array('name' => '2nd Tab', 'url' => F::url('tab.second')),
			array('name' => '3rd Tab', 'url' => F::url('tab.third')),
			array('name' => '4th Tab', 'url' => F::url('tab.fourth')),
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/tab.nav.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('li')->length == 4 );
		$this->assertTrue( trim( pq('li.active')->text() ) == '1st Tab' );
		$this->assertTrue( trim( pq('li:eq(0)')->text() ) == '1st Tab' );
		$this->assertTrue( trim( pq('li:eq(1)')->text() ) == '2nd Tab' );
		$this->assertTrue( trim( pq('li:eq(2)')->text() ) == '3rd Tab' );
		$this->assertTrue( trim( pq('li:eq(3)')->text() ) == '4th Tab' );
		$this->assertTrue( pq('li:eq(0)>a')->attr('href') == F::url('tab.first') );
		$this->assertTrue( pq('li:eq(1)>a')->attr('href') == F::url('tab.second') );
		$this->assertTrue( pq('li:eq(2)>a')->attr('href') == F::url('tab.third') );
		$this->assertTrue( pq('li:eq(3)>a')->attr('href') == F::url('tab.fourth') );
		unset($tabLayout['nav']);
		// tab with button
		// ===> both tab & button can have different links
		$tabLayout['nav'] = array(
			array(
				'name' => 'Tab with Button',
				'url' => F::url('with.button'),
				'button' => array('Edit' => F::url('edit.button')),
			),
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/tab.nav.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('li')->length == 1 );
		$this->assertTrue( pq('li>a')->attr('href') == F::url('with.button') );
		$this->assertPattern('/tab with button/i', pq('li>a')->text() );
		$this->assertTrue( pq('li button')->length == 1 );
		$this->assertPattern('/Edit/', pq('li button')->text());
		$this->assertTrue( pq('li button')->attr('data-url') == F::url('edit.button') );
		unset($tabLayout['nav']);
		// tab with menu
		// ===> tab is click-able only to reveal dropdown menu
		// ===> no link will be on the tab
		$tabLayout['nav'] = array(
			array(
				'name' => 'Tab with Menu',
				'url' => F::url('with.menu'),
				'menus' => array(
					array('name' => 'Foo Bar', 'url' => F::url('foo.bar')),
					array('name' => 'Unit Test', 'url' => F::url('unit.test')),
				)
			),
		);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/tab.nav.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.nav-tabs>li')->length == 1 );
		$this->assertTrue( pq('.dropdown-menu>li')->length == 2 );
		$this->assertFalse( pq('.nav-tabs>li>a')->attr('href') == F::url('with.menu') );
		$this->assertTrue( pq('.dropdown-menu>li:eq(0)>a')->attr('href') == F::url('foo.bar') );
		$this->assertTrue( pq('.dropdown-menu>li:eq(1)>a')->attr('href') == F::url('unit.test') );
		unset($tabLayout['nav']);
	}


	function test__tab() {
		$layout['content'] = 'My Content at Tab Layout';
		// check default config
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/tab.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('#tab-layout')->length );
		$this->assertTrue( isset($tabLayout['style']) );
		$this->assertTrue( isset($tabLayout['position']) );
		$this->assertTrue( isset($tabLayout['navWidth']) );
		$text = pq('#tab-layout')->text();
		$text = preg_replace('/[\r\n]+/', " ", $text);
		$text = preg_replace('/[ \t]+/', ' ', $text);
		$text = trim($text);
		$this->assertTrue( $text == 'My Content at Tab Layout' );
		// show title, breadcrumb, flash, and pagination
		// ===> all should be removed to avoid showing in global layout again
		$layout['title'] = 'My Title';
		$arguments['breadcrumb'] = array('My', 'Breadcrumb');
		$arguments['flash'] = 'My Flash';
		$arguments['pagination'] = array('record_count' => 999, 'record_per_page' => 10);
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/tab.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('.page-header')->length );
		$this->assertTrue( trim( pq('.page-header')->text() ) == 'My Title' );
		$this->assertTrue( pq('.breadcrumb li')->length == 3 );
		$this->assertTrue( trim( pq('.breadcrumb li:eq(1)')->text() ) == 'My' );
		$this->assertTrue( trim( pq('.breadcrumb li:eq(2)')->text() ) == 'Breadcrumb' );
		$this->assertTrue( pq('#flash')->length );
		$this->assertTrue( trim( pq('#flash')->text() ) == 'My Flash' );
		$this->assertTrue( pq('.pagination')->length );
		$this->assertFalse( isset($layout['title']) );
		$this->assertFalse( isset($arguments['breadcrumb']) );
		$this->assertFalse( isset($arguments['flash']) );
		$this->assertFalse( isset($arguments['pagination']) );
	}


} // TestFuseboxyLayout