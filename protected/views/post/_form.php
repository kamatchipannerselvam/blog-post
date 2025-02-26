<div class="row">
    <h5><?php echo $model->isNewRecord ? 'Create Post' : 'Update Post'; ?></h5>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'post-form',
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
    <p class="note text-danger" style="text-align: right;">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>    
        <div class="col-md-12">
            <div class="form-group" style="text-align: left;">
                <?php echo $form->labelEx($model, 'title'); ?>
                <?php echo $form->textField($model, 'title',array('class'=>"form-control",'autocomplete' => 'off')); ?>
                <?php echo $form->error($model, 'title',array('class'=>'text-danger')); ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group" style="text-align: left;">
                <?php echo $form->labelEx($model, 'content'); ?>
                <?php
                    $this->widget('application.extensions.ckeditor.CKEditor', array(
                    'model' => $model,
                    'attribute' => 'content', // The field in the database
                    'editorTemplate' => 'full', // Full toolbar
                    ));
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" style="text-align: left;">
                    <?php
                        $model->status=$model->isNewRecord?1:$model->status;
                        echo $form->labelEx($model, 'status',array('class'=>'mx-3')); 
                        echo $form->radioButton($model, 'status', array('value' => 0));
                        echo " Un publish ";
                        echo $form->radioButton($model, 'status', array('value' => 1));
                        echo " Publish ";
                        echo $form->error($model, 'publish');
                    ?>
                </div>
            </div>
            <div class="col-md-6">
            <div class="form-group" style="text-align: left;">
                <?php
                $model->visibility=$model->isNewRecord?1:$model->visibility;
                echo $form->labelEx($model, 'visibility',array('class'=>'mx-3')); 
                echo $form->radioButton($model, 'visibility', array('value' => 0));
                echo " Private ";
                echo $form->radioButton($model, 'visibility', array('value' => 1));
                echo " Public ";
                echo $form->error($model, 'visibility');
                ?>
            </div>
            </div>
        </div>
        <div class="col-md-12 text-center mt-5">
        <?php echo CHtml::submitButton( $model->isNewRecord?'Create Post':'Update Post', array('class'=>'btn btn-primary')); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>