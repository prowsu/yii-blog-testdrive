<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Добро пожаловать на <?php echo CHtml::encode(Yii::app()->name); ?></h1>

<p>Вы можете посмотреть записи ниже.</p>

<?php $this->widget('ext.widgets.CPostList'); ?>