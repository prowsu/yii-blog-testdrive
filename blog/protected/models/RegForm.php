<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegForm extends CFormModel
{
	public $username;
	public $password;
	public $email;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, email', 'required'),
			// rememberMe needs to be a boolean
			array('email', 'email'),
			// password needs to be authenticated
			array('password', 'passlen'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Логин',
			'password'=>'Пароль',
			'email'=>'Email',
		);
	}


	public function passlen($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if(strlen(trim($this->password)) < 8)
				$this->addError('password','Пароль должен состоять минимум из 8 символов.');
		}
	}

	public function reg()
	{
		$row = Yii::app()->db->createCommand(array(
			'select' => array('email', 'username'),
			'from' => 'tbl_user',
			'where' => 'email=:email or username=:username',
			'limit' => 1,
			'params' => array(':email'=>$this->email,':username'=>$this->username),
		))->queryRow();
		if (is_array($row)) {
			if ($this->email == $row['email']) {
				$this->addError('email','Такой email уже есть. Введите другой.');
			} else {
				$this->addError('username','Такой логин уже есть. Введите другой.');
			}
			return false;
		} else {
			$cmd = Yii::app()->db->createCommand();
			$cmd->insert('tbl_user', array(
				'username'=>$this->username,
				'password'=>$this->password,
				'email'=>$this->email,
				'role'=>0
			));
			return true;
		}
	}
}
