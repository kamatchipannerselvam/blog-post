<?php
$this->pageTitle=Yii::app()->name;
?>
<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<?php 
$this->widget('PostWidget', array(
    'pageSize' => 5,
    'searchQuery' => isset($_GET['search']) ? $_GET['search'] : '',
)); 
?>
