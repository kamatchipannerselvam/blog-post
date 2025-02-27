<?php

class PostController extends Controller
{
    /**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','like','realTimePosts'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','like','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new Post('search'); // Use 'search' scenario
		$model->unsetAttributes(); // Clear default values
	
		if (isset($_GET['Post'])) {
			$model->attributes = $_GET['Post']; // Assign filter values
		}
	
		$dataProvider = new CActiveDataProvider('Post', array(
			'pagination' => array('pageSize' => 10),
		));
	
		$this->render('index', array(
			'model' => $model,
			'dataProvider' => $dataProvider,
		));		
	}
    
    public function actionCreate() {
        $model = new Post();
        if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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
        if(!Yii::app()->user->checkAccess("admin") && $model->created_by !== Yii::app()->user->id) {
            throw new CHttpException(403, 'You are not allowed to edit this post.');
        }
        if (!$model) throw new CHttpException(404, 'Post not found');
        if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
        
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
        if(!Yii::app()->user->checkAccess("admin") && $model->created_by !== Yii::app()->user->id) {
            throw new CHttpException(403, 'You are not allowed to edit this post.');
        }
        if ($model) {
            // Delete all related comments and likes using correct relations
            Comment::model()->deleteAll('post_id=:post_id', array(':post_id' => $model->id));
            Like::model()->deleteAll('post_id=:post_id', array(':post_id' => $model->id));
        
            // Finally, delete the post
            $model->delete();
        }
        
        $this->redirect(array('index'));
    }

    public function actionView($id) {
        $post = Post::model()->findByPk($id);
        if (!$post) throw new CHttpException(404, 'Post not found');

        $comment = new Comment();
        if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}

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
    public function actionRealTimePosts()
    {
        $criteria = new CDbCriteria();
        $criteria->join = "JOIN comments c ON t.id = c.post_id"; // Ensure at least 1 comment
        $criteria->condition = "(
            SELECT COUNT(*) FROM posts WHERE created_by = t.created_by
        ) >= 2"; // Ensure author has at least 2 posts
        $criteria->group = "t.id";
        $criteria->order = "t.created_at DESC"; // Order by latest

        $posts = Post::model()->findAll($criteria);

        // Render JSON response for AJAX
        echo CJSON::encode($posts);
        Yii::app()->end();
    }
}