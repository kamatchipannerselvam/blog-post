<?php
class PostWidget extends CWidget {
    public $pageSize = 5;
    public $searchQuery = ''; // Holds the search input

    public function run() {
        $criteria = new CDbCriteria();
        $criteria->order = "created_at DESC"; 
        
        if (isset($_POST['search'])) {
            $this->searchQuery = $_POST['search'];
        }

        // Apply search filter if a query is provided
        if (!empty($this->searchQuery)) {
            $criteria->addSearchCondition('title', $this->searchQuery);
            $criteria->addSearchCondition('content', $this->searchQuery, true, 'OR');
        }

        // Pagination setup
        $count = Post::model()->count($criteria);
        $pagination = new CPagination($count);
        $pagination->pageSize = $this->pageSize;
        $pagination->applyLimit($criteria);

        $posts = Post::model()->findAll($criteria);

        $this->render('postWidgetView', array(
            'posts' => $posts,
            'pagination' => $pagination,
            'searchQuery' => $this->searchQuery, // Pass query to view
        ));
    }
}