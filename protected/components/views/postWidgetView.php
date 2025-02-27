<?php
// Handle form submission
echo $form = CHtml::beginForm(Yii::app()->createUrl('site/index'), 'post');
?>
    <input type="text" name="search" value="<?php echo CHtml::encode($searchQuery); ?>" placeholder="Search posts...">
    <button class="btn btn-primary" type="submit">Search</button>
    <button class="btn btn-default" type="button" onclick="window.location.href='<?php echo Yii::app()->createUrl('site/index'); ?>'">Reset</button>
<?php CHtml::endForm(); ?>

<hr>
<div class="container-fluid">
<div class="row row-cols-3">
<?php foreach ($posts as $post): ?>
    <div class="col">
        <div class="card m-2 p-2">
            <div class="card-body">
                <h5 class="card-title">
                    <h2><?php echo CHtml::decode($post->title); ?></h2>
                </h5>
                <p><?php echo ucwords($post->author->username); ?>, <?php echo ucwords($post->created_at); ?></p>
                <p class="card-text">
                    <?php 
                    $maxLength = 500; 
                    $text = CHtml::decode($post->content);
                    echo (mb_strlen($text, 'UTF-8') > $maxLength) ? mb_substr($text, 0, $maxLength, 'UTF-8') . '...' : $text;
                    ?>
                </p>
            </div>
            <div class="card-footer bg-info text-white">
                <a class="btn-link text-white" href="<?php echo CHtml::normalizeUrl(array('post/view', 'id' => $post->id)); ?>">Read More</a>
            </div>
        </div>
    </div>   
    <?php endforeach; ?>
</div>
</div>    

<div class="pagination">
    <?php 
    $this->widget('CLinkPager', array(
        'pages' => $pagination,
    ));
    ?>
</div>
