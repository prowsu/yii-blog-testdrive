<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class BlogrecordForm extends CFormModel
{
	public $id;
	public $title;
	public $content;
	public $user;
	public $date;
	public $isNewRecord;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('title, content, user, date', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'title'=>'Заголовок',
			'user'=>'Автор',
			'date'=>'Дата публикации',
			'content'=>'Содержание',
		);
	}

	public function blogrecord()
	{
		if ($this->isNewRecord) {
			$cmd = Yii::app()->db->createCommand();
			$cmd->insert('tbl_blogrecord', array(
				'title'=>$this->title,
				'content'=>$this->content,
				'user'=>$this->user,
				'date'=>$this->date,
			));
		} else {
			$cmd = Yii::app()->db->createCommand();
			$cmd->update('tbl_blogrecord', array(
				'title'=>$this->title,
				'content'=>$this->content,
				'user'=>$this->user,
				'date'=>$this->date,
			), 'id=:id', array(':id'=>$this->id));
		}
		return true;
	}
}
