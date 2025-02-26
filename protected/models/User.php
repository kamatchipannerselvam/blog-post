<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property integer $status
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $account_activation_token
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $access_token
 * @property integer $expire_at
 */
class User extends CActiveRecord
{
    // the list of status values that can be stored in user table
    const STATUS_ACTIVE   = 10;
    const STATUS_INACTIVE = 1;
    const STATUS_DELETED  = 0;   
    Const EXPIRE_TIME = 604800; //token expiration time, 7 days valid
	public $verify_code;
	public $password;
	public $password_repeat;
	/**
	 * List of names for each status.
	 * @var array
	 */
	public $statusList = [
		self::STATUS_ACTIVE   => 'Active',
		self::STATUS_INACTIVE => 'Inactive',
		self::STATUS_DELETED  => 'Deleted'
	];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User';
	}
	public function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }

        // Modify or log data before saving
        if ($this->isNewRecord) {
			$randno=rand(9,9999);
			$hashkey = hash('sha256', 'activationtoken');
            $this->created_at = new CDbExpression('NOW()');
			$this->account_activation_token=$hashkey;
			$this->status=self::STATUS_INACTIVE;
			$this->auth_key=$randno;
        }
        $this->updated_at = new CDbExpression('NOW()');
        return true;
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password_hash', 'required'),
			array('username', 'length', 'max'=>25),
			array('email', 'length', 'max'=>35),
            ['email', 'email'],
            ['email', 'unique',
                'message' => 'This email address has already been taken.','on'=>'register'],
			array('auth_key,password_reset_token, account_activation_token,access_token', 'safe'),
			array('password_hash, password_reset_token, account_activation_token', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, password_hash, status, auth_key, password_reset_token, account_activation_token, created_at, updated_at, access_token, expire_at', 'safe', 'on'=>'search'),
			array('auth_key', 'length', 'max'=>32),
			array('verify_code','CustomVerifyCode'),
			['password,password_repeat', 'safe'],
		);
	}

    /**
     * custom validation for email already taken
     */
    public function CustomVerifyCode($attribute, $params)
    {
		if($this->verify_code){
			if($this->verify_code!=$this->auth_key){
					$this->addError($attribute, 'Entered code is wrong');
			}
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Name',
			'email' => 'Email',
			'password_hash' => 'Password Hash',
			'status' => 'Status',
			'auth_key' => 'Auth Key',
			'password_reset_token' => 'Password Reset Token',
			'account_activation_token' => 'Account Activation Token',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'access_token' => 'Access Token',
			'expire_at' => 'Expire At',
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

		$criteria->compare('username',$this->username,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('password_hash',$this->password_hash,true);

		$criteria->compare('status',$this->status);

		$criteria->compare('auth_key',$this->auth_key,true);

		$criteria->compare('password_reset_token',$this->password_reset_token,true);

		$criteria->compare('account_activation_token',$this->account_activation_token,true);

		$criteria->compare('created_at',$this->created_at);

		$criteria->compare('updated_at',$this->updated_at);

		$criteria->compare('access_token',$this->access_token,true);

		$criteria->compare('expire_at',$this->expire_at);

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function UserAutherization($userId,$role='author'){
		$auth = Yii::app()->authManager;
		// // Define operations
		// $auth->createOperation('createPost', 'Create a blog post');
		// $auth->createOperation('updatePost', 'Update any blog post');
		// $auth->createOperation('deletePost', 'Delete any blog post');
		// $auth->createOperation('manageOwnPost', 'Manage own blog post and post a comments');
		
		// // Define roles and assign permissions
		// $roleAdmin = $auth->createRole('admin');
		// $roleAdmin->addChild('createPost');
		// $roleAdmin->addChild('updatePost');
		// $roleAdmin->addChild('deletePost');
				
		// $roleAuthor = $auth->createRole('author');
		// $roleAuthor->addChild('manageOwnPost');
		
		// Assign roles to users
		if($role==='admin'){
			$auth->assign('admin', $userId);  // User ID 1 is an admin
		}
		else{
			$auth->assign('author', $userId); // User ID 3 is an author
		}
	}
}