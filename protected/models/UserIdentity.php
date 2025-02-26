<?php
class UserIdentity extends CUserIdentity
{
	public $info;
    public function authenticate()
	{
		$existingUser = User::model()->findByAttributes(array('email' => $this->username));
		$storedHash = $existingUser?$existingUser->password_hash:null; // Replace with stored hash

		if(!$existingUser){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if (password_verify($this->password, $storedHash)) {
			$this->errorCode=self::ERROR_NONE;
		} else {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		return !$this->errorCode;
	}

	public function getId() {
		$user=User::model()->findByAttributes(array('email'=>$this->username));
		return $user?$user->id:0;
    }
	
}