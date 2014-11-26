<?php

class ScrapingUtilityTest extends CDbTestCase
{
	public function testMain()
	{
		$this->assertTrue(true);
	}
	
	public function testReturnXPathObject()
	{
		$item = '<html><body><h1>Test</h1></body></html>';
		$xpath_object = ScrapingUtility::returnXPathObject($item);
		$this->assertTrue($xpath_object instanceof DOMXPath);
	}
	
	public function testIsFile()
	{
		$this->assertTrue(ScrapingUtility::isFile('http://www.smallrevolution.com/wp-content/themes/knowhow-childtheme/images/logo-medium.png'));
		$this->assertFalse(ScrapingUtility::isFile('http://www.google.com'));
		$this->assertTrue(ScrapingUtility::isFile('http://www.smallrevolution.com/wp-content/themes/knowhow-childtheme/images/logo-medium.png'));
		$this->assertTrue(ScrapingUtility::isFile('http://cdn.css-tricks.com/wp-content/uploads/2014/07/134-thumb.jpg'));
	}
	
	public function testReturnFileExtenstion()
	{
		$this->assertEquals(ScrapingUtility::returnFileExtension('image/png'),'png');
		$this->assertEquals(ScrapingUtility::returnFileExtension('image/jpeg'),'jpg');
		$this->assertEquals(ScrapingUtility::returnFileExtension('image/gif'),'gif');
		$this->assertEquals(ScrapingUtility::returnFileExtension('image/bmp'),'bmp');
		$this->assertEquals(ScrapingUtility::returnFileExtension('image/bmpaaa'),'');	//Test Unexpected Case.
	}
}