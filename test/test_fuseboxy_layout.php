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
	}


	function test__layout__footer() {
	}


	function test__layout__header() {
	}


	function test__layout__pagination() {
	}


	function test__layout__title() {
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