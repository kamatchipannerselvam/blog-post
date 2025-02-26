<h1>Blog Posts</h1>
<ul>
<?php foreach ($posts as $post): ?>
    <li>
        <h3><a href="<?php echo Yii::app()->createUrl('post/view', array('id' => $post->id)); ?>">
            <?php echo CHtml::encode($post->title); ?>
        </a></h3>
        <p><?php echo nl2br(CHtml::encode($post->content)); ?></p>
    </li>
<?php endforeach; ?>
</ul>