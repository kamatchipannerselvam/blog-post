<?php
/***
 * 
 */
class UserIdentity extends CUserIdentity
{
    
    public function authenticate()
	{
		$existingUser = User::model()->findByAttributes(array('email' => $this->username));
		$storedHash = $existingUser->password_hash; // Replace with stored hash

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
}