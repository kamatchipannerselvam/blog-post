<h1><?php echo CHtml::encode($post->title); ?></h1>
<p><?php echo nl2br(CHtml::encode($post->content)); ?></p>

<p><strong>Likes:</strong> <?php echo $likes; ?></p>
<a href="<?php echo Yii::app()->createUrl('post/like', array('id' => $post->id)); ?>">👍 Like</a>

<h2>Comments:</h2>
<ul>
<?php foreach ($comments as $comment): ?>
    <li><?php echo nl2br(CHtml::encode($comment->content)); ?></li>
<?php endforeach; ?>
</ul>

<h2>Add a Comment:</h2>
<form method="post">
    <textarea name="Comment[content]" required></textarea>
    <input type="submit" value="Post Comment">
</form>