<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Verify Email';
$this->breadcrumbs=array('Verify Email');
?>
<div class="container overflow-hidden text-center">
<h1>Activate Email</h1>
<div class="row gx-5">
    <div class="col">
     <div class="p-3">
      <p>Please activate email, to confirm below code</p>
      <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'verify-form',
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        'clientOptions' => array(
        'validateOnSubmit' => true,   // Validate on submit
        'validateOnChange' => true,   // Validate when the field changes
        'validateOnType' => true,     // Validate while typing
        ),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions' => array('autocomplete' => 'off')
        )); ?>
      <?php echo $form->errorSummary($model); ?>    
      <div class="form-group text-center">
            <?php echo $form->labelEx($model,'verify_code'); ?>
            <?php echo $form->textField($model,'verify_code'); ?>
            <?php echo $form->error($model,'verify_code',array('class'=>'text-danger')); ?>
        </div>
        <div class="text-center">
            <p class="text-danger"><?php echo $model->auth_key ?></p>
            <?php echo CHtml::submitButton('Verify',array('class'=>'btn btn-primary px-5')); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    </div>
  </div>
</div>