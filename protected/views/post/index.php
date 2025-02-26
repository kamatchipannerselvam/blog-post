<h1>Post</h1>
<?php
$this->breadcrumbs=array('Post',);
?>
<div class="d-flex flex-row-reverse mb-3">
<?php echo CHtml::link('Create Post', array('post/create'),array('class'=>'btn btn-primary')); ?>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $dataProvider,
    'filter' => $model, // Enables filtering
    'columns' => array(
        'id',
        'title',
        array(
            'name'=>'comments',
            'value'=>'$data->CommentCount'
        ),
        array(
            'name'=>'likes',
            'value'=>'$data->LikesCount'
        ),
        array(
            'name'=>'visibility',
            'value'=>'$data->visibility==0?"Private":"Public"'
        ),
        array(
            'name'=>'status',
            'value'=>'$data->StatusText'
        ),
        array(
            'name'=>'author',
            'value'=>'$data->author->username'
        ),
        'created_at',
        'updated_at',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'update' => array(
                    'label' => 'Edit',
                    'url' => 'Yii::app()->createUrl("post/update", array("id"=>$data->id))',
                    'visible'=> 'Yii::app()->user->checkAccess("admin") || Yii::app()->user->id == $data->created_by'
                ),
                'delete' => array(
                    'label' => 'Delete',
                    'url' => 'Yii::app()->createUrl("post/delete", array("id"=>$data->id))',
                    'click' => 'function(){return confirm("Are you sure?");}',
                    'visible'=> 'Yii::app()->user->checkAccess("admin") || Yii::app()->user->id == $data->created_by'
                ),
            ),
        ),
    ),
));
?>