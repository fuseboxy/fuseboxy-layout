<?php
class TestFuseboxyGlobalLayout extends UnitTestCase {


	function __construct() {
		global $fusebox;
		$fusebox = new StdClass();
	}


	function test__layout__basic() {
		global $fusebox;
		// essential arguments
		$fusebox->config['baseUrl'] = '';
		$fusebox->controller = 'unit';
		$fusebox->action = 'test';
		$layout['content'] = '{{THIS IS CONTENT}}';
		// check content defined
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.basic.php';
		$output = ob_get_clean();
		$this->assertFalse( stripos($output, 'PHP error') );
		$this->assertTrue( strpos($output, '{{THIS IS CONTENT}}') );
		$this->assertTrue( strpos($output, 'data-controller="unit"') );
		$this->assertTrue( strpos($output, 'data-action="test"') );
		// clean-up
		unset($fusebox->config, $fusebox->controller, $fusebox->action);
	}


	function test__layout__body() {
		global $fusebox;
		// check has content defined
		$layout['width'] = 'normal';
		$layout['content'] = '{{MY CONTENT}}';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.body.php';
		$output = ob_get_clean();
		$this->assertFalse( stripos($output, 'PHP error') );
		$this->assertTrue( strpos($output, '{{MY CONTENT}}') );
		$this->assertTrue( strpos($output, 'class="container"') );
		unset($layout);
		// check full layout
		$layout['width'] = 'full';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.body.php';
		$output = ob_get_clean();
		$this->assertTrue( strpos($output, 'class="container-fluid"') );
		unset($layout);
		// check narrow layout
		$layout['width'] = 'narrow';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.body.php';
		$output = ob_get_clean();
		$this->assertTrue( strpos($output, 'class="container-narrow"') );
		unset($layout);
		// check user-defined layout
		$layout['width'] = '50%';
		ob_start();
		include dirname(dirname(__FILE__)).'/app/view/global/layout.body.php';
		$output = ob_get_clean();
		$this->assertTrue( strpos($output, 'style="width: 50%"') );
		unset($layout);
	}


	function test__layout__breadcrumb() {
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