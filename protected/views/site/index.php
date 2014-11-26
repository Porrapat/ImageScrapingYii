<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'input-url-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('style'=>'width:100%')); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div>
<h2>Example website</h2>
<ul>
	<li><a href="http://www.pantip.com">http://www.pantip.com</a></li>
	<li><a href="http://www.smallrevolution.com">http://www.smallrevolution.com</a></li>
    <li><a href="http://css-tricks.com/">http://css-tricks.com/</a></li>
    <li><a href="http://code.tutsplus.com/tutorials/you-dont-know-anything-about-regular-expressions-a-complete-guide--net-7869">http://code.tutsplus.com/tutorials/you-dont-know-anything-about-regular-expressions-a-complete-guide--net-7869</a></li>
    <li><a href="http://stackoverflow.com/questions/849237/upload-progress-bar-in-php">http://stackoverflow.com/questions/849237/upload-progress-bar-in-php</a></li>
    
</ul>
</div>

<?php if(count($image_name_list) > 0) : ?>
	<?php foreach($image_name_list as $image): ?>
    <div>
        <img src="download/<?php echo $image; ?>" alt="" />
    </div>
    <?php endforeach; ?>
<?php endif; ?>