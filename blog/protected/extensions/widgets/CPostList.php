<?php
class CPostList extends CWidget
{
	public $pattern="";
	public $hidden=false;
	private $editable=false;
	
    public function init() {
		$this->editable = Yii::app()->user->isAdmin();
		if ($this->pattern=="") {
			$this->pattern = "
			<h3>%title%</h3>
			<p>%content%</p>
			<small>Добавил <a href='%user%'>%username%</a> %date%</small>
			<hr/>";
		}
	}
 
    public function run() {
		$records = Yii::app()->db->createCommand()
		->select('*')
		->from('tbl_blogrecord')
		->where('`date` '.($this->hidden ? '=' : '<>').' 0')
		->queryAll();
		foreach ($records as $data) {
			$uName=Yii::app()->db->createCommand()->select('username')->from('tbl_user')->where('id='.$data['user'])->queryRow();
			$data = array_merge($data,(is_array($uName) && isset($uName['username']) ? $uName:array('username'=>'!USER#'.$data['user'].'!')));
			$data['user'] = Yii::app()->createUrl('user/'.$data['user']);
			if ($this->editable) $data['date'].=" <a href='".Yii::app()->createUrl('blogrecord/default/edit',array('id'=>$data['id']))."'>изменить</a>";
			echo str_replace(
				array('%id%','%title%','%user%','%date%','%content%','%username%'),
				$data,
				$this->pattern
			);
		}
    }
}
?>