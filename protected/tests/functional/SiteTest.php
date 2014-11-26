<?php

class SiteTest extends WebTestCase
{
	public function testIndex()
	{
		$this->open('');
		$this->assertTextPresent('Demo Image Scraping Web Application');
		$this->assertElementPresent('name=InputUrlForm[url]');
	}
}
