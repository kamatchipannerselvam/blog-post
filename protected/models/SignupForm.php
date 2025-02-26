<?php

/**
 * SignupForm class.
 * SignupForm is the data structure for keeping
 * signup form data. It is used by the 'signup' action of 'SiteController'.
 */
class SignupForm extends CFormModel
{
	public $verify_code;
    public $password_repeat;
    public $password;
    public $username;
    public $email;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
        return [
            ['username,email', 'required'],
            ['username,email,password,password_repeat', 'filter', 'filter' => 'trim'],
            ['username', 'length', 'min' => 2, 'max' => 25],
            ['password,password_repeat', 'required'],
            ['password,password_repeat', 'length', 'min' => 8, 'max' => 16],
            array('password_repeat', 'compare', 'compareAttribute'=>'password'),
            ['email', 'email'],
            ['email', 'length', 'max' => 35],
            ['email','checkUniqueEmail'],
        ];
    }
    /**
     * custom validation for email already taken
     */
    public function checkUniqueEmail($attribute, $params)
    {
        $existingUser = User::model()->findByAttributes(array('email' => $this->$attribute));
        if ($existingUser && $existingUser->email === $this->email) { // Exclude current user in case of update
            $this->addError($attribute, 'This email is already taken.');
        }
    }
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verify_code'=>'Verification Code',
            'username'=>'Name',
            'password'=>'Password',
            'password_repeat'=>'Confirm Password',
            'email'=>'Email'
		);
	}
    
}