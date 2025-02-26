<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array();
?>

<h1>Users</h1>

<?php 
// $this->widget('zii.widgets.CListView', array(
// 	'dataProvider'=>$dataProvider,
// 	'itemView'=>'_view',
// ));
 ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $dataProvider,
    'filter' => $model, // Enables filtering
    'columns' => array(
        'id',
        'username',
        'email',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'update' => array(
                    'label' => 'Edit',
                    'url' => 'Yii::app()->createUrl("user/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'label' => 'Delete',
                    'url' => 'Yii::app()->createUrl("user/delete", array("id"=>$data->id))',
                    'click' => 'function(){return confirm("Are you sure?");}',
                ),
            ),
        ),
    )));
?>