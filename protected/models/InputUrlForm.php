<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class InputUrlForm extends CFormModel
{
	public $url;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('url', 'required'),
			array(
				'url',
				'match', 'pattern' => '/^http:\/\//',
				'message' => 'Please provide valie URL. (https not supported yet)',
			),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'url'=>'Input url you want to get all images.',
		);
	}
}