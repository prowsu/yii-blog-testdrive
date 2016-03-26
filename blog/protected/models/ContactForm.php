<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $phone;
	public $subject;
	public $body;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('name, email, subject, body, phone', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			array('phone', 'phone'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}
	public function phone($attribute,$params) {
		if(!preg_match("/^(\+7\ [0-9]{3})\ ([0-9]{7})$/", $this->$attribute))
		  $this->addError($attribute, 'Введите телефон по формату: +7 XXX XXXXXXX');
	}
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'Имя',
			'email'=>'Email',
			'phone'=>'Телефон',
			'subject'=>'Тема',
			'body'=>'Сообщение',
			'verifyCode'=>'Введите капчу',
		);
	}
}