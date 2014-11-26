<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ScrapingUtility
{
	public static function returnXPathObject($item) {
		$xmlPageDom = new DomDocument();	// Instantiating a new DomDocument object
		@$xmlPageDom->loadHTML($item);	// Loading the HTML from downloaded page
		$xmlPageXPath = new DOMXPath($xmlPageDom);	// Instantiating new XPath DOM object
		return $xmlPageXPath;	// Returning XPath object
	}
	
	public static function isFile($url) 
	{
		if(preg_match("/^(https?:\/\/)/",$url))
		{
			$headers = get_headers($url);
			if($headers && strpos($headers[0], '200') !== false) 
			{ //response code 200 means that url is fine
				return true;
			} 
			else 
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function deleteAllFile($glob_pattern) 
	{
		$files = glob($glob_pattern); // get all file names
		foreach($files as $file) 
		{ // iterate files
			if(is_file($file))
			unlink($file); // delete file
		}
	}
	
	public static function returnFileExtension($content_type)
	{
		$extension = "";
		if($content_type == 'image/png')
		{
			$extension = "png";
		}
		else if($content_type == 'image/jpeg')
		{
			$extension = "jpg";
		}
		else if($content_type == 'image/gif')
		{
			$extension = "gif";
		}
		else if($content_type == 'image/bmp')
		{
			$extension = "bmp";
		}
		return $extension;
	}
}