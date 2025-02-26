    <div class="card p-4">
    <h5 class="card-title text-center">Signup</h5>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'signup-form',
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
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>    
    <div class="row g-3">
        <div class="col-md-6">
            <?php echo $form->labelEx($model, 'username'); ?>
            <?php echo $form->textField($model, 'username',array('class'=>"form-control",'autocomplete' => 'off')); ?>
            <?php echo $form->error($model, 'username',array('class'=>'text-danger')); ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email',array('class'=>"form-control")); ?>
            <?php echo $form->error($model, 'email',array('class'=>'text-danger')); ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password',array('class'=>"form-control",'autocomplete' => 'new-password')); ?>
            <?php echo $form->error($model, 'password',array('class'=>'text-danger')); ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->labelEx($model, 'password_repeat'); ?>
            <?php echo $form->passwordField($model, 'password_repeat',array('class'=>"form-control",'autocomplete' => 'new-password')); ?>
            <?php echo $form->error($model, 'password_repeat',array('class'=>'text-danger')); ?>
        </div>
        <div class="col-md-12 text-center">
        <?php echo CHtml::submitButton('Signup'); ?>
        </div>
    </div>  
    <?php $this->endWidget(); ?>
    </div>
