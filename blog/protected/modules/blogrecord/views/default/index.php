<?php
/* @var $this DefaultController */

$this->pageTitle=Yii::app()->name . ' - Блогозаписи';
$this->breadcrumbs=array(
	"Блогозаписи"
);
?>
<h1>Блогозаписи <small>
<?php if (Yii::app()->user->isAdmin()) { 
	echo "<a href='".Yii::app()->createUrl('blogrecord/default/create/')."'>+добавить запись</a> &middot; ";
	echo "<a href='".Yii::app()->createUrl('blogrecord/default/',array('hidden'=>($hidden? 0 : 1)))."'>Показать только ".($hidden?'опубликованные':'скрытые')."</a>";
} ?>
</small></h1>

<?php $this->widget('ext.widgets.CPostList',array('hidden'=>$hidden)); ?>