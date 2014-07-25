<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<h1>Contact Us</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldGroup($model,'name'); ?>
    <?php echo $form->textFieldGroup($model,'email'); ?>
    <?php echo $form->textFieldGroup($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
    <?php echo $form->textAreaGroup($model,'body',array('rows'=>9, 'cols'=>50)); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
        <div>
		<?php echo $form->textFieldGroup($model,'verifyCode'); ?>

        <?php $this->widget('CCaptcha'); ?>
        </div>
	<?php endif; ?>

    <?php $this->widget(
        'booster.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => 'Submit')
    ); ?>

<?php $this->endWidget(); ?>

<?php endif; ?>