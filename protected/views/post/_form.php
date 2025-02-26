<h1><?php echo $model->isNewRecord ? 'Create Post' : 'Update Post'; ?></h1>

<form method="post">
    <label>Title:</label>
    <input type="text" name="Post[title]" value="<?php echo CHtml::encode($model->title); ?>" required />
    
    <label>Content:</label>
    <textarea name="Post[content]" required><?php echo CHtml::encode($model->content); ?></textarea>

    <button type="submit">Save</button>
</form>