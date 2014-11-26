<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		$image_name_list = array();
		$form_model=new InputUrlForm;
		if(isset($_POST['InputUrlForm']))
		{
			$url = $_POST['InputUrlForm']['url'];
			$output = Yii::app()->curl->get($url);
			
			$packtPageXpath = ScrapingUtility::returnXPathObject($output);	// Instantiating new XPath DOM object
			$coverImage = $packtPageXpath->query('//img/@src');	// Querying for book cover image URL
			
			// If cover image exists
			if ($coverImage->length > 0) 
			{
				ScrapingUtility::deleteAllFile('download/*');
				
				for($i=0 ; $i < $coverImage->length; $i++)
				{
					$imageUrl = $coverImage->item($i)->nodeValue;	// Add URL to variable

					$content_type = Yii::app()->curl->get_content_type($imageUrl);

					$extension = ScrapingUtility::returnFileExtension($content_type);
					
					$imageUrl = str_replace("https://", "http://", $imageUrl);
					if(ScrapingUtility::isFile($imageUrl))
					{
						if (getimagesize($imageUrl)) {
							$imageFile = Yii::app()->curl->get($imageUrl);	// Download image using cURL
							
							$image_file_name = $i.".".$extension;
							
							$file = fopen("download/".$image_file_name, 'w');	// Opening file handle
							fwrite($file, $imageFile);	// Writing image file
							fclose($file);	// Closing file handle
							
							$image_name_list[] = $image_file_name;
						}
					}
				}
			}
		}
		
		if(isset($url))
		{
			$form_model->url = $url;
		}
		$this->render('index',array('image_name_list'=>$image_name_list,'model'=>$form_model));
	}
}