<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2011
 * @copyright Aimeos (aimeos.org), 2014-2016
 */


namespace Aimeos\MW\View\Helper\Url;


require_once __DIR__ . DIRECTORY_SEPARATOR . 'UriBuilder';


/**
 * Test class for \Aimeos\MW\View\Helper\Url\Typo3.
 */
class Typo3Test extends \PHPUnit_Framework_TestCase
{
	private $view;


	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @access protected
	 */
	protected function setUp()
	{
		$this->view = new \Aimeos\MW\View\Standard();
	}


	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @access protected
	 */
	protected function tearDown()
	{
		unset( $this->view );
	}


	public function testTransform()
	{
		$mock = $this->getMockBuilder( 'TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder' )
			->setMethods( array( 'buildFrontendUri') )->getMock();

		$mock->expects( $this->once() )->method( 'buildFrontendUri' );

		$fixed = array( 'site' => 'unittest' );
		$object = new \Aimeos\MW\View\Helper\Url\Typo3( $this->view, $mock, $fixed );

		$this->assertEquals( '', $object->transform() );
	}


	public function testTransformAbsolute()
	{
		$mock = $this->getMockBuilder( 'TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder' )
			->setMethods( array( 'setCreateAbsoluteUri') )->getMock();

		$mock->expects( $this->once() )->method( 'setCreateAbsoluteUri' )
			->with( $this->equalTo( true ) )->will( $this->returnValue( $mock ) );

		$object = new \Aimeos\MW\View\Helper\Url\Typo3( $this->view, $mock, array() );

		$config = array( 'absoluteUri' => 1 );
		$this->assertEquals( '', $object->transform( null, null, null, array(), array(), $config ) );
	}


	public function testTransformNocache()
	{
		$mock = $this->getMockBuilder( 'TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder' )
			->setMethods( array( 'setNoCache') )->getMock();

		$mock->expects( $this->once() )->method( 'setNoCache' )
			->with( $this->equalTo( true ) )->will( $this->returnValue( $mock ) );

		$object = new \Aimeos\MW\View\Helper\Url\Typo3( $this->view, $mock, array() );

		$config = array( 'nocache' => 1 );
		$this->assertEquals( '', $object->transform( null, null, null, array(), array(), $config ) );
	}


	public function testTransformChash()
	{
		$mock = $this->getMockBuilder( 'TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder' )
			->setMethods( array( 'setUseCacheHash') )->getMock();

		$mock->expects( $this->once() )->method( 'setUseCacheHash' )
			->with( $this->equalTo( true ) )->will( $this->returnValue( $mock ) );

		$object = new \Aimeos\MW\View\Helper\Url\Typo3( $this->view, $mock, array() );

		$config = array( 'chash' => 1 );
		$this->assertEquals( '', $object->transform( null, null, null, array(), array(), $config ) );
	}


	public function testTransformType()
	{
		$mock = $this->getMockBuilder( 'TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder' )
			->setMethods( array( 'setTargetPageType') )->getMock();

		$mock->expects( $this->once() )->method( 'setTargetPageType' )
			->with( $this->equalTo( 123 ) )->will( $this->returnValue( $mock ) );

		$object = new \Aimeos\MW\View\Helper\Url\Typo3( $this->view, $mock, array() );

		$config = array( 'type' => 123 );
		$this->assertEquals( '', $object->transform( null, null, null, array(), array(), $config ) );
	}


	public function testTransformFormat()
	{
		$mock = $this->getMockBuilder( 'TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder' )
			->setMethods( array( 'setFormat') )->getMock();

		$mock->expects( $this->once() )->method( 'setFormat' )
			->with( $this->equalTo( 'xml' ) )->will( $this->returnValue( $mock ) );

		$object = new \Aimeos\MW\View\Helper\Url\Typo3( $this->view, $mock, array() );

		$config = array( 'format' => 'xml' );
		$this->assertEquals( '', $object->transform( null, null, null, array(), array(), $config ) );
	}


	public function testTransformEID()
	{
		$mock = $this->getMockBuilder( 'TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder' )
			->setMethods( array( 'setArguments') )->getMock();

		$param = array( 'eID' => 123, 'ai' => array( 'controller' => null, 'action' => null ) );

		$mock->expects( $this->once() )->method( 'setArguments' )
			->with( $this->equalTo( $param ) )->will( $this->returnValue( $mock ) );

		$object = new \Aimeos\MW\View\Helper\Url\Typo3( $this->view, $mock, array() );

		$config = array( 'eID' => 123 );
		$this->assertEquals( '', $object->transform( null, null, null, array(), array(), $config ) );
	}


	public function testTransformBackend()
	{
		$mock = $this->getMockBuilder( 'TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder' )
		->setMethods( array( 'buildBackendUri') )->getMock();

		$mock->expects( $this->once() )->method( 'buildBackendUri' );

		$object = new \Aimeos\MW\View\Helper\Url\Typo3( $this->view, $mock, array( 'site' => 'unittest' ) );

		$params = array( 'test' => 'my/value' );
		$this->assertEquals( '', $object->transform( null, null, null, $params, array(), array( 'BE' => 1 ) ) );
	}


	public function testTransformParams()
	{
		$mock = $this->getMockBuilder( 'TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder' )
			->setMethods( array( 'buildFrontendUri') )->getMock();

		$mock->expects( $this->once() )->method( 'buildFrontendUri' );

		$object = new \Aimeos\MW\View\Helper\Url\Typo3( $this->view, $mock, array( 'site' => 'unittest' ) );

		$params = array( 'test' => 'my/value' );
		$this->assertEquals( '', $object->transform( null, null, null, $params ) );
	}


	public function testTransformNoNamespace()
	{
		$mock = $this->getMockBuilder( 'TYPO3\\CMS\\Extbase\\Mvc\\Web\\Routing\\UriBuilder' )
			->setMethods( array( 'buildFrontendUri', 'getArgumentPrefix' ) )->getMock();

		$mock->expects( $this->once() )->method( 'buildFrontendUri' );
		$mock->expects( $this->once() )->method( 'getArgumentPrefix' )->will( $this->returnValue( 'ai' ) );

		$object = new \Aimeos\MW\View\Helper\Url\Typo3( $this->view, $mock, array( 'site' => 'unittest' ) );

		$params = array( 'test' => 'my/value' );
		$config = array( 'namespace' => false );
		$this->assertEquals( '', $object->transform( null, null, null, $params, array(), $config ) );
	}
}
