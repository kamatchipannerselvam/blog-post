<?php
class RbacCommand extends CConsoleCommand
{
    public function actionInit()
    {
        $auth = Yii::app()->authManager;

        if ($auth->getAuthItem('admin')) {
            echo "RBAC already initialized.\n";
            return;
        }
		// Define operations
		$auth->createOperation('createPost', 'Create a blog post');
		$auth->createOperation('updatePost', 'Update any blog post');
		$auth->createOperation('deletePost', 'Delete any blog post');
		$auth->createOperation('manageOwnPost', 'Manage own blog post and post a comments');
		
		// Define roles and assign permissions
		$roleAdmin = $auth->createRole('admin');
		$roleAdmin->addChild('createPost');
		$roleAdmin->addChild('updatePost');
		$roleAdmin->addChild('deletePost');
				
		$roleAuthor = $auth->createRole('author');
        // Define roles and assign permissions
		$roleAuthor->addChild('manageOwnPost');

        echo "RBAC initialized successfully.\n";
    }
}
