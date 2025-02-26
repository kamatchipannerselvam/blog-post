<?php

/**
 * This is the model class for table "Posts".
 *
 * The followings are the available columns in table 'Posts':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $visibility
 * @property string $status;
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Post extends CActiveRecord
{
	public $comments;
	public $likes;
	public $visibility;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Posts';
	}

	public function beforeSave() {

        if ($this->isNewRecord) {
            $this->created_at = new CDbExpression('NOW()');
			$this->created_by = Yii::app()->user->Id;
        }
        $this->updated_at = new CDbExpression('NOW()');
		$this->updated_by = Yii::app()->user->id;
        return parent::beforeSave();
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content', 'required'),
			array('created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>35),
			array('content', 'filter', 'filter' => array($obj=new CHtmlPurifier(),'purify')),
			array('visibility, status', 'numerical'),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content,visibility,status,created_at, updated_at, created_by, updated_by', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'author' => array(self::BELONGS_TO, 'User', 'created_by'),
			'comment'=> array(self::HAS_MANY,'Comment','post_id'),
			'likes'=> array(self::HAS_MANY,'Like','post_id')
		);
	}
	public function getCommentCount() {
		return Comment::model()->count('post_id=:post_id', array(':post_id' => $this->id));
	}
	public function getLikesCount() {
		return Like::model()->count('post_id=:post_id', array(':post_id' => $this->id));
	}
	public function getStatusText() {
		$status = ["1" => "Published", "0"=>'Un Published'];
		return isset($status[$this->status]) ? $status[$this->status] : "Unknown";
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'title' => 'Title',
			'content' => 'Content',
			'created_at' => 'Created Date',
			'updated_at' => 'Updated Date',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
			'comments'=>'Comments (Nos)',
			'likes'=>'Likes (Nos)',
			'visibility'=>'Visibility',
			'status'=>'Status'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('created_at',$this->created_at,true);

		$criteria->compare('updated_at',$this->updated_at,true);

		$criteria->compare('created_by',$this->created_by);

		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider('Post', array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 10),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}