<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Новая запись';
$this->breadcrumbs=array(
	'Блогозаписи'=>Yii::app()->createUrl('blogrecord/default'),
	'Новая запись'
);
?>

<h1>Блогозаписи - Новая запись</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'htmlOptions'=>array('style'=>'width:400px'),
	'id'=>'blogrecord-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Поля со звездочкой (<span class="required">*</span>) обязательны для заполнения.</p>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'title',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'user',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'user',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'user'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'date',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'date',array('class'=>'form-control','placeholder'=>'Чтобы убрать из публикации, укажите 0 (ноль)')); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'content',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'content',array('class'=>'form-control','cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton('Создать запись',array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
