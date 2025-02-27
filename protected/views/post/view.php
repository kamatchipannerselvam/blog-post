<h1><?php echo CHtml::encode($post->title); ?></h1>
<p><?php echo nl2br(CHtml::decode($post->content)); ?></p>
<?php echo "Author: " . CHtml::encode($post->author->username); ?> 
<div class="col-sm-12">
    <p><strong>Likes:</strong> <?php echo $likes; ?></p>
    <a href="<?php echo Yii::app()->createUrl('post/like', array('id' => $post->id)); ?>">👍 Like</a>
</div>
<div class="col-sm-12">
    <h2>Comments:</h2>
    <ul class="list-group">
    <?php foreach ($comments as $commentdata): ?>
        <li class="list-group-item"><span class="text-gray">Commented By: <?php echo $commentdata->commentedby->username?></span> <br><?php echo nl2br(CHtml::decode($commentdata->content)); ?></li>
    <?php endforeach; ?>
    </ul>
</div>
    <div class="col-sm-12">
        <h2>Add a Comment:</h2>
        <?php if(Yii::app()->user->isGuest) {
            echo '<p> '.CHtml::link('Login', array('site/login'),array('class'=>'nav-link')).'to post a comment</p>';
        } else{ ?>
            <?php
                $form=$this->beginWidget('CActiveForm', array(
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
            <div class="row">
                <div class="form-group" style="text-align: left;width:89rem">
                    <?php echo $form->labelEx($comment, 'content'); ?>
                    <?php echo $form->textArea($comment, 'content',array('class'=>"form-control",'autocomplete' => 'off')); ?>
                    <?php echo $form->error($comment, 'content',array('class'=>'text-danger')); ?>
                    <?php echo CHtml::activeHiddenField($comment,'post_id',array('value'=>$post->id))?>
                </div>
            </div>
            <div class="col-md-12 text-center mt-3">
                <?php echo CHtml::submitButton('Signup', array('class'=>'btn btn-primary')); ?>
            </div>
            <?php $this->endWidget(); ?>
            <?php } ?>
</div>
</div>



