<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array('Login');
?>
<div class="card p-4">
<h5 class="card-title text-center">Login</h5>
<div class="container overflow-hidden">
  <div class="row gx-5">
    <div class="col">
		<div class="p-3">
			<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
					'htmlOptions' => array('autocomplete' => 'off')
				)); ?>
				<?php echo $form->errorSummary($model); ?>    
				<div class="form-group p-3">
					<?php echo $form->labelEx($model,'email'); ?>
					<?php echo $form->textField($model,'email',array('class'=>"form-control",'autocomplete' => 'off')); ?>
					<?php echo $form->error($model,'email',array('class'=>'text-danger')); ?>
				</div>
				<div class="form-group p-3">
					<?php echo $form->labelEx($model,'password'); ?>
					<?php echo $form->passwordField($model,'password',array('class'=>"form-control",'autocomplete' => 'off')); ?>
					<?php echo $form->error($model,'password',array('class'=>'text-danger')); ?>
				</div>

				<div class="input-group p-3">
					<?php echo $form->checkBox($model,'rememberMe'); ?>
					<?php echo $form->label($model,'rememberMe', array('class'=>'px-2')); ?>
					<?php echo $form->error($model,'rememberMe'); ?>
				</div>

				<div class="row">
					<?php echo CHtml::submitButton('Login',array('class'=>'btn btn-primary')); ?>
				</div>

			<?php $this->endWidget(); ?>
		</div>
    </div>
  </div>
</div>
</div><!-- form -->
