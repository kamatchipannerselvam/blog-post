<?php

class SiteController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	/**
	 * Declares class-based actions.
	 */
	public $userinfo;

	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function __construct($id, $module = null) {
        parent::__construct($id, $module); // ✅ Call parent constructor
        
		if(!Yii::app()->user->isGuest){
		$user=User::model()->findByAttributes(array('email'=>Yii::app()->user->id));
		$this->userinfo=$user;
 		}
	}


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionSignup()
    {
        $model = new SignupForm();
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['SignupForm']))
		{		
				$user=new User();
				$user->attributes=$_POST['SignupForm'];
				$user->password_hash = password_hash($user->password, PASSWORD_DEFAULT);
				if (!$user->save()) {
					Yii::app()->user->setFlash('error', 'Please Enter valid Email');
					$this->render('signup',array('model'=>$user));
					Yii::app()->end();
				}
				Yii::app()->user->setFlash('success', 'Please verify your Email');
				$this->redirect(array('site/verifyemail','token'=>$user->account_activation_token));
			// validate user input and redirect to the previous page if valid
		}
		// display the login form
		$this->render('signup',array('model'=>$model));
    }
	/***
	 * Input $token string 
	 */
	public function actionVerifyemail($token){
        $existingUser = User::model()->findByAttributes(array('account_activation_token' => $token));
		if(isset($_POST['ajax']) && $_POST['ajax']==='verify-form'){
			echo CActiveForm::validate($existingUser);
			Yii::app()->end();
		}
		if(isset($_POST['User'])){
			$verifycode=$_POST['User']['verify_code'];
			$user = User::model()->findByAttributes(array('account_activation_token' => $token,'auth_key'=>$verifycode));
			$user->status=user::STATUS_ACTIVE;
			$user->auth_key=null;
			$user->account_activation_token=null;
			if(!$user->save()){
				Yii::app()->user->setFlash('error', 'Not a valid user');
				$this->redirect(array('site/login'));
			}
			//give permission to post blog
			User::UserAutherization($user->id);
			Yii::app()->user->setFlash('success', 'Your email verified, Please login here');
			$this->redirect(array('site/login'));
		}
        if (!$existingUser) { // Exclude current user in case of update
			Yii::app()->user->setFlash('error', 'This token is not valid');
			$this->redirect(array('site/login'));
        }
		$this->render('verifyemail',array('model'=>$existingUser));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!Yii::app()->user->isGuest) {
            return $this->redirect(Yii::app()->homeUrl);
        }

		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			if ($model->validate() && $model->login()) {
				$this->redirect(Yii::app()->homeUrl); // Redirect to home after login
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionLivePosts()
	{
		$this->render('realTimePosts');
	}
}