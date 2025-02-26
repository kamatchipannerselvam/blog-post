<?php

class PostController extends Controller
{
    public $layout = '//layouts/admin';
	public function actionIndex() {
        $posts = Post::model()->findAll();
        $this->render('index', array('posts' => $posts));
    }

    public function actionCreate() {
        $model = new Post();
        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = Post::model()->findByPk($id);
        if (!$model) throw new CHttpException(404, 'Post not found');
        
        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id) {
        $model = Post::model()->findByPk($id);
        if ($model) $model->delete();
        $this->redirect(array('index'));
    }

    public function actionView($id) {
        $post = Post::model()->findByPk($id);
        if (!$post) throw new CHttpException(404, 'Post not found');

        $comment = new Comment();
        if (isset($_POST['Comment'])) {
            $comment->attributes = $_POST['Comment'];
            $comment->post_id = $id;
            if ($comment->save()) {
                $this->redirect(array('view', 'id' => $id));
            }
        }

        $comments = Comment::model()->findAllByAttributes(array('post_id' => $id));
        $likes = Like::model()->countByAttributes(array('post_id' => $id));

        $this->render('view', array(
            'post' => $post,
            'comment' => $comment,
            'comments' => $comments,
            'likes' => $likes
        ));
    }

    public function actionLike($id) {
        $post = Post::model()->findByPk($id);
        if (!$post) throw new CHttpException(404, 'Post not found');

        $ipAddress = Yii::app()->request->userHostAddress;

        if (!Like::model()->exists('post_id = :post_id AND ip_address = :ip', array(
            ':post_id' => $id,
            ':ip' => $ipAddress
        ))) {
            $like = new Like();
            $like->post_id = $id;
            $like->ip_address = $ipAddress;
            $like->save();
        }

        $this->redirect(array('view', 'id' => $id));
	}
	// public function actionIndex()
	// {
	// 	$this->render('index');
	// }

	// -----------------------------------------------------------
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}