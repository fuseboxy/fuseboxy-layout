<?php
class TestFuseboxyGlobalLayout extends UnitTestCase {


	function __construct() {
		$GLOBALS['FUSEBOX_UNIT_TEST'] = true;
		if ( !class_exists('Framework') ) {
			include dirname(__FILE__).'/utility-layout/framework/1.0/fuseboxy.php';
		}
		if ( !class_exists('F') ) {
			include dirname(__FILE__).'/utility-layout/framework/1.0/F.php';
		}
		if ( !class_exists('phpQuery') ) {
			include dirname(__FILE__).'/utility-layout/phpquery/0.9.5/phpQuery.php';
		}
	}


	function test__layout__basic() {
		global $fusebox;
		Framework::createAPIObject();
		Framework::loadDefaultConfig();
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
		global $fusebox;
		Framework::createAPIObject();
		Framework::loadDefaultConfig();
		Framework::setMyself();
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
		// clean-up
		unset($fusebox);
	}


	function test__layout__breadcrumb() {
		global $fusebox;
		Framework::createAPIObject();
		Framework::loadDefaultConfig();
		Framework::setMyself();
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
		global $fusebox;
		Framework::createAPIObject();
		Framework::loadDefaultConfig();
		Framework::setMyself();
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
		unset($fusebox);
	}


	function test__layout__footer() {
		global $fusebox;
		Framework::createAPIObject();
		Framework::loadDefaultConfig();
		Framework::setMyself();
		// simply make sure something displayed
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.footer.php';
		$output = ob_get_clean();
		$doc = phpQuery::newDocument($output);
		$this->assertNoPattern('/PHP ERROR/i', $output);
		$this->assertTrue( pq('#footer')->length );
		// clean-up
		unset($fusebox);
	}


	function test__layout__header() {
		global $fusebox;
		Framework::createAPIObject();
		Framework::loadDefaultConfig();
		Framework::setMyself();
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
		// clean-up
		unset($fusebox);
	}


	function test__layout__pagination() {
		global $fusebox;
		Framework::createAPIObject();
		Framework::loadDefaultConfig();
		Framework::setMyself();
		// simply make sure something displayed

		// clean-up
		unset($fusebox);
	}


	function test__layout__title() {
		global $fusebox;
		Framework::createAPIObject();
		Framework::loadDefaultConfig();
		Framework::setMyself();
		// simply make sure something displayed

		// clean-up
		unset($fusebox);
	}


	function test__layout__topflash() {
	}


	/*function test__layout() {
		global $fusebox;
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.php';
		$output = ob_get_clean();
		$this->assertFalse( stripos($output, 'PHP error') );
	}*/


	function test__modal__content() {
	}


	function test__modal() {
	}


	function test__tab__body() {
	}


	function test__tab__nav() {
	}


	function test__tab() {
	}


} // TestFuseboxyGlobalLayout